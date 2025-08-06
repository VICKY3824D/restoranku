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
                'name' => 'Nasi Goreng Special',
                'category_id' => 1,
                'price' => 25000,
                'description' => 'Nasi goreng spesial dengan ayam, udang, telur mata sapi, dan kerupuk',
                'img' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246',
                'is_active' => true
            ],
            [
                'name' => 'Sate Ayam Madura',
                'category_id' => 1,
                'price' => 30000,
                'description' => 'Sate ayam khas Madura dengan bumbu kacang dan lontong',
                'img' => 'https://images.unsplash.com/photo-1551504734-5ee1c4a1479b',
                'is_active' => true
            ],
            [
                'name' => 'Rendang Daging',
                'category_id' => 1,
                'price' => 35000,
                'description' => 'Daging sapi dimasak perlahan dengan rempah khas Minang sampai empuk',
                'img' => 'https://images.unsplash.com/photo-1563245372-f21724e3856d',
                'is_active' => true
            ],
            [
                'name' => 'Gado-gado',
                'category_id' => 1,
                'price' => 20000,
                'description' => 'Salad sayuran dengan saus kacang, telur, dan kerupuk',
                'img' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c',
                'is_active' => true
            ],
            [
                'name' => 'Soto Ayam',
                'category_id' => 1,
                'price' => 22000,
                'description' => 'Sup ayam dengan kuah kuning berempah, disajikan dengan nasi',
                'img' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624',
                'is_active' => true
            ],
            [
                'name' => 'Bakso Urat',
                'category_id' => 1,
                'price' => 18000,
                'description' => 'Bakso daging dengan tekstur kenyal berisi urat sapi',
                'img' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246',
                'is_active' => true
            ],
            [
                'name' => 'Ayam Bakar Bumbu Rujak',
                'category_id' => 1,
                'price' => 32000,
                'description' => 'Ayam bakar dengan bumbu pedas manis khas Jawa',
                'img' => 'https://images.unsplash.com/photo-1563245372-f21724e3856d',
                'is_active' => true
            ],
            [
                'name' => 'Rawon Daging',
                'category_id' => 1,
                'price' => 35000,
                'description' => 'Sup daging dengan kuah hitam dari keluwek khas Jawa Timur',
                'img' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246',
                'is_active' => true
            ],
            [
                'name' => 'Es Teh Manis',
                'category_id' => 2,
                'price' => 8000,
                'description' => 'Es teh dengan gula yang menyegarkan',
                'img' => 'https://images.unsplash.com/photo-1564890369478-c89ca6d9cde9',
                'is_active' => true
            ],
            [
                'name' => 'Es Jeruk',
                'category_id' => 2,
                'price' => 10000,
                'description' => 'Es jeruk segar dengan potongan buah jeruk',
                'img' => 'https://images.unsplash.com/photo-1437419764061-2473afe69fc2',
                'is_active' => true
            ],
            [
                'name' => 'Es Kelapa Muda',
                'category_id' => 2,
                'price' => 15000,
                'description' => 'Es dari air kelapa muda asli dengan daging kelapa',
                'img' => 'https://images.unsplash.com/photo-1558160074-4d7d8bdf4256',
                'is_active' => true
            ],
            [
                'name' => 'Wedang Jahe',
                'category_id' => 2,
                'price' => 12000,
                'description' => 'Minuman jahe hangat dengan gula aren yang menghangatkan',
                'img' => 'https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5',
                'is_active' => true
            ],
            [
                'name' => 'Kopi Tubruk',
                'category_id' => 2,
                'price' => 10000,
                'description' => 'Kopi khas Indonesia diseduh langsung dengan bubuk kopi',
                'img' => 'https://images.unsplash.com/photo-1564890369478-c89ca6d9cde9',
                'is_active' => true
            ],
            [
                'name' => 'Es Cendol',
                'category_id' => 2,
                'price' => 13000,
                'description' => 'Minuman tradisional dengan cendol, santan, dan gula merah',
                'img' => 'https://images.unsplash.com/photo-1558160074-4d7d8bdf4256',
                'is_active' => true
            ],
            [
                'name' => 'Bir Pletok',
                'category_id' => 2,
                'price' => 15000,
                'description' => 'Minuman tradisional Betawi yang menyegarkan tanpa alkohol',
                'img' => 'https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5',
                'is_active' => true
            ]
        ];

            DB::table('items')->insert($indonesianFoods);

    }


}
