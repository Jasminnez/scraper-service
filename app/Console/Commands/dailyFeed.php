<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\feedProcess;
use Goutte\Client;
use Illuminate\Http\Request;
use App\Models\feed;

class dailyFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //feedProcess::dispatch();
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
