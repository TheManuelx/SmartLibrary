<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $categoryData = [
            'Technology' => 'book1.png',
            'Education' => 'book2.png',
            'Novel' => 'book3.png',
            'Science' => 'book4.png',
            'History' => 'book5.png',
        ];
        $statuses = ['available', 'borrowed'];
        $books = [];

        for ($i=1; $i<=30; $i++)
            {
                $categoryName = array_rand($categoryData);
                $imageName = $categoryData[$categoryName];
                $books[] = [
                    'cover_image' => $imageName,
                    'title' => "$categoryName Learning Guide $i",
                    'published_year' => rand(2018,2024),
                    'category' => $categoryName,
                    'status' => $statuses[array_rand($statuses)],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        
        $books[] = [
                'cover_image' => 'book1.png',
                'title' => 'Learn Laravel',
                'published_year' => 2024,
                'category' => 'Technology',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
        ];
        $books[] = [
                'cover_image' => 'book2.png',
                'title' => 'Basic PHP Programming',
                'published_year' => 2023,
                'category' => 'Education',
                'status' => 'borrowed',
                'created_at' => now(),
                'updated_at' => now(),
        ];
        DB::table('books')->insert($books);
    }
}
