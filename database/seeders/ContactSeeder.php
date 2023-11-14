<?php

namespace Database\Seeders;

use App\Models\Contact;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::truncate();
        foreach(range(1,4) as $c){
            Contact::create([
                'name'=>"User ".$c,
                'email'=>"User".$c."@email.es",
                'message'=>Factory::create()->text(250),
            ]);
        }
    }
}
