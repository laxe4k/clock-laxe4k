<?php
require_once 'assets/php/timezone.php';

// Détection de la langue
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'en', 0, 2);
$lang = in_array($lang, ['fr', 'en']) ? $lang : 'en';
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<base href="/" />
<?php require_once 'assets/php/head.php'; ?>

<body>
    <header class="timezone">
        <form action="" method="get">
            <select name="timezone" id="timezone" onchange="this.form.submit()" title="<?= $lang === 'fr' ? 'Fuseau horaire' : 'Timezone' ?>">
                <?= $options ?>
            </select>
        </form>
    </header>

    <main>
        <section class="heure">
            <h1>
                <span id="heure"><?= $date->format('H') ?></span>:<span id="minute"><?= $date->format('i') ?></span>:<span id="seconde"><?= $date->format('s') ?></span>
            </h1>
        </section>
    </main>

    <?php require_once 'assets/php/footer.php'; ?>
</body>

</html>