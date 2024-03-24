<?php

namespace App\Traits;

trait LinkShortenerTrait
{
    public function getShortenedLink($fullLink)
    {
        if($fullLink)
       { $parsedUrl = parse_url($fullLink);
        if ($parsedUrl && array_key_exists('path', $parsedUrl)) {
            $pathInfo = pathinfo($parsedUrl['path']);
    
            if (isset($pathInfo['basename'])) {
                return $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.'. $pathInfo['extension'];
            }
        }}
    
        return null;
    }
    
}
