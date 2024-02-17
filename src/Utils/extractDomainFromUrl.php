<?php


namespace App\Utils;

class extractDomainFromUrl
{
    public static function extractDomainFromUrl($url)
    {
        $parsedUrl = parse_url($url);
        return $parsedUrl['host'] ?? '';
    }
}