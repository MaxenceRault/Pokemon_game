<?php
namespace App\Classes;

use App\Classes\Abstract\Pokemon;
use App\Interfaces\Combattant;

class PokemonEau extends Pokemon {
    public function capaciteSpeciale(Combattant $adversaire): void {
        // Hydrocanon: bonus contre Feu
        $bonus = 0;
        if ($adversaire->getType() === 'feu') {
            $bonus = 10;
        }
        $degats = max(1, ($this->puissanceAttaque + $bonus) - $adversaire->getDefense());
        $adversaire->recevoirDegats($degats);
    }
}
