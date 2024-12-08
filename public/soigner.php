<?php
session_start();
require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/Classes/utils.php';

use App\Classes\Combat;

if (!isset($_SESSION['combat'])) {
    echo "Pas de combat en cours";
    exit;
}

/** @var Combat $combat */
$combat = unserialize($_SESSION['combat']);

// Détermine s'il y a un vainqueur
$vainqueur = $combat->determinerVainqueur();
if ($vainqueur) {
    // Identifie le perdant (l'autre Pokémon est KO)
    $perdant = $combat->getPokemon1()->estKO() ? $combat->getPokemon1() : $combat->getPokemon2();

    // Si une méthode de soin existe dans vos classes Pokémon, utilisez-la directement
    // Exemple : $perdant->soigner();

    // Sinon, on peut restaurer les PV à leur maximum directement
    $perdant->recevoirSoin($perdant->getPointsDeVieMax() - $perdant->getPointsDeVie());

    echo "Le perdant a été soigné.";
} else {
    echo "Pas de vainqueur, le combat n'est pas encore terminé.";
}
