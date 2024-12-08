<?php
require_once 'classes/Pokemon.php';
require_once 'classes/PokemonFeu.php';
require_once 'classes/PokemonEau.php';
require_once 'classes/PokemonPlante.php';
require_once 'classes/Combat.php';

function createPokemon(string $name, string $type): Pokemon {
    switch ($type) {
        case 'fire': return new PokemonFeu($name);
        case 'water': return new PokemonEau($name);
        case 'grass': return new PokemonPlante($name);
        default: throw new Exception("Seuls les types Feu, Eau, et Plante sont autorisés.");
    }
}

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['pokemon1']) || !isset($data['pokemon2'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Requête invalide.']);
    exit;
}

try {
    $pokemon1Name = $data['pokemon1'];
    $pokemon2Name = $data['pokemon2'];

    $pokemon1Data = json_decode(file_get_contents("https://pokeapi.co/api/v2/pokemon/{$pokemon1Name}"), true);
    $pokemon2Data = json_decode(file_get_contents("https://pokeapi.co/api/v2/pokemon/{$pokemon2Name}"), true);

    $pokemon1Type = $pokemon1Data['types'][0]['type']['name'];
    $pokemon2Type = $pokemon2Data['types'][0]['type']['name'];

    $pokemon1 = createPokemon($pokemon1Name, $pokemon1Type);
    $pokemon2 = createPokemon($pokemon2Name, $pokemon2Type);

    $combat = new Combat($pokemon1, $pokemon2);
    $logs = $combat->demarrerCombat();

    header('Content-Type: application/json');
    echo json_encode($logs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
