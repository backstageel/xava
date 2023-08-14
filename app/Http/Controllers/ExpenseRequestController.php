<?php

namespace App\Http\Controllers;

use App\Models\AccountingStatus;
use App\Models\ApprovalStatus;
use App\Models\Employee;
use App\Models\EmployeePosition;
use App\Models\ExpenseRequest;
use App\Models\ExpenseRequestType;
use App\Models\Person;
use App\Models\RequestStatus;
use App\Models\TransactionAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use function Deployer\input;


class ExpenseRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $userID,$personID,$employee_position_id;

    public function __construct()
    {

    }

    public function index()
    {
        $this->userID = Auth::user()->id;
        $this->personID = Person::where('user_id',$this->userID)->value('id');
        $this->employee_position_id = Employee::where('person_id',$this->personID)->value('employee_position_id');

        if($this->employee_position_id==\App\Enums\EmployeePosition::DIRECTOR_FINANCEIRO){
            $approvalStatus= ApprovalStatus::where('name', 'Aprovado')->value('id');
            $expenses = ExpenseRequest::with(
                [
                    'accountingStatus',
                    'expenseRequestType',
                    'requestStatus',
                    'transactionAccount',
                    'approvalStatus',
                    'user'
                ]
            )->where('approval_status_id',$approvalStatus)->orderBy('id')->paginate(1000);
            return view('expense_requests.index', compact('expenses'));
        }

        if($this->employee_position_id==\App\Enums\EmployeePosition::DIRECTOR_GERAL || $this->employee_position_id==\App\Enums\EmployeePosition::DIRECTOR_OPERATIVO) {
        $expenses = ExpenseRequest::with(
            [
                'accountingStatus',
                'expenseRequestType',
                'requestStatus',
                'transactionAccount',
                'approvalStatus',
                'user'
            ]
        )->orderBy('id')->paginate(1000);
        return view('expense_requests.index', compact('expenses'));
    }else{
        return $this->create();
    }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $users=User::where('id','>','1')->orderBy('name')->pluck('name','id');
       $accountingStatus=AccountingStatus::orderBy('name')->pluck('name','id');
       $approvalStatus=ApprovalStatus::orderBy('name')->pluck('name','id');
       $expenseRequestType=ExpenseRequestType::orderBy('name')->pluck('name','id');
       $requestStatus=RequestStatus::orderBy('name')->pluck('name','id');
       $transactionAccount=TransactionAccount::orderBy('name')->pluck('name','id');

       return view('expense_requests.create',
           compact(
               'users',
               'accountingStatus',
               'approvalStatus',
               'expenseRequestType',
               'requestStatus',
               'transactionAccount'
           ));



    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\App\Http\Requests\ExpenseRequest $request)
    {
        $expenseRequest = new ExpenseRequest();
        Carbon::setLocale('pt_BR');
        $month= Carbon::now()->isoFormat('MMMM');
        $year = Carbon::now()->year;
        $lastTwoDigits = substr($year, -2);

        $last_Id = ExpenseRequest::count();
        $requester_user_id=Auth::user()->id;

        $expenseRequest->internal_reference=('RD'.$lastTwoDigits.($last_Id<10?'0':'').(1+$last_Id));
        $expenseRequest->requester_user_id = $requester_user_id;
        $expenseRequest->type_id = $request->input('type_id');
        $expenseRequest->description = $request->input('description');
        $expenseRequest->amount = $request->input('amount');
        $expenseRequest->transaction_account_id = $request->input('transaction_account_id');
        $expenseRequest->transfer_account_number = $request->input('transfer_account_number');
        $expenseRequest->request_date = ucfirst($month);
        $expenseRequest->approval_status_id = ApprovalStatus::where('name', 'pendente')->value('id'); // Obtenha o ID correspondente ao nome "pendente"
        $expenseRequest->request_status_id = RequestStatus::where('name','aberto')->value('id');// Obtenha o ID correspondente ao nome "Aberto"
        $expenseRequest->accounting_status_id = AccountingStatus::where('name','Requisitado')->value('id');

        try{
            $expenseRequest->save();
            flash('Requisição registada com sucesso')->success();
           return redirect()->route('expense_request.myRequest');
        }catch (\Exception $exception){
            flash('Erro ao tentar registar a requisição '. $exception->getMessage())->error();
           return redirect()->back()->withInput();

        }


    }

    /**
     * Display the specified resource.
     */
    public function show(ExpenseRequest $expenseRequest)
    {
        return view('expense_requests.show',compact('expenseRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }
    public function approve(ExpenseRequest $expenseRequest)
    {
        $newApprovalStatusId = ApprovalStatus::where('name', 'Aprovado')->value('id');

        $expenseRequest->update(['approval_status_id' => $newApprovalStatusId,'approved_by_user_id'=>$this->userID]);

        flash('Requisição Aprovado com sucesso')->success();
        return redirect()->route('expense_requests.index');
    }
    public function reject(ExpenseRequest $expenseRequest){
        $newApprovalStatusId = ApprovalStatus::where('name', 'Recusado')->value('id');

        $expenseRequest->update(['approval_status_id' => $newApprovalStatusId,'approved_by_user_id'=>$this->userID]);

        flash('Requisição Recusada com sucesso')->message();
        return redirect()->route('expense_requests.index');
    }
    public function myRequest(){
        $this->userID = Auth::user()->id;
        $this->personID = Person::where('user_id',$this->userID)->value('id');
        $this->employee_position_id = Employee::where('person_id',$this->personID)->value('employee_position_id');

        $expenses = ExpenseRequest::with(
            [
                'accountingStatus',
                'expenseRequestType',
                'requestStatus',
                'transactionAccount',
                'approvalStatus',
                'user'
            ]
        )->where('requester_user_id',$this->userID)->orderBy('id')->paginate(1000);
        return view('expense_requests.index', compact('expenses'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
