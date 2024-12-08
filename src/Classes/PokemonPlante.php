<?php
namespace App\Classes;

use App\Classes\Abstract\Pokemon;
use App\Interfaces\Combattant;

class PokemonPlante extends Pokemon {
    public function capaciteSpeciale(Combattant $adversaire): void {
        // Fouet-Lianes: bonus contre Eau
        $bonus = 0;
        if ($adversaire->getType() === 'eau') {
            $bonus = 10;
        }
        $degats = max(1, ($this->puissanceAttaque + $bonus) - $adversaire->getDefense());
        $adversaire->recevoirDegats($degats);
    }
}
