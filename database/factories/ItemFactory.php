<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    public function definition(): array
    {
        $foodData = [
            // Makanan (category_id = 1)
            [
                'name' => fake()->randomElement([
                    'Nasi Goreng Special',
                    'Mie Goreng Jawa',
                    'Sate Ayam Madura',
                    'Sate Kambing',
                    'Rendang Daging',
                    'Ayam Bakar Bumbu Rujak',
                    'Gado-gado',
                    'Soto Ayam',
                    'Bakso Urat',
                    'Pempek Kapal Selam',
                    'Nasi Padang',
                    'Lontong Sayur',
                    'Rawon Daging',
                    'Sop Buntut',
                    'Tahu Tek',
                    'Ketoprak'
                ]),
                'img' => fake()->randomElement([
                    // Nasi Goreng/Mie Goreng
                    'https://images.unsplash.com/photo-1585032226651-759b368d7246',
                    'https://images.unsplash.com/photo-1551504734-5ee1c4a1479b',

                    // Sate
                    'https://images.unsplash.com/photo-1551504734-5ee1c4a1479b',
                    'https://images.unsplash.com/photo-1563245372-f21724e3856d',

                    // Rendang/Ayam
                    'https://images.unsplash.com/photo-1563245372-f21724e3856d',
                    'https://images.unsplash.com/photo-1585032226651-759b368d7246',

                    // Gado-gado/Soto
                    'https://images.unsplash.com/photo-1551504734-5ee1c4a1479b',
                    'https://images.unsplash.com/photo-1563245372-f21724e3856d',

                    // Bakso/Pempek
                    'https://images.unsplash.com/photo-1585032226651-759b368d7246',
                    'https://images.unsplash.com/photo-1551504734-5ee1c4a1479b'
                ]),
                'category_id' => 1
            ],

            // Minuman (category_id = 2)
            [
                'name' => fake()->randomElement([
                    'Es Teh Manis',
                    'Es Jeruk',
                    'Es Kelapa Muda',
                    'Es Campur',
                    'Es Dawet',
                    'Wedang Jahe',
                    'Bajigur',
                    'Bandrek',
                    'Es Cendol',
                    'Es Teler',
                    'Kopi Tubruk',
                    'Teh Tarik',
                    'Es Kopi Susu',
                    'Bir Pletok'
                ]),
                'img' => fake()->randomElement([
                    // Es Teh/Jeruk
                    'https://images.unsplash.com/photo-1564890369478-c89ca6d9cde9',
                    'https://images.unsplash.com/photo-1437419764061-2473afe69fc2',

                    // Es Kelapa/Cendol
                    'https://images.unsplash.com/photo-1558160074-4d7d8bdf4256',
                    'https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5',

                    // Minuman Hangat
                    'https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5',
                    'https://images.unsplash.com/photo-1558160074-4d7d8bdf4256',

                    // Kopi/Teh
                    'https://images.unsplash.com/photo-1564890369478-c89ca6d9cde9',
                    'https://images.unsplash.com/photo-1437419764061-2473afe69fc2'
                ]),
                'category_id' => 2
            ]
        ];

        $selectedCategory = fake()->randomElement($foodData);

        return [
            'name' => $selectedCategory['name'],
            'category_id' => $selectedCategory['category_id'],
            'price' => fake()->randomFloat(2, 5000, 50000), // Adjusted price range for Indonesian food
            'description' => $this->generateIndonesianDescription($selectedCategory['name']),
            'img' => $selectedCategory['img'],
            'is_active' => fake()->boolean(90), // 90% chance of being active
        ];
    }

    protected function generateIndonesianDescription(string $foodName): string
    {
        $descriptions = [
            'Nasi Goreng Special' => 'Nasi goreng spesial dengan campuran ayam, udang, dan sayuran, disajikan dengan telur mata sapi dan kerupuk',
            'Mie Goreng Jawa' => 'Mie goreng khas Jawa dengan bumbu rempah yang kaya, ditambah sayuran dan telur',
            'Sate Ayam Madura' => 'Sate ayam khas Madura dengan bumbu kacang yang kental dan legit',
            'Sate Kambing' => 'Sate daging kambing muda yang empuk dengan bumbu kecap dan rempah',
            'Rendang Daging' => 'Daging sapi dimasak perlahan dengan bumbu rempah khas Minang sampai empuk dan meresap',
            'Ayam Bakar Bumbu Rujak' => 'Ayam bakar dengan bumbu rujak yang pedas manis khas Jawa',
            'Gado-gado' => 'Salad sayuran khas Indonesia dengan saus kacang yang gurih',
            'Soto Ayam' => 'Sup ayam dengan kuah kuning yang harum rempah, disajikan dengan nasi atau lontong',
            'Bakso Urat' => 'Bakso daging dengan tekstur kenyal berisi urat sapi yang gurih',
            'Pempek Kapal Selam' => 'Pempek Palembang berisi telur ayam dengan kuah cuko yang asam manis',
            'Nasi Padang' => 'Nasi putih dengan berbagai lauk pilihan khas Minangkabau',
            'Lontong Sayur' => 'Lontong dengan sayur labu siam dalam kuah santan yang gurih',
            'Rawon Daging' => 'Sup daging dengan kuah hitam dari keluwek khas Jawa Timur',
            'Sop Buntut' => 'Sup buntut sapi dengan kuah bening yang gurih',
            'Tahu Tek' => 'Tahu dan lontong dengan saus kacang, telur, dan sayuran khas Surabaya',
            'Ketoprak' => 'Makanan khas Jakarta terdiri dari tahu, bihun, dan sayuran dengan saus kacang',
            'Es Teh Manis' => 'Es teh dengan gula yang menyegarkan',
            'Es Jeruk' => 'Es jeruk segar dengan potongan buah jeruk',
            'Es Kelapa Muda' => 'Es dari air kelapa muda asli dengan daging kelapa',
            'Es Campur' => 'Campuran berbagai buah dan jelly dengan sirup dan susu',
            'Es Dawet' => 'Minuman khas Jawa dengan cendol, santan, dan gula merah',
            'Wedang Jahe' => 'Minuman jahe hangat dengan gula aren yang menghangatkan badan',
            'Bajigur' => 'Minuman hangat khas Sunda dari gula aren dan santan',
            'Bandrek' => 'Minuman rempah hangat khas Jawa Barat',
            'Es Cendol' => 'Minuman tradisional dengan cendol, santan, dan gula merah',
            'Es Teler' => 'Es campur dengan alpukat, kelapa, nangka, dan susu',
            'Kopi Tubruk' => 'Kopi khas Indonesia diseduh langsung dengan bubuk kopi',
            'Teh Tarik' => 'Teh susu khas Melayu yang ditarik untuk menghasilkan busa',
            'Es Kopi Susu' => 'Campuran kopi kuat dengan susu dan es batu',
            'Bir Pletok' => 'Minuman tradisional Betawi yang menyegarkan tanpa alkohol'
        ];

        return $descriptions[$foodName] ?? 'Makanan/minuman khas Indonesia yang lezat dan autentik';
    }
}
