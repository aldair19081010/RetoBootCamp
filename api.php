<?php


header('Content-Type: application/json');

$url = 'https://randomuser.me/api/?results=10';
$response = file_get_contents($url);
$data = json_decode($response, true);

$personas = $data['results'];

$resultado = array_map(function($p) {
    return [
        'nombre' => $p['name']['first'] . ' ' . $p['name']['last'],
        'genero' => $p['gender'],
        'ubicacion' => $p['location']['city'] . ', ' . $p['location']['country'],
        'email' => $p['email'],
        'fecha_nacimiento' => $p['dob']['date'],
        'foto' => $p['picture']['medium']
    ];
}, $personas);

echo json_encode($resultado, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
