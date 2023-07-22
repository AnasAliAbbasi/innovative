<?php


namespace App\Traits;
use App\Models\filmModel as Film;
use App\Models\commentModel as Comment;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;


class FilmsTraits {


    public static function getFilmsListing ($request) {
        $films = Film::with('Genres')->get();
        return $films;
    }

    public static function getIndividualFilm ($id) {

        $data = Film::with('Genres')->with('Comments')->where('id' , $id)->first();
        return $data;
    }

    public static function saveComment ($request , $film_id) {

        $comment = Comment::create([
            'film_id' => $film_id,
            'name' => Auth::user()->name,
            'comment' => $request->comment
        ]);
        return $comment;
    }

    public static function createMovie ($data) {


        if ($data->hasFile('image')) {
            $image = $data->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('film-images'), $imageName);
        }

        $film = Film::create([
            'name' => $data->name,
            'description' => $data->description,
            'release_date' => $data->release_date,
            'rating' => $data->rating,
            'ticket_price' => $data->ticket_price,
            'country' => $data->country,
            'image' => isset($imageName) ? $imageName : null,
        ]);

        return $film;
    }

    public static function getMovieFromRest() {

        try{

            $apiEndpoint = 'http://localhost/innovativeTask-master/public/api/get/films';
            $client = new Client();
            $response = $client->get($apiEndpoint);
            $data = json_decode($response->getBody()->getContents());

            return $data;

        }catch(\Exception $e){
            return "Api_Failed";
        }





    }
}
