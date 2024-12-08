<?php
namespace App\Classes;

use App\Classes\Abstract\Pokemon;
use App\Interfaces\Combattant;

class PokemonFeu extends Pokemon {
    public function capaciteSpeciale(Combattant $adversaire): void {
        // Lance-Flammes: bonus contre Plante
        $bonus = 0;
        if ($adversaire->getType() === 'plante') {
            $bonus = 10;
        }
        $degats = max(1, ($this->puissanceAttaque + $bonus) - $adversaire->getDefense());
        $adversaire->recevoirDegats($degats);
    }
}
