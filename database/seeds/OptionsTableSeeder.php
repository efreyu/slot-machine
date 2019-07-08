<?php

use Illuminate\Database\Seeder;
use App\Option;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fillableData = [
            'base_ratio' => .1,
            'service_balance' => 50000,
            'winning_coefficient' => 2,
        ];
        foreach ($fillableData as $key => $val) {
            $option = new Option;
            $option->name = $key;
            $option->value = $val;
            $option->save();
        }
    }
}
