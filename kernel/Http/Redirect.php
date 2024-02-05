<?php

namespace App\Kernel\Http;

class Redirect implements RedirectInterface
{
    public function to(string $url)
    {
        header(header: "Location: $url");
        exit;
    }
}
