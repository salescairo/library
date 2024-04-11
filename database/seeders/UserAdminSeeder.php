<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use function Laravel\Prompts\error;

class UserAdminSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('USER_EMAIL_DEFAULT');
        $password = env('USER_PASSWORD_DEFAULT');

        if (is_null($email) || is_null($password)){
            error('Confirgure as credencias do usuário admin');
            die();
        }

        User::factory()->create([
            'name' => 'Admin',
            'email' => $email,
            'password' => $password,
            'type' => User::MASTER_TYPE,
            'enabled' => true,
        ]);
    }
}
