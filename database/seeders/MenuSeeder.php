<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //$json = Storage::disk('local')->get('/json/menu.json');
        $json = file_get_contents(database_path('seeders/menu.json'));
        $menu = json_decode($json, true);

        foreach ($menu as $item) {
            DB::table('pizzas')->insert([
                'name' => $item['name'],
                'image' => $item['image'],
                'type' => $item['type'],
                'toppings' => json_encode($item['toppings']),
                'price' => $item['price'],
                'popularity' => $item['popularity'],
                'active' => $item['active']
            ]);
        }
    }
}
