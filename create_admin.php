<?php
/*
 * À exécuter UNE FOIS depuis le terminal, pas via le navigateur :
 * php create_admin.php
 */
declare(strict_types=1);

require_once __DIR__ . '/backend/db.php';

if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    exit("Ce script doit être exécuté en ligne de commande.\n");
}

$username = trim((string)readline("Identifiant super-admin : "));
$password = (string)readline("Mot de passe super-admin : ");

if ($username === '' || strlen($password) < 12) {
    exit("Le mot de passe doit contenir au moins 12 caractères.\n");
}

$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = db()->prepare(
    "INSERT INTO users (username, password_hash, role) VALUES (?, ?, 'super-admin')"
);
$stmt->execute([$username, $hash]);

echo "Compte super-admin créé. Supprimez ou protégez create_admin.php après utilisation.\n";
