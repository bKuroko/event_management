<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        $staff = [
            ['name' => 'Alice Johnson', 'contact_info' => 'alice@gmail.com', 'role' => 'Coordinator'],
            ['name' => 'Bob Smith', 'contact_info' => 'bob@gmail.com', 'role' => 'Technician'],
            ['name' => 'Carol Lee', 'contact_info' => 'carol@gmail.com', 'role' => 'Host'],
            ['name' => 'Jonh Lee', 'contact_info' => 'john@gmail.com', 'role' => 'server'],
            ['name' => 'Mark espirito', 'contact_info' => 'mark@gmail.com', 'role' => 'cook'],
            ['name' => 'zel', 'contact_info' => 'zel@gmail.com', 'role' => 'server'],
        ];

        foreach ($staff as $member) {
            Staff::create($member);
        }
    }
}
