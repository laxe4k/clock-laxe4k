<?php
// Détermine la timezone
if (isset($_GET['timezone']) && in_array($_GET['timezone'], timezone_identifiers_list())) {
    $timezone = $_GET['timezone'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    $json = @file_get_contents("http://ip-api.com/json/{$ip}");
    $data = $json ? json_decode($json) : null;
    $timezone = $data->timezone ?? 'UTC';
    $timezone = in_array($timezone, timezone_identifiers_list()) ? $timezone : 'UTC';
}

// Format TXT → renvoie uniquement la timezone
if ($_GET['format'] ?? null === 'txt') {
    header('Content-Type: text/plain');
    echo $timezone;
    exit;
}

// Format JSON → renvoie la timezone et l'heure UTC
if ($_GET['format'] ?? null === 'json') {
    header('Content-Type: application/json');
    $serverTime = (new DateTime('now', new DateTimeZone('UTC')))->format('c'); // ISO 8601 UTC
    echo json_encode(['serverTime' => $serverTime, 'timezone' => $timezone]);
    exit;
}

// Génère les options pour le select des timezones
$timezones = [];
foreach (timezone_identifiers_list() as $identifier) {
    $datetimezone = new DateTimeZone($identifier);
    $offset = timezone_offset_get($datetimezone, new DateTime('now', $datetimezone));
    $gmt = $offset / 3600;
    $timezones[$identifier] = $gmt;
}
asort($timezones);

$options = '';
foreach ($timezones as $identifier => $gmt) {
    $selected = ($identifier === $timezone) ? 'selected' : '';
    $gmt = ($gmt >= 0) ? "+{$gmt}" : $gmt; // Ajoute un "+" si positif
    $options .= "<option value='{$identifier}' {$selected}>(GMT{$gmt}) {$identifier}</option>";
}

$date = new DateTime('now', new DateTimeZone($timezone));
