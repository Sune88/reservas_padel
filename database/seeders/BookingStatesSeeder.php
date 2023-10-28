<?php

namespace Database\Seeders;

use App\Models\BookingState;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingStatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        BookingState::truncate();
        $estados = ["Pendiente","Cancelado","Finalizado","Reservado"];
        foreach($estados as $estado){
            BookingState::create([
                "name"=>$estado
            ]);
        }
    }
}
