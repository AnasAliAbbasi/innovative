<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\FilmsTraits;
use GuzzleHttp\Client;
use App\Models\filmModel as Film;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class filmController extends Controller
{


    public function getFilmFromApi (Request $request) {

        // dd('sda');

       $apiEndpoint = 'http://localhost/innovativeTask-master/public/api/get/films';
       $client = new Client();
    //    try {

           $response = $client->get($apiEndpoint);
           $data = json_decode($response->getBody()->getContents());

            //dd($data->body);
           return view('welcome' , [
             'data' => $data->body
            ]);

    //    } catch (\Exception $e) {
    //        return view('welcome' , [
    //         'data' => array()
    //        ]);
    //    }

        // $films = Film::with('Genres')->paginate(1);
        // return view('welcome' , [
        //     'data' => $data->body
        // ]);

    }

    public function getIndividualFilm (Request $request , $id) {

        try{
            $d_id = Crypt::decrypt($id);
            $response = FilmsTraits::getIndividualFilm($d_id);

            if($response != null) {
                return view('film_desc' , [
                    'data' => $response
                ]);
            }
        }catch(\Exception $e){
            Session::flash('error' , 'Something Went Wrong');
            return redirect('/');
        }



    }


    public function saveComment (Request $request , $id) {

        try{

            $response = FilmsTraits::saveComment($request , $id);

            if($response != null) {
                Session::flash('success' , 'Comment Saved');
                return redirect('film/'.Crypt::encrypt($id));
            }

        }catch(\Exception $e){
            Session::flash('error' , 'Comment Not Saved');
            return redirect('film/'.Crypt::encrypt($id));
        }

    }
}
