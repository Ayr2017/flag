<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = ['Боевик','Вестерн', 'Гангстерский фильм','Детектив','Драма','Исторический','Комедия','Мелодрама','Нуар', 'Политический фильм','Приключенческий фильм','Сказка','Трагедия','Трагикомедия'];
        foreach ($genres as $genre) {
            Genre::create([
                'name'=>$genre
            ]);
        }
    }
}

// php artisan db:seed --class=GenresSeeder
