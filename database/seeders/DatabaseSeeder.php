<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use function Laravel\Prompts\error;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (is_null(env(key: 'USER_PASSWORD_DEFAULT'))) {
            error("Error: set USER_PASSWORD_DEFAULT to env file\n");
            return;
        }
        $this->call([
            UserAdminSeeder::class,
        ]);
    }
}
