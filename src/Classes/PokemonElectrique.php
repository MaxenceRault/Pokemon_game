<?php
namespace App\Classes;

use App\Classes\Abstract\Pokemon;
use App\Interfaces\Combattant;

class PokemonElectrique extends Pokemon {
    public function capaciteSpeciale(Combattant $adversaire): void {
        // Eclair : bonus contre Eau (exemple)
        $bonus = 0;
        if ($adversaire->getType() === 'eau' || $adversaire->getType() === 'vol') {
            $bonus = 50;
        }
        $degats = max(1, ($this->puissanceAttaque + $bonus) - $adversaire->getDefense());
        $adversaire->recevoirDegats($degats);
    }
}
