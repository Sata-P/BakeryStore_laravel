<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
public function run(): void
    {
        // สร้าง User จำลอง (ถ้าต้องการ)
        User::factory(10)->create(); 

        // 👇 สั่ง call Seeder ของเรา
        $this->call([
            ProductSeeder::class,
        ]);
    }
}
