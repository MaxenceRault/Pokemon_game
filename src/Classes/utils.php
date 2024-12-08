<?php
namespace App\Classes;

use App\Classes\Abstract\Pokemon;
use App\Classes\PokemonFeu;
use App\Classes\PokemonEau;
use App\Classes\PokemonPlante;
use App\Classes\PokemonNormal;
use App\Classes\PokemonElectrique;

function createPokemonInstance(array $data): Pokemon {
    switch($data['type']) {
        case 'feu': 
            return new PokemonFeu(
                $data['nom'],
                $data['type'],
                $data['pointsDeVie'],
                $data['puissanceAttaque'],
                $data['defense'],
                $data['sprite'],
                $data['sprite_back'] // Ajout de sprite_back
            );
        case 'eau': 
            return new PokemonEau(
                $data['nom'],
                $data['type'],
                $data['pointsDeVie'],
                $data['puissanceAttaque'],
                $data['defense'],
                $data['sprite'],
                $data['sprite_back']
            );
        case 'plante': 
            return new PokemonPlante(
                $data['nom'],
                $data['type'],
                $data['pointsDeVie'],
                $data['puissanceAttaque'],
                $data['defense'],
                $data['sprite'],
                $data['sprite_back']
            );
        case 'normal': 
            return new PokemonNormal(
                $data['nom'],
                $data['type'],
                $data['pointsDeVie'],
                $data['puissanceAttaque'],
                $data['defense'],
                $data['sprite'],
                $data['sprite_back']
            );
        case 'electrique': 
            return new PokemonElectrique(
                $data['nom'],
                $data['type'],
                $data['pointsDeVie'],
                $data['puissanceAttaque'],
                $data['defense'],
                $data['sprite'],
                $data['sprite_back']
            );
        default: 
            return new PokemonNormal(
                $data['nom'],
                $data['type'],
                $data['pointsDeVie'],
                $data['puissanceAttaque'],
                $data['defense'],
                $data['sprite'],
                $data['sprite_back']
            );
    }
}
