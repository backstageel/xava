<?php

namespace App\Http\Controllers;

use App\Models\AccountingStatus;
use App\Models\ApprovalStatus;
use App\Models\CardLoad;
use App\Models\Employee;
use App\Models\EmployeePosition;
use App\Models\ExpenseRequest;
use App\Models\ExpenseRequestType;
use App\Models\Person;
use App\Models\RequestStatus;
use App\Models\TotalCard;
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
    private $userID, $personID, $employee_position_id;

    public function index()
    {
        $this->userID = Auth::user()->id;
        $this->personID = Person::where('user_id',$this->userID)->value('id');
        $this->employee_position_id = Employee::where('person_id',$this->personID)->value('employee_position_id');

        if($this->employee_position_id==\App\Enums\EmployeePosition::DIRECTOR_FINANCEIRO ){
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
        if($this->employee_position_id==\App\Enums\EmployeePosition::GESTOR_ESCRITORIO){
            $accountingStatus = AccountingStatus::where('name', 'Contabilizado')->value('id');
            $expenses = ExpenseRequest::with(
                [
                    'accountingStatus',
                    'expenseRequestType',
                    'requestStatus',
                    'transactionAccount',
                    'approvalStatus',
                    'user'
                ]
            )->where('accounting_status_id',$accountingStatus)->orderBy('id')->paginate(1000);

            return view('expense_requests.index', compact('expenses'));
        }

        if($this->employee_position_id==\App\Enums\EmployeePosition::DIRECTOR_GERAL || $this->employee_position_id==\App\Enums\EmployeePosition::DIRECTOR_OPERATIVO || $this->userID==1) {
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

    public function index_box_request()
    {
        $this->userID = Auth::user()->id;
        $this->personID = Person::where('user_id',$this->userID)->value('id');
        $this->employee_position_id = Employee::where('person_id',$this->personID)->value('employee_position_id');
        $total_cards = TotalCard::where('id', 1)->first();

        if ($this->employee_position_id == \App\Enums\EmployeePosition::DIRECTOR_FINANCEIRO) {
            $expenses = ExpenseRequest::with(
                [
                    'accountingStatus',
                    'expenseRequestType',
                    'requestStatus',
                    'transactionAccount',
                    'approvalStatus',
                    'user'
                ]
            )->where('transaction_account_id', TransactionAccount::where('name', 'Caixa')->value('id'))->orderBy('id')->paginate(1000);

            return view('expense_requests.index_box_request', compact('expenses','total_cards'));
        }
        if ($this->employee_position_id==\App\Enums\EmployeePosition::GESTOR_ESCRITORIO || $this->userID==1) {
            $expenses = ExpenseRequest::with(
                [
                    'accountingStatus',
                    'expenseRequestType',
                    'requestStatus',
                    'transactionAccount',
                    'approvalStatus',
                    'user'
                ]
            )->where('transaction_account_id', TransactionAccount::where('name', 'Caixa')->value('id'))->paginate(1000);
//            dd (TransactionAccount::where('name', 'Caixa')->value('id'));
            return view('expense_requests.index_box_request', compact('expenses','total_cards'));
        }

        if ($this->employee_position_id==\App\Enums\EmployeePosition::DIRECTOR_GERAL || $this->employee_position_id==\App\Enums\EmployeePosition::DIRECTOR_OPERATIVO) {
            $expenses = ExpenseRequest::with(
                [
                    'accountingStatus',
                    'expenseRequestType',
                    'requestStatus',
                    'transactionAccount',
                    'approvalStatus',
                    'user'
                ]
            )->where('transaction_account_id',TransactionAccount::where('name', 'Caixa')->value('id'))
                ->orderBy('id')->paginate(1000);
            return view('expense_requests.index_box_request', compact('expenses','total_cards'));
        } else {
            return $this->create();
        }
    }

    public function create (){
        $users=User::where('id','>','1')->orderBy('name')->pluck('name','id');
        $accountingStatus=AccountingStatus::orderBy('name')->pluck('name','id');
        $approvalStatus=ApprovalStatus::orderBy('name')->pluck('name','id');
        $expenseRequestType=ExpenseRequestType::orderBy('name')->pluck('name','id');
        $requestStatus=RequestStatus::orderBy('name')->pluck('name','id');
        $transactionAccount=TransactionAccount::orderBy('name')->pluck('name','id');
        $is_box = false;
        return view('expense_requests.create',
            compact(
                'users',
                'accountingStatus',
                'approvalStatus',
                'expenseRequestType',
                'requestStatus',
                'transactionAccount',
                'is_box'
            ));
    }


    public function create_box_request()
    {
        $this->userID = Auth::user()->id;
        $this->personID = Person::where('user_id',$this->userID)->value('id');
        $this->employee_position_id = Employee::where('person_id',$this->personID)->value('employee_position_id');

       if ($this->employee_position_id==\App\Enums\EmployeePosition::GESTOR_ESCRITORIO || $this->userID==1) {

           $users = User::where('id', '>', '1')->orderBy('name')->pluck('name', 'id');
           $expenseRequestType = ExpenseRequestType::orderBy('name')->pluck('name', 'id');
           $requestStatus = RequestStatus::orderBy('name')->pluck('name', 'id');

           $is_box = true;
           return view('expense_requests.create',
               compact(
                   'users',
                   'expenseRequestType',
                   'requestStatus',
                   'is_box'
               ));
       } else {
           return $this->create();
       }
    }

    public function store_box_request(\App\Http\Requests\ExpenseRequest $request)
    {
        $expenseRequest = new ExpenseRequest();
        Carbon::setLocale('pt_BR');
        $year = Carbon::now()->year;
        $lastTwoDigits = substr($year, -2);

        $auth_user = Auth::user()->id;
        $last_Id = ExpenseRequest::count();

        $expenseRequest->internal_reference=('RD'.$lastTwoDigits.($last_Id<10?'0':'').(1+$last_Id));
        $expenseRequest->requester_user_id = $request->input('requester_user_id');
        $expenseRequest->type_id = $request->input('type_id');
        $expenseRequest->description = $request->input('description');
        $expenseRequest->amount = $request->input('amount');
        $expenseRequest->invoice = $request->input('invoice');
        $expenseRequest->transaction_account_id = TransactionAccount::where('name', 'Caixa')->value('id');

        $expenseRequest->approval_status_id = ApprovalStatus::where('name', 'Aprovado')->value('id');
        $expenseRequest->accounting_status_id = AccountingStatus::where('name', 'Contabilizado')->value('id');
        $expenseRequest->request_date = $request->input('request_date');
        $expenseRequest->request_status_id = RequestStatus::where('name','aberto')->value('id');// Obtenha o ID correspondente ao nome "Aberto"


        if ($request->input('requires_receipt') == 1) {
            $expenseRequest->requires_receipt = true;
        } else {
            $expenseRequest->requires_receipt = false;
        }
        $expenseRequest->approved_by_user_id = $auth_user;
        $expenseRequest->accountant_user_id = $auth_user;

        $expenseRequest->change = $request->input('change');

        $total_cards = TotalCard::where('id', 1)->first();
        $total_cards->total_amount = $total_cards->total_amount - $expenseRequest->amount;
        $total_cards->update_date = Carbon::now();

        try{
            $expenseRequest->save();
            $total_cards->save();
            flash('Requisição registrada com sucesso')->success();
            return redirect()->route('expense_request.index_box_request');
        }catch (\Exception $exception){
            if ($exception->getCode() === '23000' && strpos($exception->getMessage(), 'Duplicate entry') !== false) {
                // Aqui, você pode fornecer uma mensagem amigável para o usuário, por exemplo:
            flash(' O número de fatura já existe. Por favor, insira um número de fatura único. ')->error();
            return redirect()->back()->withInput();
        } else {
                flash(' Erro ao tentar cadastrar requisição ')->error();
                return redirect()->back()->withInput();
            }
        }


    }


    public function store(\App\Http\Requests\ExpenseRequest $request)
    {
        $expenseRequest = new ExpenseRequest();
        Carbon::setLocale('pt_BR');
        $month= Carbon::now()->isoFormat('MMMM');
        $year = Carbon::now()->year;
        $lastTwoDigits = substr($year, -2);

        $last_Id = ExpenseRequest::count();
        $requester_user_id = Auth::user()->id;

        $expenseRequest->internal_reference=('RD'.$lastTwoDigits.($last_Id<10?'0':'').(1+$last_Id));
        $expenseRequest->requester_user_id = $requester_user_id;
        $expenseRequest->type_id = $request->input('type_id');
        $expenseRequest->description = $request->input('description');
        $expenseRequest->amount = $request->input('amount');
        $expenseRequest->invoice = $request->input('invoice');
        $expenseRequest->change = $request->input('change');

        $expenseRequest->request_date = ucfirst($month);
        $expenseRequest->approval_status_id = ApprovalStatus::where('name', 'pendente')->value('id'); // Obtenha o ID correspondente ao nome "pendente"
        $expenseRequest->request_status_id = RequestStatus::where('name','Aberto')->value('id');// Obtenha o ID correspondente ao nome "Aberto"
        $expenseRequest->accounting_status_id = AccountingStatus::where('name','Requisitado')->value('id');

        try{
            $expenseRequest->save();
            flash('Requisição registada com sucesso')->success();
           return redirect()->route('expense_request.myRequest');
        }catch (\Exception $exception){

            if ($exception->getCode() === '23000' && strpos($exception->getMessage(), 'Duplicate entry') !== false) {
                // Aqui, você pode fornecer uma mensagem amigável para o usuário, por exemplo:
                flash(' O número de fatura já existe. Por favor, insira um número de fatura único. ')->error();
                return redirect()->back()->withInput();
            } else {
                flash(' Erro ao tentar cadastrar requisição ')->error();
                return redirect()->back()->withInput();
            }
        }


    }


    public function show(ExpenseRequest $expenseRequest)
    {
        $transactionAccount = TransactionAccount::get();
        return view('expense_requests.show',compact('expenseRequest', 'transactionAccount'));
    }

    public function show_details(ExpenseRequest $expenseRequest)
    {
        dd($expenseRequest);
        return view('expense_requests.show_details', compact('expenseRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExpenseRequest $expenseRequest)
    {
        $users = User::where('id', '>', '1')->orderBy('name')->pluck('name', 'id');
        $expenseRequestType = ExpenseRequestType::orderBy('name')->pluck('name', 'id');
        $requestStatus = RequestStatus::orderBy('name')->pluck('name', 'id');

        $is_box = true;
        return view('expense_requests.edit',
            compact(
                'users',
                'expenseRequestType',
                'requestStatus',
                'is_box',
                'expenseRequest'
            ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\App\Http\Requests\ExpenseRequest $request, ExpenseRequest $expenseRequest)
    {
        $last_amount = $expenseRequest->amount;
        $expenseRequest->requester_user_id = $request->input('requester_user_id');
        $expenseRequest->type_id = $request->input('type_id');
        $expenseRequest->description = $request->input('description');
        $expenseRequest->amount = $request->input('amount');
        $expenseRequest->invoice = $request->input('invoice');

        $expenseRequest->transaction_account_id = TransactionAccount::where('name', 'Caixa')->value('id');

        $expenseRequest->approval_status_id = ApprovalStatus::where('name', 'Aprovado')->value('id');
        $expenseRequest->accounting_status_id = AccountingStatus::where('name', 'Contabilizado')->value('id');
        $expenseRequest->request_date = $request->input('request_date');
        $expenseRequest->request_status_id = RequestStatus::where('name','aberto')->value('id');// Obtenha o ID correspondente ao nome "Aberto"
        $expenseRequest->change = $request->input('change');
        $expenseRequest->approved_by_user_id = Auth::user()->id;
        $expenseRequest->accountant_user_id = Auth::user()->id;

        if ($request->input('requires_receipt') == 1) {
            $expenseRequest->requires_receipt = true;
        } else {
            $expenseRequest->requires_receipt = false;
        }


        $total_cards = TotalCard::where('id', 1)->first();
        $total_cards->total_amount = $total_cards->total_amount - $expenseRequest->amount + $last_amount;
        $total_cards->update_date = Carbon::now();

        try{
            $expenseRequest->save();
            $total_cards->save();
            flash('Requisição editada com sucesso')->success();
            return redirect()->route('expense_requests.show', $expenseRequest);
        }catch (\Exception $exception){
            if ($exception->getCode() === '23000' && strpos($exception->getMessage(), 'Duplicate entry') !== false) {
                // Aqui, você pode fornecer uma mensagem amigável para o usuário, por exemplo:
                flash(' O número de fatura já existe. Por favor, insira um número de fatura único. ')->error();
                return redirect()->back()->withInput();
            } else {
                flash(' Erro ao tentar editar requisição')->error();
                return redirect()->back()->withInput();
            }
        }
    }
    public function approve(ExpenseRequest $expenseRequest)
    {
        $newApprovalStatusId = ApprovalStatus::where('name', 'Aprovado')->value('id');

        $expenseRequest->update(['approval_status_id' => $newApprovalStatusId,'approved_by_user_id'=>Auth::user()->id]);

        flash('Requisição Aprovado com sucesso')->success();
        return redirect()->route('expense_requests.index');
    }

    public function confirm(\App\Http\Requests\ExpenseRequest $request, ExpenseRequest $expenseRequest)
    {
        if ($expenseRequest->transaction_account_id == TransactionAccount::where('name', 'Caixa')->value('id')) {
            $total_cards = TotalCard::where('id', 1)->first();

            $newRequestStatusId = RequestStatus::where('name', 'Fechado')->value('id');

            $expenseRequest->update(['request_status_id' => $newRequestStatusId, 'treasurer_user_id' => Auth::user()->id]);

            $total_cards->total_amount = $total_cards->total_amount + $expenseRequest->change;
            $total_cards->update_date = Carbon::now();
            $expenseRequest->approval_status_id = ApprovalStatus::where('name', 'Aprovado')->value('id');
            $expenseRequest->accounting_status_id = AccountingStatus::where('name', 'Contabilizado')->value('id');
            $expenseRequest->save();
            $total_cards->save();

            flash('Requisição Finalizada com sucesso')->success();
            return redirect()->route('expense_request.index_box_request');
        } else {
            flash('Não tem Permissões para finalizar uma requisição que não é de Caixa. Por favor contacte o Administrador')->error();
            return redirect()->back()->withInput();
        }

    }
    public function accountingStatus(ExpenseRequest $expenseRequest,Request $request,)
    {
        $newAccountingStatusId = $request->input('accounting_status_id');
        $expenseRequest->update(['accounting_status_id' => $newAccountingStatusId,'accountant_user_id'=>Auth::user()->id]);

        $expenseRequest->transaction_account_id = $request->input('transaction_account_id');
        $expenseRequest->transfer_account_number = $request->input('transfer_account_number');
        $expenseRequest->save();

        if ($expenseRequest->transaction_account_id !=  TransactionAccount::where('name', 'Caixa')->value('id')) {
            $newRequestStatusId = RequestStatus::where('name', 'Fechado')->value('id');
            $expenseRequest->update(['request_status_id' => $newRequestStatusId, 'treasurer_user_id' => Auth::user()->id]);

        }

        flash('Requisição Actualizada com sucesso')->success();
        return redirect()->route('expense_requests.index');
    }
    public function reject(ExpenseRequest $expenseRequest){
        $newRequestStatusId = RequestStatus::where('name', 'Fechado')->value('id');
        $newApprovalStatusId = ApprovalStatus::where('name', 'Recusado')->value('id');

        $expenseRequest->update(
            ['approval_status_id' => $newApprovalStatusId,
                'approved_by_user_id'=>Auth::user()->id,
                'request_status_id'=>$newRequestStatusId]);

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
        )->where('requester_user_id',$this->userID)->orderBy('id','desc')->paginate(1000);
        return view('expense_requests.myRequest', compact('expenses'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
