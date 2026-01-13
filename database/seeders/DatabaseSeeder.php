<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🌱 Starting database seeding...');

        // ===============================
        // ADMIN (1x SAJA)
        // ===============================
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );
        $this->command->info('✅ Admin user ready');

        // ===============================
        // CUSTOMER DUMMY (BOLEH)
        // ===============================
        User::factory(10)->create(['role' => 'customer']);
        $this->command->info('✅ 10 customer users created');

        // ===============================
        // DATA REAL TOKO (WAJIB SEEDER)
        // ===============================
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);

        $this->command->newLine();
        $this->command->info('🎉 Database seeding completed!');
        $this->command->info('📧 Admin login: admin@example.com / password');
    }
}
