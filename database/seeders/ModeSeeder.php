<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mode;

class ModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $modes = [
            [
                'name' => 'easy',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'medium',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),],
            [
                'name' => 'hard',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach($modes as $mode){
            Mode::insert($mode);
        }

       
    }
}
