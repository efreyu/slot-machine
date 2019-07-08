<?php

use Illuminate\Database\Seeder;
use App\Gift;
use App\Item;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fillableItems['Balance'][] = [
            'name' => 'money',
            'cost' => null,
        ];
        $fillableItems['Bonus'][] = [
            'name' => 'bonus',
            'cost' => null,
        ];
        $fillableItems['Item'] = [
            [
                'name' => 'LG smartTV',
                'cost' => 300,
            ],
            [
                'name' => 'Microsoft Xbox One S',
                'cost' => 250,
            ],
            [
                'name' => 'Playstation 4 Slim',
                'cost' => 220,
            ],
            [
                'name' => 'iPhone6',
                'cost' => 310,
            ],
            [
                'name' => 'Samsung Gear s3',
                'cost' => 150,
            ],
        ];
        $giftComments = [
            'Balance' => [
                'comment' => 'You have won a cash prize!',
                'min' => 10,
                'max' => 1000,
            ],
            'Bonus' => [
                'comment' => 'You won bonuses!',
                'min' => 10,
                'max' => 1000,
            ],
            'Item' => [
                'comment' => 'You have won a unique prize! You can order delivery in your account.',
                'min' => 1,
                'max' => 1,
            ],
        ];

        foreach ($fillableItems as $type => $items) {
            $gift = new Gift;
            if (array_key_exists($type, $giftComments)) {
                $gift->comment = $giftComments[$type]['comment'];
                $gift->min_count = $giftComments[$type]['min'];
                $gift->max_count = $giftComments[$type]['max'];
            }
            $gift->save();

            foreach ($items as $item) {
                $element = new Item;
                $element->name = $item['name'];
                $element->type = $type;
                $element->cost = $item['cost'];
                $element->save();

                $gift->items()->attach($element->id);
            }
        }
    }
}
