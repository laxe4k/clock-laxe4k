document.addEventListener('DOMContentLoaded', () => {
    const heureElement = document.querySelector('.heure');
    const header = document.querySelector('header');
    const footer = document.querySelector('footer');
    const main = document.querySelector('main');

    if (!heureElement || !header || !footer || !main) {
        console.warn('Un ou plusieurs éléments nécessaires sont introuvables.');
        return;
    }

    heureElement.addEventListener('click', () => {
        if (header.style.display === 'none') {
            // Afficher le header et le footer
            header.style.display = 'flex';
            footer.style.display = 'block';
            main.style.animation = 'OriginalBackground 0s ease-in-out forwards';

            // Sortir du mode plein écran
            if (document.fullscreenElement) {
                document.exitFullscreen?.() || document.webkitExitFullscreen?.() || document.msExitFullscreen?.();
            }
        } else {
            // Cacher le header et le footer
            header.style.display = 'none';
            footer.style.display = 'none';

            // Appliquer l'animation et passer en mode plein écran
            main.style.animation = 'changeBackground 0.3s ease-in-out forwards';
            main.requestFullscreen?.() || main.webkitRequestFullscreen?.() || main.msRequestFullscreen?.();
        }
    });
});