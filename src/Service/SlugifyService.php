<?php

namespace App\Service;

class SlugifyService
{
    public function generate(string $slug): string
    {
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $slug);

        $slug = strtolower($slug);

        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);

        
        $slug = trim($slug, '-');

        return $slug;
    }
}