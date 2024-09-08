<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkersExOrderTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('workers_ex_order_types')->insert([
            [
                'worker_id' => 1, // Иван Иванов не работает с Такелажными работами
                'order_type_id' => 2, // ID для "Такелажные работы"
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'worker_id' => 2, // Петр Петров не работает с Уборкой
                'order_type_id' => 3, // ID для "Уборка"
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'worker_id' => 3, // Сергей Сергеев не работает с Погрузка/Разгрузка
                'order_type_id' => 1, // ID для "Погрузка/Разгрузка"
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
