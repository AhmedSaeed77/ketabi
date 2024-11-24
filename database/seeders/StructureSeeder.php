<?php

namespace Database\Seeders;

use App\Models\Structure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Structure::query()->updateOrCreate(
            [
                'key' => 'home',
            ],
            [
                'content' => json_encode([
                    'ar' => [],
                    'en' => []
                ]),
            ]
        );
    }
}
