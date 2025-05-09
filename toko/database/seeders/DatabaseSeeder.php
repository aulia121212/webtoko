<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            \Database\Seeders\CategoriesTableSeeder::class,
            \Database\Seeders\ProductsTableSeeder::class,
           
          
        ]);
    }
}

// jalankan di terminal => php artisan db:seed 