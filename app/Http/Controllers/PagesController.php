<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use aharen\OMDbAPI;
use Curl\Curl;

class PagesController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => "Home",

        );

        return view('home')->with($data);
    }

    public function xmlToJson($xml_string)
    {
        $xml = simplexml_load_string($xml_string, 'SimpleXMLElement', LIBXML_NOCDATA);
        return json_decode(json_encode($xml));
    }

    public function getBooks($search)
    {
        $str = str_split($search);
        foreach ($str as $item) {
            if ($item == " ") {
                $item = "+";
            }
        }
        $str = implode($str);
        $curl = new Curl();
        return $curl->get('https://www.goodreads.com/search/index.xml', array(
            'key' => 'FD5YvIsvRnGRKmSPcZxt6g',
            'q' => $str,
        ));
    }

    public function search(Request $request)
    {

        $searchtype = $request->input('searchtype');
        $search = $request->input('userinput');

        // Search movies
        if ($searchtype == "movies") {
            $omdb = new OMDbAPI('22d5a333');
            $search = $omdb->search($search)->data;
            $details = [];
            foreach ($search->Search as $s) {
                $det = $omdb->fetch("i", $s->imdbID);
                array_push($details, $det);
            }
            $users_movies_id = DB::table('movie_users')->select('movie_id', 'status')->where('user_id', Auth::user()->id)->get();
            $users_movies = [];
            foreach ($users_movies_id as $m) {
                $obj = DB::table('movies')->where('id', $m->movie_id)->first();
                $obj->status = $m->status;
                array_push($users_movies, $obj);
            }
            $response = [
                "details" => $details,
                "usermovies" => $users_movies
            ];
            // Search books
        } elseif ($searchtype == "books") {
            $xmlresp = $this->getBooks($search);
            // echo "XML: " . var_dump($xmlresp->response);
            $response = $this->xmlToJson($xmlresp->response);
            $search = $response->search->results->work;
        }

        if (isset($search->Error)) {
            return $search->Error;
        } elseif (isset($search->Search)) {
            return $response;
        } elseif (isset($search[0]->id) or isset($search->id)) {
            return $search;
        } else {
            return "Search object or array doesn't exist";
        }
    }


    public function welcome()
    {
        return view('welcome')->with('title', 'Welcome');
    }

    public function tbd()
    {
        return view('tbd');
    }
}
