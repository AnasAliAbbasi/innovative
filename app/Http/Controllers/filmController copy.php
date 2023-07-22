<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\FilmsTraits;
use GuzzleHttp\Client;
use App\Models\filmModel as Film;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;


class filmController extends Controller
{


    public function getFilmFromApi (Request $request) : View {

        // dd('sda');

       $apiEndpoint = 'http://localhost/innovativeTask-master/public/api/get/films';
       $client = new Client();
    //    try {

           $response = $client->get($apiEndpoint);
           $dataa = json_decode($response->getBody()->getContents());


             $dataCollection = new Collection($dataa->body);
             //dd($dataCollection);

        // Extract the data from the $collection
        $data = $dataCollection->get('data'); // Assuming the key 'data' holds the items

        // Create a new LengthAwarePaginator instance with the extracted data
        $perPage = $dataCollection->get('per_page');
        $currentPage = $dataCollection->get('current_page');
        $path = $dataCollection->get('path');
        $options = [
        'path' => $path,
        ];

        $paginator = new LengthAwarePaginator(
        $data,
        $dataCollection->get('total'),
        $perPage,
        $currentPage,
        $options
        );

        // Set other properties
        $paginator->setPageName('page');
        $paginator->onEachSide(3);

       // $films = $paginator;

        $films = Film::with('Genres')->paginate(1);
       // dd($paginator);
        return view('welcome' , compact('films'));

    //    } catch (\Exception $e) {
    //        return view('welcome' , [
    //         'data' => array()
    //        ]);
    //    }

        // $films = Film::with('Genres')->paginate(1);
        // dd($films);
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

    public function AddFilm (Request $request) {
        return view('addfilm');
    }

    public function insertMovie (Request $request) {

        // try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'release_date' => 'required|date',
                'rating' => 'required|integer|min:1|max:5',
                'ticket_price' => 'required|numeric|min:0',
                'country' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $response = FilmsTraits::createMovie($request);

            if($response != null) {
                Session::flash('success' , 'Film Saved');
                return redirect('/');
            }
        // }catch(\Exception $e){
        //     Session::flash('error' , 'Someting Went Wrong');
        //     return redirect('/');
        // }




    }
}
