<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Document;
use App\Models\Employee;
use App\Models\Person;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Http\Requests\DocumentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{


    private $user_id, $person_id, $employee_position_id;

    public function index($path)
    {
        if ($path != 'IT' && $path != 'motas' && $path != 'Documentos Actualizados') {
            $documents = Storage::files('documents/' . $path);
            return view('documents.index', compact('documents', 'path'));
        } else if ($path == 'Documentos Actualizados'){
            $documents = Storage::files('documents/Documentos Actualizados' . $path);
            $documents_in_table = Document::where('path', $path)
                ->get();
            return view('documents.index', compact('documents', 'documents_in_table', 'path'));
        } else {
            $documents = Storage::files('documents/actas/' . $path);

            $threeMonthsAgo = Carbon::now()->subMonths(3);
            $documents_in_table = Document::where('path', $path)
                ->whereDate('meeting_date', '>', $threeMonthsAgo)
                ->get();
            return view('documents.index', compact('documents', 'documents_in_table', 'path'));
        }

    }

    public function create($path)
    {
        $this->user_id = Auth::user()->id;
        $this->person_id = Person::where('user_id', $this->user_id)->value('id');
        $this->employee_position_id = Employee::where('person_id', $this->person_id)->value('employee_position_id');

        if ($this->employee_position_id == \App\Enums\EmployeePosition::GESTOR_ESCRITORIO || $this->user_id == 1) {
            $departments = Department::pluck('name', 'id');
            return view('documents.create', compact('path', 'departments'));
        } else {
            flash('Não tem acesso para adicionar documentos')->error();
            return redirect()->back()->withInput();
        }
    }

    public function viewDocument($filename, $path)
    {
        if ($path != 'IT' && $path != 'motas') {
            $filePath = storage_path('app/documents/' . $path . '/' . $filename);
        } else {
            $filePath = storage_path('app/documents/actas/' . $path . '/' . $filename);
        }

        if (file_exists($filePath)) {
            return response()->file($filePath);
        } else {
            abort(404);
        }
    }
    public function edit(Document $document, $path){
        return view('documents.edit', compact( 'document', 'path'));
    }
    public function update(Document $document, Request $request, ){
        $path = $request->input('path');
        $document->meeting_date = $request->input('meeting_date');
        $document->save();

        flash('success', 'Documento carregado com sucesso')->success();
        return redirect()->route('documents.index', $path);

    }

    public function uploadDocument(Request $request)
    {
        $path = $request->input('path');
        $file = $request->file('document');
        $file_name = $request->input('name'); // Nome desejado fornecido pelo usuário
        $extension = $file->getClientOriginalExtension();
        $new_file_name = $file_name . '.' . $extension;


        if ($path != 'motas' && $path != 'IT') {
            $file->storeAs('documents/' . $path, $new_file_name);
        } else {
            $file->storeAs('documents/actas/' . $path, $new_file_name);
        }

        // Criar um novo registro de documento no banco de dados
        $document = new Document();
        $document->name = $new_file_name;
        $document->path = $path;

        if ($path == 'motas' || $path == 'IT') {
            $department = $request->input('department_id');
            $document->department_id = $department;
            $document->meeting_date = $request->input('meeting_date');
        }
        $document->meeting_date = $request->input('meeting_date');
        $document->save();

        flash('success', 'Documento carregado com sucesso')->success();
        return redirect()->route('documents.index', $path);
    }

    public function destroy($filename, $path)
    {
        $this->user_id = Auth::user()->id;
        $this->person_id = Person::where('user_id', $this->user_id)->value('id');
        $this->employee_position_id = Employee::where('person_id', $this->person_id)->value('employee_position_id');

        if ($this->employee_position_id == \App\Enums\EmployeePosition::GESTOR_ESCRITORIO || $this->user_id == 1) {
            if ($path != 'IT' && $path != 'motas') {
                $filePath = storage_path('app/documents/' . $path . '/' . $filename);
            } else {
                $filePath = storage_path('app/documents/actas/' . $path . '/' . $filename);
            }

            if (file_exists($filePath)) {
                unlink($filePath);
                Document::where('name', $filename)->where('path', $path)->delete();


                flash('success', 'Documento excluído com sucesso')->success();
            } else {
                flash('error', 'Documento não excluido')->error();
            }
            return redirect()->route('documents.index', $path);

        } else {
            flash('Não tem acesso para eliminar documentos')->error();
            return redirect()->back()->withInput();
        }

    }

}
