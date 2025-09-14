<?php

namespace App\Service;

class SlugifyService
{
    public function generate(string $text): string
    {
        // Supprimer les accents
        $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);

        // Mettre en minuscules
        $text = strtolower($text);

        // Remplacer tout ce qui n’est pas lettre/chiffre par un tiret
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);

        // Supprimer les tirets en début/fin
        $text = trim($text, '-');

        return $text;
    }
}