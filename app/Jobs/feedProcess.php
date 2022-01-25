<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Goutte\Client;
use Illuminate\Http\Request;
use App\Models\feed;

class feedProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $links = array("TWTR", "AAPL", "INTC");
        foreach($links as $link){
        $client = new Client();
        $url = "https://feeds.finance.yahoo.com/rss/2.0/headline?s=$link&region=US&lang=en-US";
        echo $url;
        $page = $client->request('GET', $url);
        $res[] = $page->filter('item')->each(function ($item){
           $feed = new feed;
           $feed->title = $item->filter('title')->text();
           $feed->published_date = $item->filter('pubDate')->text();
           $feed->guid = $item->filter('guid')->text();
           $feed->link = $item->filter('link')->text();
           $feed->description = $item->filter('description')->text();
           $feed->save();
        });  
     }
    }
}
