<?php

namespace Database\Seeders;

use App\Models\Info;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InfosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Info::query()->updateOrCreate(['key' => 'commission'], [
            'key' => 'commission',
            'value' => '0.015',
            'type' => 'text',
            'name_en' => 'commission',
            'name_ar' => 'العموله',
        ]);
        Info::query()->updateOrCreate(['key' => 'withdrawal_after'], [
            'key' => 'withdrawal_after',
            'value' => '30',
            'type' => 'text',
            'name_en' => 'withdrawal after',
            'name_ar' => 'السحب بعد',
        ]);
        Info::query()->updateOrCreate(['key' => 'logo'], [
            'key' => 'logo',
            'type' => 'image',
            'name_en' => 'logo',
            'name_ar' => 'الشعار',
        ]);
    }
}
