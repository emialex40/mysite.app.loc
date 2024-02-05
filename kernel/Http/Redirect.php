<?php

namespace App\Kernel\Http;

class Redirect
{
    public function to(string $url)
    {
        header(header: "Location: $url");
        exit;
    }
}