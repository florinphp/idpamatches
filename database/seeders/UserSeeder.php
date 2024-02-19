<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    private const TEST_USER_EMAIL = 'test.user@local.app';
    private const TEST_USER_PASSWORD = '1testing.password';
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                'email' => self::TEST_USER_EMAIL,
                'password' => bcrypt(self::TEST_USER_PASSWORD),
            ]
        );
    }

    public static function getTestUser(): array
    {
        return [
            'email' => self::TEST_USER_EMAIL,
            'password' => self::TEST_USER_PASSWORD,
        ];
    }
}
