document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('countdown-form');
  const minutesInput = document.getElementById('countdown-minutes');
  const display = document.getElementById('countdown-display');
  let timer = null;

  if (!form || !minutesInput || !display) {
    return;
  }

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const minutes = parseInt(minutesInput.value, 10);
    if (isNaN(minutes) || minutes <= 0) {
      return;
    }

    const end = Date.now() + minutes * 60000;
    clearInterval(timer);
    update();
    timer = setInterval(update, 1000);

    function update() {
      const diff = end - Date.now();
      if (diff <= 0) {
        clearInterval(timer);
        display.textContent = '00:00:00';
        return;
      }
      const hrs = Math.floor(diff / 3600000);
      const mins = Math.floor((diff % 3600000) / 60000);
      const secs = Math.floor((diff % 60000) / 1000);
      display.textContent =
        String(hrs).padStart(2, '0') + ':' +
        String(mins).padStart(2, '0') + ':' +
        String(secs).padStart(2, '0');
    }
  });
});

