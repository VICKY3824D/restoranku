<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        Item::factory(7)->create();

            $indonesianFoods = [
                [
                    'name' => 'Kopi Tubruk',
                    'description' => 'Kopi khas Indonesia diseduh langsung dengan bubuk kopi',
                    'price' => 10000,
                    'category_id' => 2,
                    'img' => 'https://images.unsplash.com/photo-1564890369478-c89ca6d9cde9',
                    'is_active' => true,
                    'deleted_at' => null,
                    'created_at' => '2025-08-10 13:55:32',
                    'updated_at' => '2025-08-10 13:55:32'
                ],
                [
                    'name' => 'Pecel Pincuk',
                    'description' => 'Pecel pincuk berasal dari madiun',
                    'price' => 10000,
                    'category_id' => 1,
                    'img' => '1754808932.jpg',
                    'is_active' => true,
                    'deleted_at' => null,
                    'created_at' => '2025-08-10 13:55:32',
                    'updated_at' => '2025-08-10 13:55:32'
                ],
            ];

            DB::table('items')->insert($indonesianFoods);

    }


}
