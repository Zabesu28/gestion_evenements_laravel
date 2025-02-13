<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MonsterService
{
    /**
     * Get the list of monsters from MHW-DB API.
     *
     * @return array
     */
    public function getMonsters()
    {
        $response = Http::withoutVerifying()->get('https://mhw-db.com/monsters');
        
        // Vérifie si la requête est réussie
        if ($response->successful()) {
            return $response->json();
        }

        return [];
    }
}