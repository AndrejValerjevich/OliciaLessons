<?php
error_reporting(E_ALL);
$animals = [
    'Africa'=> ['Elefant grey', 'Tiger', 'Wild Horse', 'Monkey', 'King Crocodile'],
    'Asia'=> ['Lion', 'Green frog', 'Bison'],
    'Europe'=> ['Wolf', 'Bear', 'Mouse', 'White lama', 'Antilopa gnu'],
];
$doubleWords=[];//создали массив, куда сложим животных из двух слов
$counter = 0;
foreach ($animals as $key => $continents){ //захожу в массив, где континенты
    foreach ($continents as $animal) {  //захожу в массив со значениями континентов
        $arrayAnimal[$counter] = explode(' ', $animal);//создала массив, разбив массив $animal на строки.
        $counter++;
    }}

foreach($arrayAnimal as $double) { //заходим в массив массивов
    $c = count($double); //считаем количество слов в каждом подмассиве
    if ($c == 2) {
        $doubleWords[] = $double; //если количество слова в подмассиве равно 2, то записываем это животное в новый массив
    }
}
/*Для вас, Олисия: flag можно здесь убрать, в нем нет необходимости - использовал я его больше для лучшего понимания*/

$imploded_animals = [];
foreach ($doubleWords as $value) {
    $imploded_animals[] = implode(' ', $value); //соединяем обратно в единую строку животных, которые были разбиты на два элемента массива (explode)
}

$first_words = [];
$second_words = [];

foreach ($imploded_animals as $value) {
    $first_words[] = stristr($value, ' ', true); //пишем в массив только первые части названий животных
    $second_words[] = stristr($value, ' '); //пишем в массив только вторые части названий животных
}


shuffle($first_words); //все перемешали в обоих массивах (внутри каждого)
shuffle($second_words);

$fantastic_animals = [];
$count = 0;
foreach ($first_words as $first) {
    $fantastic_animals[] = "$first" . "$second_words[$count]"; //склеиваем элементы массивов друг с другом - поэлементно - соединяем с помощью оператора конкатенации строк
    $count++;
}

?>

<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php echo "Список животных по странам:"; ?>

<?php

foreach ($animals as $countries => $real_animals) { //зашли в самый первый массив животных
    echo "<h1>$countries</h1>";//зашли в континент
    foreach ($real_animals as $real_animals_value) { //зашли в массив реальных животных (чтобы сравнить потом)
        foreach ($fantastic_animals as $fantastic_animals_value) { //зашли в массив фантастических животных (вот сейчас будем сравнивать)
            if (stristr($real_animals_value, " ", true) == stristr($fantastic_animals_value, " ", true)) //строка сравнения первых частей реальных животных и первых частей фантастических - для проверки принадлежности к континенту
            {
                echo "$fantastic_animals_value "; //выводим фантастическое животное только в том случае, если его первая часть принадлежит континенту, в который мы зашли выше(стр. 62)
            }
        }
    }
}

?>

</body>
</html>



