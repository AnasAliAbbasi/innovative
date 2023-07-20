<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\genreModel as Genre;
use App\Models\filmModel as Film;
use App\Models\commentModel as Comment;



class filmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr = [
            '0' =>  [
                'name' => 'fiml_1' ,
                'desc' => 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available' ,
                'release_date' => date('Y-m-d') ,
                'rating' => '5',
                'price' => '500',
                'country' => 'pakistan',
                'genre' => '',
                'image' => 'photo.jpeg'
            ],
            '1' =>  [
                'name' => 'fiml_2' ,
                'desc' => 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available' ,
                'release_date' => date('Y-m-d') ,
                'rating' => '5',
                'price' => '500',
                'country' => 'pakistan',
                'genre' => '',
                'image' => 'photo-2.jpeg'
            ],
            '2' =>  [
                'name' => 'fiml_3' ,
                'desc' => 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available' ,
                'release_date' => date('Y-m-d') ,
                'rating' => '5',
                'price' => '500',
                'country' => 'pakistan',
                'genre' => '',
                'image' => 'photo-3.jpeg'
            ],

        ];

        $genre = ['thiller' , 'horror' , 'comedy'];


        foreach($arr as $item) {

            $val = (object) $item;

            $film = Film::create([
                'name' => $val->name,
                'description' => $val->desc ,
                'release_date' => $val->release_date,
                'rating' => $val->rating,
                'ticket_price' => $val->price,
                'country' => $val->country,
                'image' => $val->image,
            ]);

            foreach($genre as $val) {
                Genre::create([
                    'film_id' => $film->id,
                    'genre' => $val,
                ]);
            }

            Comment::create([
                'film_id' => $film->id,
                'name' => 'Anas',
                'comment' => 'Good Movie'
            ]);
        }

    }
}
