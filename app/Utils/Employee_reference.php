<?php

namespace App\Utils;

class Employee_reference
{
    public static function generate_employee_reference($employee_id, $employee_start_date) {
        // Extrai o ano e o mês da data do contrato
        $year = substr($employee_start_date, 2, 2);
        $month = substr($employee_start_date, 5, 2);

        // Monta a referência do funcionário
        $employee_reference=null;
        if($employee_id<10) {
            $employee_reference = 'XV000' . $employee_id . $month . $year;
        }elseif($employee_id<100){
            $employee_reference = 'XV00' . $employee_id . $month . $year;
        }elseif ($employee_reference<1000){
            $employee_reference = 'XV0' . $employee_id . $month . $year;
        }else{
            $employee_reference = 'XV' . $employee_id . $month . $year;
        }


        return $employee_reference;
    }
}
