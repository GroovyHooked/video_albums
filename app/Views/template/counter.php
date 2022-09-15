<?php
/* Si le cookie n'existe pas */
if (!isset($_COOKIE["pictures-met-id"])) {
    $uniqId = uniqid();
    /* incrémente le compteur */
    incrementVisitCount();
    /* Enregistre un cookie sur le terminal du client */
    //setcookie("visit", true); /* expire quand le navigateur est fermé : Fin de session */
    setcookie('pictures-met-id', $uniqId, 31536000, '/'); /* expire dans un an */
}

/* la valeur du compteur */
$count = getVisitCount();

/* Incrémente la valeur dans le fichier visit-count.txt */
function incrementVisitCount()
{
    $count = file_get_contents("visit-count.txt");
    file_put_contents("visit-count.txt", $count + 1, LOCK_EX);
}
/* récupère la valeur dans le fichier visit-count.txt */
function getVisitCount()
{
    return file_get_contents("visit-count.txt");
}



/*
$Counter = new Counter();
$ip   = $_SERVER['REMOTE_ADDR'];
$port = $_SERVER['REMOTE_PORT'];
$date = date('Y-m-d H:i:s');
$data = getData();
incrementData($data);
function getData()
{
    // On prépare les données à insérer
    $ip   = $_SERVER['REMOTE_ADDR']; // L'adresse IP du visiteur
    $agent = $_SERVER['HTTP_USER_AGENT'];
    $port = $_SERVER['REMOTE_PORT'];
    $date = date('Y-m-d H:i:s');           // La date d'aujourd'hui, sous la forme AAAA-MM-JJ
    return $ip . ' => ' . $date . '- Agent => '. $agent  . ' - Port => '. $port  . "\n";
}
function incrementData($var)
{
    // Ouvre un fichier pour lire un contenu existant
    file_get_contents('metrics.txt');
    // Ajoute une donnée
    // Écrit le résultat dans le fichier
    file_put_contents('metrics.txt', $var, FILE_APPEND);
}
 */