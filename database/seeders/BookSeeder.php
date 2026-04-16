<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('books')->insert([
            [
                'cover_image' => 'book1.jpg',
                'title' => 'Learn Laravel',
                'published_year' => 2024,
                'category' => 'Technology',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cover_image' => 'book2.jpg',
                'title' => 'Basic PHP Programming',
                'published_year' => 2023,
                'category' => 'Education',
                'status' => 'borrowed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
