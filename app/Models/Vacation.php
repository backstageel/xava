<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;

//    protected $fillable = [
//        'status_id'
//    ];


    public function user(){
        return  $this->belongsTo(User::class);
    }

    public function vacationStatus(){
        return  $this->belongsTo(VacationStatus::class, 'status_id');
    }

    public function hasVacationOnDate($date)
    {
        return $this->vacations->filter(function ($vacation) use ($date) {
            return $vacation->start_date <= $date && $vacation->end_date >= $date && $vacation->status === 'approved';
        })->isNotEmpty();
    }
}
