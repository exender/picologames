<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Picolo;

class PicoloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $picolos = [
            [
                'mode' => 1,
                'text' => 'Fais 15 tours sur toi même',
                'sip' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'mode' => 2,
                'text' => 'Dois passer les 5 prochaines minutes à sourire et prends une gorgée par echec',
                'sip' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),],
            [
                'mode' => 3,
                'text' => 'Fais un compliment à chaque personne qui parle',
                'sip' => 5,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach($picolos as $picolo){
            Picolo::insert($picolo);
        }
    }
}
