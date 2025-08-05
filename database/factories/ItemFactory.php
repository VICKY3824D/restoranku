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
                    'Pepperoni Pizza',
                    'Margherita Pizza',
                    'Chicken Kebab',
                    'Beef Kebab',
                    'Cheeseburger',
                    'Chicken Burger',
                    'Caesar Salad',
                    'Greek Salad'
                ]),
                'img' => fake()->randomElement([
                    // Pizza
                    'https://images.unsplash.com/photo-1513104890138-7c749659a591',
                    'https://images.unsplash.com/photo-1571066811602-716837d681de',

                    // Kebab
                    'https://images.unsplash.com/photo-1601050690597-df0568f70950',
                    'https://images.unsplash.com/photo-1631898034273-8a9d1f6dc9e1',

                    // Burger
                    'https://images.unsplash.com/photo-1568901346375-23c9450c58cd',
                    'https://images.unsplash.com/photo-1571091718767-18b5b1457add',

                    // Salad
                    'https://images.unsplash.com/photo-1546793665-c74683f339c1',
                    'https://images.unsplash.com/photo-1512621776951-a57141f2eefd'
                ]),
                'category_id' => 1
            ],

            // Minuman (category_id = 2)
            [
                'name' => fake()->randomElement([
                    'Cola Soda',
                    'Lemon Soda',
                    'Orange Juice',
                    'Iced Tea',
                    'Mineral Water',
                    'Coffee Latte'
                ]),
                'img' => fake()->randomElement([
                    // Soda/Jus
                    'https://images.unsplash.com/photo-1554866585-cd94860890b7',
                    'https://images.unsplash.com/photo-1625772452859-1c03d5bf1137',

                    // Minuman lainnya
                    'https://images.unsplash.com/photo-1437419764061-2473afe69fc2',
                    'https://images.unsplash.com/photo-1564890369478-c89ca6d9cde9',
                    'https://images.unsplash.com/photo-1558160074-4d7d8bdf4256',
                    'https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5'
                ]),
                'category_id' => 2
            ]
        ];

        $selectedCategory = fake()->randomElement($foodData);

        return [
            'name' => $selectedCategory['name'],
            'category_id' => $selectedCategory['category_id'],
            'price' => fake()->randomFloat(2, 1000, 10000),
            'description' => fake()->text(),
            'img' => $selectedCategory['img'],
            'is_active' => fake()->boolean(),
        ];
    }
}
