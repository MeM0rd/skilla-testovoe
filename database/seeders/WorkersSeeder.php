<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('workers')->insert([
            [
                'name' => 'Иван',
                'second_name' => 'Иванович',
                'surname' => 'Иванов',
                'phone' => '89001234567',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Петр',
                'second_name' => 'Петрович',
                'surname' => 'Петров',
                'phone' => '89007654321',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Сергей',
                'second_name' => 'Сергеевич',
                'surname' => 'Сергеев',
                'phone' => '89009876543',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
