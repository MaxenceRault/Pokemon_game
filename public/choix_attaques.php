<?php
require_once __DIR__ . '/../src/bootstrap.php';
use App\Classes\Database;

// Récupère les IDs des Pokémon sélectionnés
$pokemonId = (int) ($_GET['pokemon1'] ?? 0);
$adversaireId = (int) ($_GET['pokemon2'] ?? 0);

// Récupère les données du Pokémon sélectionné
$pokemonData = Database::getPokemonById($pokemonId);
if (!$pokemonData) {
    die("Pokémon introuvable."); // Affiche une erreur si le Pokémon est invalide
}

// Récupère les attaques disponibles pour le Pokémon sélectionné
$attaquesDisponibles = Database::getAttaquesByPokemonId($pokemonId);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Choisir les attaques</title>
    <link rel="stylesheet" href="assets/css/choix.css">
</head>
<body>
    <h1>Choisissez les attaques pour <?= htmlspecialchars($pokemonData['nom']) ?></h1>

    <form action="combat.php" method="get">
        <!-- Stockage des IDs des Pokémon dans le formulaire -->
        <input type="hidden" name="pokemon1" value="<?= $pokemonId ?>">
        <input type="hidden" name="pokemon2" value="<?= $adversaireId ?>">

        <label>Attaques disponibles :</label><br>
        <?php foreach ($attaquesDisponibles as $att): ?>
            <!-- Liste des attaques disponibles sous forme de cases à cocher -->
            <input type="checkbox" name="attaques[]" value="<?= $att['id'] ?>">
            <?= htmlspecialchars($att['nom']) ?> (Type: <?= htmlspecialchars($att['type']) ?>, Puissance:
            <?= $att['puissance'] ?>, Précision: <?= $att['prec'] * 100 ?>%)<br>
        <?php endforeach; ?>

        <br><br>
        <button type="submit">Lancer le combat</button>
    </form>
</body>
</html>
