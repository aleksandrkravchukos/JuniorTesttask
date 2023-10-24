<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $italianNames = [
            'Luca',
            'Giulia',
            'Marco',
            'Alessia',
            'Lorenzo',
            'Sofia',
            'Matteo',
            'Emma',
            'Francesco',
            'Greta'
        ];
        $italianDomains = [
            'gmail.com',
            'yahoo.it',
            'libero.it',
            'hotmail.it',
            'virgilio.it',
            'tin.it',
            'alice.it'
        ];
        for ($i = 0; $i < 10; $i++) {
            $name = $italianNames[array_rand($italianNames)];
            $email = $name . '@' . $italianDomains[array_rand($italianDomains)];
            User::create(
                [
                    'name' => $name,
                    'email' => $email,
                    'password' => bcrypt('password'),
                ]
            );
        }
    }
}
