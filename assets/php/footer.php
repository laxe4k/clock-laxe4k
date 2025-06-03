<footer>
    <?php
    // On récupère les deux premières lettres de la langue du navigateur, ou 'en' par défaut si non défini
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'en', 0, 2);

    if ($lang === 'fr') : ?>
        <p>© 2022 - <?= date('Y'); ?> Laxe4k - Tous droits réservés</p>
    <?php else : ?>
        <p>© 2022 - <?= date('Y'); ?> Laxe4k - All rights reserved</p>
    <?php endif; ?>
</footer>

<script src="assets/js/toggle-display.js"></script>
<script src="assets/js/update-time.js"></script>