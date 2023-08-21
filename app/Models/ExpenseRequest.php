<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'approval_status_id',
        'approved_by_user_id',
        'accountant_user_id',
        'accounting_status_id',
        'treasurer_user_id',
        'request_status_id'
    ];


    public function accountingStatus(){
       return $this->belongsTo(AccountingStatus::class);
    }
    public function expenseRequestType(){
        return $this->belongsTo(ExpenseRequestType::class);
    }
    public function requestStatus(){
        return $this->belongsTo(RequestStatus::class);
    }
    public function transactionAccount(){
        return $this->belongsTo(TransactionAccount::class);
    }
    public function approvalStatus(){
        return $this->belongsTo(ApprovalStatus::class);
    }
    public function user(){
       return  $this->belongsTo(User::class);
    }

}
