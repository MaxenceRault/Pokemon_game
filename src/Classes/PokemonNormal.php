<?php
namespace App\Classes;

use App\Classes\Abstract\Pokemon;
use App\Interfaces\Combattant;

class PokemonNormal extends Pokemon {
    public function capaciteSpeciale(Combattant $adversaire): void {
        // Attaque spéciale générique
        $degats = max(1, $this->puissanceAttaque - $adversaire->getDefense()) + 5;
        $adversaire->recevoirDegats($degats);
    }
}
