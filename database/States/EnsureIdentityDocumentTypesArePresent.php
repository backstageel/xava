<?php

    namespace Database\States;

    use Illuminate\Support\Facades\DB;

    class EnsureIdentityDocumentTypesArePresent
    {
        public function __invoke()
        {
            if ($this->present()) {
                return;
            }
            $identityDocumentTypes = [
                ['name' => 'Bilhete de Identidade'],
                ['name' => 'Cartão de Eleitor'],
                ['name' => 'Passaporte'],
            ];

            DB::table('identity_document_types')->insert($identityDocumentTypes);
        }

        public function present()
        {
            return DB::table('identity_document_types')->count() > 0;
        }
    }
