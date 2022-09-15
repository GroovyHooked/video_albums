<?php
//session_start();
$uniqId = uniqid();
setcookie('pictures_met_id', $uniqId, 31536000, '/');
$_COOKIE['pictures_met_id'] = $uniqId;
//echo $_COOKIE['pictures_met_id'];

if(isset($uniqId))
{
    var_dump($_COOKIE);
}
/*
if(!isset($_COOKIE['pictures_met_id'])){
    $uniqId = uniqid();
    $_SESSION['id'] = $uniqId;
    setcookie('pictures_met_id', $uniqId, 31536000, '/');
}
use App\Models\Counterbis;
function metrics2()
{
    $bdd = new Counterbis();
    $cookie = $_SESSION['id'];
    $boolIp = $bdd->doesCookieExists($cookie);
    $date = date('Y-m-d H:i:s');
    if ($boolIp) {
        $views = $bdd->getViewsWq($cookie);
        $bdd->incrementViewsWq($cookie, $views, $date);
    } else {
        $bdd = new Counterbis();
        $ip = $_SERVER['REMOTE_ADDR'];
        $port = $_SERVER['REMOTE_PORT'];
        $date = date('Y-m-d H:i:s');
        if (empty($_SERVER['HTTP_USER_AGENT'])) {
            $userAgent = 'Inconnu';
        } else {
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
        }
        $bdd->insertInCounterBis($ip, $date, 1, $port, $userAgent, $cookie);
    }
    return $cookie;
}
$foo = metrics2();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Archivo:wght@600&family=Comfortaa:wght@500&family=Quicksand:wght@600&family=Roboto+Mono&family=Ubuntu:wght@500&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url($css) ?>">
    <title><?= $title ?></title>
</head>
<body>
<pre>

</pre>
<?= $foo ?>
*/