<?php

    namespace Database\States;

    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Hash;

    class EnsureDefaultUserIsPresent
    {
        public function __invoke()
        {
            if ($this->present()) {
                return;
            }
            DB::table('users')->insert([
                'name' => 'Elisio Leonardo',
                'email' => 'admin@xava.co.mz',
                'password' => Hash::make('password'),
            ]);
        }

        public function present()
        {
            return DB::table('users')->count() > 0;
        }
    }
