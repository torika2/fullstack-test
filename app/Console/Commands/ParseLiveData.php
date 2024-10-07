<?php

namespace App\Console\Commands;

use App\Events\EventDataRates;
use App\Service\CurlService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class ParseLiveData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:parse-live-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(CurlService $curlService)
    {
        $access_key = "1ebf85e97e06aa2a4c277758bf92fe18";
        $base_url = "https://api.coinlayer.com";
        $url = "$base_url/live?access_key=$access_key&target=EUR&expand=1";
        $data = $curlService->curl($url);
        Redis::setName('currency');
        Redis::command('rpush', [
            'currency', json_encode($data->rates)
        ]);
//        event(new EventDataRates($data->rates));
    }
}
