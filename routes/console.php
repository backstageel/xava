<?php

use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('ensure-database-state-is-loaded', function () {
    collect([
        new Database\States\EnsureCountriesArePresent,
        new Database\States\EnsureProvincesArePresent,
        new Database\States\EnsureDistrictsArePresent,
        new Database\States\EnsureCivilStatesArePresent,
        new Database\States\EnsureGendersArePresent,
        new Database\States\EnsureIdentityDocumentTypesArePresent,
        new Database\States\EnsureDefaultUserIsPresent,
        new Database\States\EnsureEmployeeContractTypesArePresent,
        new Database\States\EnsureEmployeeContractStatusesArePresent,
        new Database\States\EnsureDepartmentsArePresent,
        new Database\States\EnsureEmployeePositionsArePresent,
        new Database\States\EnsurePersonPrefixesArePresent,
        new Database\States\EnsureCustomerStatusesArePresent,
        new Database\States\EnsureSaleStatusArePresent,
        new Database\States\EnsureCompanyTypesArePresent,

    ])->each->__invoke();
});
