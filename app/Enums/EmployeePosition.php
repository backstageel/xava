<?php
declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static DIRECTORGERAL()
 * @method static static DIRECTORFINANCEIRO()
 * @method static static DIRECTOROPERATIVO()
 * @method static static COLABORADOR()
 */
final class EmployeePosition extends Enum
{
    const DIRECTOR_GERAL = 1;
    const DIRECTOR_FINANCEIRO = 2;
    const DIRECTOR_OPERATIVO = 3;
    const COLABORADOR = 4;
    const GESTOR_ESCRITORIO = 5;
    const GESTOR_SENIOR_VENDAS_IT = 6;
    const GESTOR_SENIOR_VENDAS_MOTAS_BICICLETA = 7;



}
