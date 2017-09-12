<?php
$city = "Bryansk";
$mode = "json";
$units = "metric";
$lang = "en";
$appid = '121508442903343fdb8b8871b8be77ec';
$countDay = 7;
$path = __DIR__.'\cashe.txt';

$url = "http://api.openweathermap.org/data/2.5/forecast/daily?appid=$appid&q=$city&mode=$mode&units=$units&cnt=$countDay&lang=$lang";

$data = file_get_contents($url); //при желании скрыть ошибки - можете вернуть собачку @
$dataJson = json_decode($data);

if(!file_exists('cashe.txt')) { //проверили, существует ли файл кеша
    $cashe = file_put_contents($path, $data); //если нет, то записали данные из сервиса в него
}

/*Оформление ниже - по вашему желанию:)*/

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    <?php if(!empty($data)){ //проверили переменную на наличие в ней данных (нужно ли будет использовать кеш)
    $arrayDays = $dataJson->list;
    foreach($arrayDays as $oneDay){ //если данные есть - берем из url ?>
        <h3>Утро: </h3> <?= $oneDay->temp->morn; ?> <br/>
        <h3>Утро: </h3> <?= $oneDay->temp->day; ?> <br/>
        <h3>Утро: </h3> <?= $oneDay->temp->eve; ?> <br/>
        <h3>Утро: </h3> <?= $oneDay->temp->night; ?> <br/>
        <h3>Утро: </h3> <?= $oneDay->speed; ?> <br/>
        <h3>Утро: </h3> <?= $oneDay->weather[0]->description; ?> <br/>
        <h3>Утро: </h3> <?= $oneDay->pressure; ?> <br/>
        <h3>Утро: </h3> <?= $oneDay->humidity; ?> <br/>
        <hr>
    <?php }
    } else {
    $data = file_get_contents($path);
    $dataJson = json_decode($data);
    $arrayDays = $dataJson->list;
    foreach($arrayDays as $oneDay){ //если в data нет данных - достаем их из cashe.txt (путь прописан в $path) ?>
    <h3>Утро: </h3> <?= $oneDay->temp->morn; ?> <br/>
    <h3>Утро: </h3> <?= $oneDay->temp->day; ?> <br/>
    <h3>Утро: </h3> <?= $oneDay->temp->eve; ?> <br/>
    <h3>Утро: </h3> <?= $oneDay->temp->night; ?> <br/>
    <h3>Утро: </h3> <?= $oneDay->speed; ?> <br/>
    <h3>Утро: </h3> <?= $oneDay->weather[0]->description; ?> <br/>
    <h3>Утро: </h3> <?= $oneDay->pressure; ?> <br/>
    <h3>Утро: </h3> <?= $oneDay->humidity; ?> <br/>
    <?php }} ?>
    </body>
</html>

