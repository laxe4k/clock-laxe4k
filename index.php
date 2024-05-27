<?php require_once 'assets/php/timezone.php'; ?>
<!DOCTYPE html>
<html lang="<?php if (substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) ?? 'en' === 'fr') {
                echo 'fr';
            } else {
                echo 'en';
            } ?>">
<base href="/">
<?php require_once 'assets/php/head.php'; ?>

<body>
    <header class="timezone">
        <form action="" method="get">
            <select name="timezone" id="timezone" onchange="this.form.submit()" title="
            <?php if (substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) ?? 'en' === 'fr') {
                echo 'Fuseau horaire';
            } else {
                echo 'Timezone';
            } ?>">
                <?php echo $options; ?>
            </select>
        </form>
    </header>
    <main>
        <section class="heure">
            <h1><span id="heure"><?php echo $date->format('H'); ?></span>:<span id="minute"><?php echo $date->format('i'); ?></span>:<span id="seconde"><?php echo $date->format('s'); ?></span></h1>
        </section>
    </main>
    <?php require_once 'assets/php/footer.php'; ?>
</body>

</html>