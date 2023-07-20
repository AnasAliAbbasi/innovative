<?php


namespace App\Traits;
use App\Models\filmModel as Film;
use App\Models\commentModel as Comment;
use Illuminate\Support\Facades\Auth;

class FilmsTraits {


    public static function getFilmsListing () {
        $films = Film::with('Genres')->paginate(1);
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
}
