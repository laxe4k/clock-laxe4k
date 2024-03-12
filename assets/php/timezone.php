<?php
    // Vérifie si le paramètre 'timezone' est défini et est une timezone valide
    if(isset($_GET['timezone']) && in_array($_GET['timezone'], timezone_identifiers_list())){
        $timezone = $_GET['timezone'];
    }else{
        // Utilise l'adresse IP du client pour obtenir la timezone, sinon utilise '127.0.0.1'
        $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1';
        $json = @file_get_contents('http://ip-api.com/json/'.$ip);
        if ($json !== false) {
            $data = json_decode($json);
            // Vérifie si la timezone obtenue est valide, sinon utilise 'UTC'
            $timezone = isset($data->timezone) && in_array($data->timezone, timezone_identifiers_list()) ? $data->timezone : 'UTC';
        } else {
            $timezone = 'UTC';
        }
    }
    $timezones = array();
    // Parcourt toutes les timezones et calcule leur décalage par rapport à GMT
    foreach(timezone_identifiers_list() as $timezone_identifier){
        $datetimezone = new DateTimeZone($timezone_identifier);
        $offset = timezone_offset_get($datetimezone, new DateTime('now', $datetimezone));
        $gmt = $offset / 3600;
        $timezones[$timezone_identifier] = $gmt;
    }
    asort($timezones);
    $options = '';
    // Crée les options pour le select
    foreach($timezones as $timezone_identifier => $gmt){
        $selected = ($timezone_identifier == $timezone) ? 'selected' : '';
        $gmt = ($gmt >= 0) ? '+' . $gmt : $gmt; // Ajoute un "+" si le chiffre est positif
        $options .= "<option value='{$timezone_identifier}' {$selected}>(GMT{$gmt}) {$timezone_identifier}</option>";
    }
    $date = new DateTime('now', new DateTimeZone($timezone));
?>