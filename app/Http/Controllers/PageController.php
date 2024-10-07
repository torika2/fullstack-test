<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redis;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function welcomePage(): Response
    {
        return Inertia::render('./Welcome');
    }

    public function getLastData(): mixed
    {
        $data = Redis::lrange('currency',-1, 1);
        return json_decode($data[0]);
    }
}
