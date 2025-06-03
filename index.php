<?php
require_once 'assets/php/timezone.php';

// Détection de la langue
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'en', 0, 2);
$lang = in_array($lang, ['fr', 'en']) ? $lang : 'en';
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
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
            <div id="clock0_bg"></div>
                <time id="clock">
                    <div class="group">
                        <span id="bcdigit1" class="digit1">0</span>
                        <span id="bcdigit2" class="digit2">0</span>
                    </div>
                    <span class="sep">:</span>
                    <div class="group">
                        <span id="bcdigit3" class="digit3">0</span>
                        <span id="bcdigit4" class="digit4">0</span>
                    </div>
                    <span class="sep">:</span>
                    <div class="group">
                        <span id="bcdigit5" class="digit5">0</span>
                        <span id="bcdigit6" class="digit6">0</span>
                    </div>
                </time>
            </div>
        </section>
    </main>

    <?php require_once 'assets/php/footer.php'; ?>
</body>

</html>