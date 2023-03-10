<?php

    namespace Database\States;

    use App\Models\User;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Hash;
    use Spatie\Permission\Models\Role;

    class EnsureDefaultUserIsPresent
    {
        public function __invoke()
        {
            if ($this->present()) {
                return;
            }
            $user = User::firstOrCreate([
                'name' => 'Elisio Leonardo',
                'email' => 'admin@xava.co.mz',
                'password' => Hash::make('password'),
            ]);

            $role = Role::firstOrCreate(['name'=>'admin']);
            $user->assignRole($role);
        }

        public function present()
        {
            return DB::table('users')->count() > 0;
        }
    }
