<?php

namespace Database\Seeders;

use App\Models\ValorationsCourt;
use App\Models\ReservationSchedule;
use App\Models\PaddleCourt;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PaddleCourtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        PaddleCourt::truncate();
        $images = [
            "https://www.padeladdict.com/wp-content/uploads/2023/06/la-guia-definitiva-para-mantener-pistas-de-padel-cubiertas-portada-1068x580.jpg",
            "https://ucjcsportsclub.es/wp-content/uploads/2015/03/padel3-1024x780.jpg",
            "https://allforpadel.com/img/cms/pistas/fx2-1.jpg",
        ];
        Storage::delete("public/images_paddle_courts");
        $images_storage = array();
        foreach($images as $image){
            $imageData = file_get_contents($image);

            $nombreArchivo = 'imagen_' . uniqid() . '.jpg';;
            Storage::put("public/images_paddle_courts/{$nombreArchivo}", $imageData);

            array_push($images_storage,"images_paddle_courts/{$nombreArchivo}");
        }

        foreach (["Pista nivel principiante", "Pista nivel intermedio", "Pista nivel avanzado"] as $pista) {

            $paddleCourt = PaddleCourt::create([
                "name" => $pista,
                "description" => "Description " . $pista . "\n Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus consequatur dolore explicabo id nam
                perferendis possimus provident quibusdam tenetur voluptates! Aut ducimus eos facere iure ratione! Ea
                molestiae optio quam! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aliquid
                blanditiis debitis dicta dignissimos earum eum facere facilis illum ratione. Animi at culpa, debitis
                eligendi harum hic maxime nobis vel.",
                "image" => $images_storage[rand(0, 2)],
                "price" => (rand(2 * 0.25, 99) + 2),
            ]);

            foreach (range(9, 21) as $hour) {
                ReservationSchedule::create([
                    "paddle_court_id" => $paddleCourt->id,
                    "hour_bookable" => $hour.":00",
                ]);
            }

            ValorationsCourt::create([
                "paddle_court_id" => $paddleCourt->id,
                "user_id" => User::inRandomOrder()->first()->id,
                "comment" => "Random comment for paddle court " . $paddleCourt->id,
                "rate" => rand(1, 5),
            ]);


        }
    }
}
