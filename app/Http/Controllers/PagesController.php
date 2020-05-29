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
        $curl = new Curl();
        return $curl->get('https://www.goodreads.com/search.xml', array(
            'key' => 'FD5YvIsvRnGRKmSPcZxt6g',
            'q' => urlencode($search),
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
            return $search->Search;
        } elseif (isset($search[0]->id)) {
            return $search;
        } else {
            echo "Search object or array doesn't exist";
        }
    }


    public function welcome()
    {
        return view('welcome')->with('title', 'Welcome');
    }
}
