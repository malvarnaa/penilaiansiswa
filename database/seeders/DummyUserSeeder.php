<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'AAdmin',
                'username' => '123123',
                'role' => 'admin',
                'password' => bcrypt('12345678')
            ],
            [
                'name' => 'AGuru',
                'username' => '0987654321',
                'role' => 'guru',
                'password' => bcrypt('12345678')
            ],
            [
                'name' => 'BSiswa',
                'username' => '222310275',
                'role' => 'siswa',
                'password' => bcrypt('12345678')
            ],
        ];

        foreach($userData as $key => $val) {
            User::create($val);
        }
    }
}
