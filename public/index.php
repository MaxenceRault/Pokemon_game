<?php
require_once __DIR__ . '/../src/bootstrap.php';

use App\Classes\Database;

// Récupération des données des Pokémon depuis la base de données
$pokemons = Database::getAllPokemons();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Pokemon Combat</title>
    <link rel="stylesheet" href="assets/css/home.css">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Liste des Pokémon disponibles passée depuis PHP au JavaScript
            const pokemons = <?= json_encode($pokemons) ?>;

            // Récupération des éléments du DOM pour les sélections et affichages
            const pokemon1Select = document.getElementById('pokemon1');
            const pokemon2Select = document.getElementById('pokemon2');
            const pokemon1Info = document.getElementById('pokemon1-info');
            const pokemon2Info = document.getElementById('pokemon2-info');
            const hiddenPokemon1 = document.getElementById('selected-pokemon1');
            const hiddenPokemon2 = document.getElementById('selected-pokemon2');

            // Met à jour les informations affichées pour le Pokémon sélectionné
            function updatePokemonInfo(pokemonId, infoElement) {
                const selectedPokemon = pokemons.find(p => p.id == pokemonId);
                if (selectedPokemon) {
                    // Génération dynamique du contenu HTML pour les infos
                    infoElement.innerHTML = `
                        <img src="${selectedPokemon.sprite}" alt="${selectedPokemon.nom}">
                        <h3>${selectedPokemon.nom} (${selectedPokemon.type})</h3>
                        <p>Points de vie: ${selectedPokemon.pointsDeVie}</p>
                    `;
                } else {
                    infoElement.innerHTML = `<p>Sélectionnez un Pokémon</p>`;
                }
            }

            // Gestion du changement pour Pokémon 1
            pokemon1Select.addEventListener('change', function () {
                updatePokemonInfo(this.value, pokemon1Info);
                hiddenPokemon1.value = this.value; // Met à jour le champ caché
            });

            // Gestion du changement pour Pokémon 2
            pokemon2Select.addEventListener('change', function () {
                updatePokemonInfo(this.value, pokemon2Info);
                hiddenPokemon2.value = this.value; // Met à jour le champ caché
            });

            // Initialisation des informations par défaut (premiers éléments dans les listes déroulantes)
            updatePokemonInfo(pokemon1Select.value, pokemon1Info);
            updatePokemonInfo(pokemon2Select.value, pokemon2Info);

            // Initialisation des champs cachés pour le formulaire
            hiddenPokemon1.value = pokemon1Select.value;
            hiddenPokemon2.value = pokemon2Select.value;
        });
    </script>
</head>

<body>
    <h1>Choisissez vos Pokémon</h1>

    <div class="selection-screen">
        <!-- Zone de sélection pour le joueur -->
        <div class="selection-area">
            <h2>Pokémon 1 (Joueur)</h2>
            <select name="pokemon1" id="pokemon1">
                <?php foreach ($pokemons as $p): ?>
                    <option value="<?= $p['id'] ?>"><?= $p['nom'] ?> (<?= $p['type'] ?>)</option>
                <?php endforeach; ?>
            </select>
            <div id="pokemon1-info" class="pokemon-info"></div>
        </div>

        <!-- Zone de sélection pour l'adversaire -->
        <div class="selection-area">
            <h2>Pokémon 2 (Adversaire)</h2>
            <select name="pokemon2" id="pokemon2">
                <?php foreach ($pokemons as $p): ?>
                    <option value="<?= $p['id'] ?>"><?= $p['nom'] ?> (<?= $p['type'] ?>)</option>
                <?php endforeach; ?>
            </select>
            <div id="pokemon2-info" class="pokemon-info"></div>
        </div>
    </div>

    <!-- Formulaire pour confirmer la sélection -->
    <form action="choix_attaques.php" method="get" class="pokemon-selection-form">
        <!-- Champs cachés pour transmettre les ID des Pokémon sélectionnés -->
        <input type="hidden" name="pokemon1" id="selected-pokemon1" value="<?= $pokemons[0]['id'] ?>">
        <input type="hidden" name="pokemon2" id="selected-pokemon2" value="<?= $pokemons[1]['id'] ?>">
        <button type="submit">Confirmer la sélection</button>
    </form>
</body>

</html>
