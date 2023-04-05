<?php
//1


function printStars($rows)
{
    for ($i = 0; $i <= $rows; $i++) {
        echo '*';
    }
    echo "\n";
}

$rows = 5;


for ($i=0; $i < $rows; $i++) {
    printStars($i);
}

//2

function printStars2($rows)
{
    echo str_repeat('*', $rows) . "\n";
}

$rows = 5;

for ($i = 1; $i <= $rows; $i++) {
    printStars2($i);
}

//3

function printStars3($rows)
{
    $stars = '';

    foreach (range(1, $rows) as $i) {
        $stars .= '*';
        echo $stars . "\n";
    }
}

$rows = 5;
printStars3($rows);

//4

function printStars4($rows)
{
    $i = 1;
    $stars = '';

    while ($i <= $rows) {
        $stars .= '*';
        echo $stars . "\n";
        $i++;
    }
}

$rows = 5;
printStars4($rows);

//5
function printStars5($rows, $shape)
{
    for ($i = 0; $i <= $rows; $i++) {
        echo $shape;
    }
    echo "\n";
}

$rows = 5;
$shape = 'ㄴ';


for ($i = 0; $i < $rows; $i++) {
    printStars5($i, $shape);
}

?>