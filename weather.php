<?php

$server = "localhost";
$username = "root";
$password = "";
$db_name = "weather_bd";
$conn = mysqli_connect($server, $username, $password, $db_name);

$sql = "SELECT * FROM weather";
$result = mysqli_query($conn, $sql);

$url_unformat = "http://api.openweathermap.org/data/2.5/weather?q=%s&units=metric&appid=%s";
$key = "e6a6818afb46366e681dc5ec29e80b3e";
$url_preformat = sprintf($url_unformat, "%s", $key);
foreach ($result as $value) {
    $url_format = sprintf($url_preformat, $value["city_name"]);
    $content = file_get_contents($url_format);
    $data = json_decode($content, true);
    print("Температура в городе ".$value["city_name"]." равна ".$data["main"]["temp"]."\n");
}