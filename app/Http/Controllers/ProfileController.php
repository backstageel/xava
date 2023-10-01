<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\PersonRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\CivilState;
use App\Models\Country;
use App\Models\Department;
use App\Models\District;
use App\Models\Employee;
use App\Models\EmployeeContractType;
use App\Models\EmployeePosition;
use App\Models\Gender;
use App\Models\IdentityDocumentType;
use App\Models\Person;
use App\Models\PersonPrefix;
use App\Models\Province;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        $user_id = Auth::user()->id;
        $person_id = Person::where('user_id', $user_id)->value('id');
        $employee = Employee::where('person_id', $person_id)->first();
        $genders = Gender::pluck('name', 'id');
        $civilStates = CivilState::pluck('name', 'id');
        $countries = Country::pluck('name', 'id');
        $provinces = Province::pluck('name', 'id');
        $districts = District::pluck('name', 'id');
        $identityDocumentTypes = IdentityDocumentType::pluck('name', 'id');
        $personPrefixes = PersonPrefix::pluck('code', 'id');

        return view('profile.edit', compact('employee', 'genders',
        'civilStates', 'countries', 'provinces', 'districts', 'identityDocumentTypes', 'personPrefixes')  );
    }

    public function update(CreateEmployeeRequest $request, PersonRequest $person_request)
    {

        $user = Auth::user();
        $person = Person::where('user_id',$user->id)->first();
        $employee = Employee::where('person_id',$person->id)->first();




        if (($request->input('first_name')) != null) {
            $user->name = $request->input('first_name') . ' ' . $request->input('last_name');
        }

        $person->person_prefix_id = $person_request->input('person_prefix_id');
        $person->gender_id = $person_request->input('gender_id');
        $person->address_district_id = $person_request->input('address_district_id');
        $person->address_province_id = $request->input('address_province_id');
        $person->address_country_id = $request->input('address_country_id');
        $person->birth_district_id = $request->input('birth_district_id');
        $person->birth_province_id = $request->input('birth_province_id');
        $person->birth_country_id = $request->input('birth_country_id');
        $person->civil_state_id = $request->input('civil_state_id');

        if (($request->input('first_name')) != null || ($request->input('last_name')) != null ) {
            $person->first_name = $request->input('first_name');
            $person->last_name = $request->input('last_name');
        }
        if (($request->input('birth_date')) != null) {
            $person->birth_date = $request->input('birth_date');
        }
        if (($request->input('address')) != null) {
            $person->address = $request->input('address');
        }
        if (($request->input('cellphone')) != null) {
            $person->phone = $request->input('cellphone');
        }
        if (($request->input('personal_email')) != null) {
            $person->email = $request->input('personal_email');
        }
        if (($request->input('nuit')) != null) {
            $person->nuit = $request->input('nuit');
        }
        if (($request->input('identity_document_type_id')) != null) {
            $person->identity_document_type_id = $request->input('identity_document_type_id');
        }
        if (($request->input('identity_document_number')) != null) {
            $person->identity_document_number = $request->input('identity_document_number');
        }
        if (($request->input('identity_document_emission_date')) != null) {
            $person->identity_document_emission_date = $request->input('identity_document_emission_date');
        }
        if (($request->input('identity_document_expiry_date')) != null) {
            $person->identity_document_expiry_date = $request->input('identity_document_expiry_date');
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/profile_pictures');
            $extension = $request->file('image')->getClientOriginalExtension();

            $newPath = 'profile_pictures/' . $person->id . '.' . $extension;
            // Verifique se um arquivo com o mesmo nome já existe
            if (Storage::exists('public/' . $newPath)) {
                // Se existe, exclua o arquivo antigo
                Storage::delete('public/' . $newPath);
            }

            // Mova o novo arquivo
            Storage::move($imagePath, 'public/' . $newPath);

            $person->profile_picture = $newPath;
        }

        $employee->emergency_name = $request->input('emergency_name');
        $employee->emergency_phone = $request->input('emergency_phone');

        $id = $employee->id;
        $startDate = Carbon::parse($employee->start_date);
        $year = $startDate->format('y');
        $month = $startDate->format('m');

        // Monta a referência do funcionário
        $employeeCode = null;
        if ($id < 10) {
            $employeeCode = 'XV000' . $id . $month . $year;
        } elseif ($id < 100) {
            $employeeCode = 'XV00' . $id . $month . $year;
        } elseif ($id < 1000) {
            $employeeCode = 'XV0' . $id . $month . $year;
        } else {
            $employeeCode = 'XV' . $id . $month . $year;
        }

        $employee->employee_code = $employeeCode;
        try {
            $user->save();
            $employee->save();
            $person->save();
            return view('profile.show', compact('employee'));
        } catch (\Exception $exception) {
            flash('Perfil Não Actualizado ' . $exception->getMessage())->error();
            return redirect()->back()->withInput();
        }
    }

    public function show(){

        $user_id = Auth::user()->id;
        $person_id = Person::where('user_id', $user_id)->value('id');
        $employee = Employee::where('person_id', $person_id)->first();
        return view('profile.show', compact('employee'));
    }
    /**
     * Update the user's profile information.
     */
//    public function update(ProfileUpdateRequest $request): RedirectResponse
//    {
//        $request->user()->fill($request->validated());
//        if ($request->user()->isDirty('email')) {
//            $request->user()->email_verified_at = null;
//        }
//
//        $request->user()->save();
//
//        return Redirect::route('profile.edit')->with('status', 'profile-updated');
//    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
