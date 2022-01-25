<?php

namespace App\Http\Controllers;

use App\Jobs\feedProcess;
use Goutte\Client;
use Illuminate\Http\Request;
use App\Models\feed;

class ScraperController extends Controller
{
    //
    //private $results = array();

    public function load(){
        $feed = feed::all();
        foreach($feed as $row)
        {
         $data[] = array(
          'id'   => $row["id"],
          'title'   => $row["title"],
          'start'   => $row["published_date"]
         );
        }

        echo json_encode($data);
    }

    public function scraper()
    {
        return view ('scraper');
    }
}
