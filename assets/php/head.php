<?php
$title = "Laxe4k - Clock";

// ----------------------
// Meta
$meta = [
    "title" => $title,
    "description" => "Laxe4k - Clock, est un site web qui vous permet de voir l'heure en temps réel en fonction de votre fuseau horaire.",
    "keywords" => "Laxe4k, Clock, heure, fuseau horaire, temps réel",
    "author" => "Laxe4k",
    "robots" => "index, follow",
    "revisit-after" => "1 days",
    "viewport" => "width=device-width, initial-scale=1.0",
    "charset" => "UTF-8",
    "X-UA-Compatible" => "IE=edge"
];

// Détection de la langue
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'en', 0, 2);
$lang = in_array($lang, ['fr', 'en']) ? $lang : 'en';
?>

<head>
    <meta charset="<?= htmlspecialchars($meta['charset']) ?>">
    <meta name="viewport" content="<?= htmlspecialchars($meta['viewport']) ?>">
    <meta http-equiv="X-UA-Compatible" content="<?= htmlspecialchars($meta['X-UA-Compatible']) ?>">

    <!-- Open Graph -->
    <meta property="og:title" content="<?= htmlspecialchars($meta['title']) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.clock.laxe4k.com">
    <meta property="og:image" content="https://www.clock.laxe4k.com/assets/img/favicon.png">
    <meta property="og:description" content="<?= htmlspecialchars($meta['description']) ?>">
    <meta property="og:site_name" content="<?= htmlspecialchars($meta['title']) ?>">

    <!-- Meta classiques -->
    <meta name="description" content="<?= htmlspecialchars($meta['description']) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($meta['keywords']) ?>">
    <meta name="author" content="<?= htmlspecialchars($meta['author']) ?>">
    <meta name="robots" content="<?= htmlspecialchars($meta['robots']) ?>">
    <meta name="revisit-after" content="<?= htmlspecialchars($meta['revisit-after']) ?>">
    <meta name="language" content="<?= htmlspecialchars($lang) ?>">

    <!-- Assets -->
    <link rel="preload" href="assets/css/main.css" as="style">
    <link rel="preload" href="assets/js/update-time.js" as="script">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">

    <title><?= htmlspecialchars($meta['title']) ?></title>
</head>