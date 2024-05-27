<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compte à rebours : </title>
</head>

<body>
    <div>
        <h1 id="title">Fin du compte à rebours : <span id="end"></span></h1>
    </div>
    <div>
        <p>Heure actuelle</p>
        <p id="start"></p>
        <br>
        <p>Temps restant</p>
        <p id="time"></p>
    </div>
    <script>
        function countdown() {
            const start = new Date();
            const end = new Date();
            end.setHours(16);
            end.setMinutes(30);
            end.setSeconds(0);
            const now = new Date();
            const diff = new Date(end - now);

            if (diff <= 0) {
                document.getElementById('time').innerHTML = '00:00:00';
                document.getElementById('start').innerHTML = start.toLocaleTimeString();
                document.getElementById('end').innerHTML = end.toLocaleTimeString();
                document.title = 'Compte à rebours : 00:00:00';
                return;
            }

            const hours = Math.floor(diff / 3600000);
            const minutes = Math.floor(diff / 60000) % 60;
            const seconds = Math.floor(diff / 1000) % 60;

            document.getElementById('start').innerHTML = start.toLocaleTimeString();
            document.getElementById('end').innerHTML = end.toLocaleTimeString();
            document.getElementById('time').innerHTML = formatTime(hours) + ':' + formatTime(minutes) + ':' + formatTime(seconds);
            document.title = 'Compte à rebours : ' + formatTime(hours) + ':' + formatTime(minutes) + ':' + formatTime(seconds);
        }

        function formatTime(time) {
            return time < 10 ? '0' + time : time;
        }

        setInterval(countdown, 1000);
        countdown();
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        #title {
            text-align: center;
            font-size: 2em;
            margin-bottom: 1em;
        }

        div {
            text-align: center;
            margin-bottom: 1em;
        }

        p {
            margin: 0;
            font-size: 1.2em;
        }

        #start,
        #time {
            font-size: 1.5em;
        }
    </style>
</body>

</html>