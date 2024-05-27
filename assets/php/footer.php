<footer>
    <?php // si  substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) ?? 'en' est égal à 'fr' alors on affiche le texte en français sinon on affiche le texte en anglais 
    if (substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) ?? 'en' === 'fr') : ?>
        <p>© 2022 - <?php echo date('Y'); ?> Laxe4k - Tous droits réservés</p>
    <?php else : ?>
        <p>© 2022 - <?php echo date('Y'); ?> Laxe4k - All rights reserved</p>
    <?php endif; ?>
</footer>
</footer>
<script src="assets/js/update-time.js"></script>