<footer>
    <?php
    // Détection de la langue du navigateur avec fallback sur 'en'
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'en', 0, 2);
    $isFrench = $lang === 'fr';
    ?>
    <p>© 2022 - <?= date('Y'); ?> Laxe4k - <?= $isFrench ? 'Tous droits réservés' : 'All rights reserved'; ?></p>
</footer>

<!-- Chargement des scripts -->
<script src="assets/js/toggle-display.js" defer></script>
<script src="assets/js/update-time.js" defer></script>
<script src="assets/js/countdown.js" defer></script>
