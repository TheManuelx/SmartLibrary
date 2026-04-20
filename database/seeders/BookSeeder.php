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
        $categories = ['Technology', 'Education', 'Novel', 'Science', 'History'];
    $categoryIds = [];

    // 1. สร้างหมวดหมู่และเก็บ ID ไว้
    foreach ($categories as $name) {
        $cat = \App\Models\Category::create(['name' => $name]);
        $categoryIds[$name] = $cat->id;
    }

    $categoryImages = [
        'Technology' => 'book1.png',
        'Education' => 'book2.png',
        'Novel' => 'book3.png',
        'Science' => 'book4.png',
        'History' => 'book5.png',
    ];

    $books = [];
    for ($i=1; $i<=30; $i++) {
        $categoryName = array_rand($categoryImages);
        $books[] = [
            'cover_image' => $categoryImages[$categoryName],
            'title' => "$categoryName Learning Guide $i",
            'published_year' => rand(2018, 2024),
            'category_id' => $categoryIds[$categoryName], // ใช้ ID แทนชื่อ
            'status' => ['available', 'borrowed'][rand(0, 1)],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    DB::table('books')->insert($books);
    }
}
