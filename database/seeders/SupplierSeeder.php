<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            ['name' => 'AV Rentals Inc.', 'service_type' => 'Audio/Visual', 'contact_info' => 'av@example.com'],
            ['name' => 'Gourmet Catering', 'service_type' => 'Catering', 'contact_info' => 'catering@example.com'],
            ['name' => 'VenuePlus', 'service_type' => 'Venue Provider', 'contact_info' => 'venue@example.com'],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}

