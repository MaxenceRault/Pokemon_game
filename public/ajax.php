<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/Classes/utils.php';

use App\Classes\Combat;

// Vérifie qu'un combat est en cours
if (!isset($_SESSION['combat'])) {
    echo json_encode(['error' => 'No combat session']);
    exit;
}

// Récupération de l'objet Combat
$combat = unserialize($_SESSION['combat']);

$action = $_GET['action'] ?? '';
$attaqueChoisie = (int)($_GET['attaque'] ?? 0);

if ($action === 'tour') {
    $p1 = $combat->getPokemon1(); // Pokémon du joueur
    $p2 = $combat->getPokemon2(); // Pokémon adverse

    $log = []; // Historique des actions pour ce tour

    // Attaque du joueur
    $log[] = $p1->utiliserAttaqueSur($p2, $attaqueChoisie);

    // Vérifie si le Pokémon 2 est KO
    if ($p2->estKO()) {
        $log[] = "{$p2->getNom()} est K.O.!";
        finCombat($log, $combat);
        exit;
    }

    // Attaque aléatoire de l'adversaire
    $attaquesAdversaire = $p2->getAttaques();
    $indexAleatoire = array_rand($attaquesAdversaire);
    $log[] = $p2->utiliserAttaqueSur($p1, $indexAleatoire);

    // Vérifie si le Pokémon 1 est KO
    if ($p1->estKO()) {
        $log[] = "{$p1->getNom()} est K.O.!";
        finCombat($log, $combat);
        exit;
    }

    // Combat non terminé, on met à jour l'état
    $_SESSION['combat'] = serialize($combat);

    echo json_encode([
        'log' => $log,
        'pv1' => $p1->getPointsDeVie(),
        'pv2' => $p2->getPointsDeVie(),
        'vainqueur' => null,
    ]);
    exit;
}

// Gère la fin du combat
function finCombat(array $log, Combat $combat) {
    $vainqueur = $combat->determinerVainqueur();
    $_SESSION['combat'] = serialize($combat); // Sauvegarde de l'état final
    echo json_encode([
        'log' => $log,
        'pv1' => $combat->getPokemon1()->getPointsDeVie(),
        'pv2' => $combat->getPokemon2()->getPointsDeVie(),
        'vainqueur' => $vainqueur ? $vainqueur->getNom() : null,
    ]);
}
