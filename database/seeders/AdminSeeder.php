<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call(AdminSeeder::class);
        Admin::create([
            'name' => 'Ashish singh',
            'email' => 'ashish@admin.com',
            'password' => bcrypt('admin@123')
        ]);
    }
}
