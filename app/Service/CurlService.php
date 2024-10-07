<?php

namespace App\Service;
use Illuminate\Support\Facades\Log;

class CurlService
{
    public array $headers = [
        "Accept-Encoding:gzip, deflate, br",
        "Accept:*/*",
        "Connection:keep-alive",
        "Cache-Control:no-cache"
    ];

    public function curl(string $url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($curl, CURLOPT_POST, false);

        $result = curl_exec($curl);
        if (curl_errno($curl))
        {
            $error_msg = curl_error($curl);
            Log::error("cURL Error", ['error' => $error_msg]);
        }
        curl_close($curl);

        return json_decode($result);
    }
}
