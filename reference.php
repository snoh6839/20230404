<?php
$fruits = [
'사과' => 10,
'배' => 5,
'수박' => 2,
'포도' => 0,
];

function checkFruit(&$fruits, $fruitName)
{
if (array_key_exists($fruitName, $fruits)) {
if ($fruits[$fruitName] > 0) {
$fruits[$fruitName] --;
echo "{$fruitName} 한 개를 꺼냈습니다. 남은 수량: {$fruits[$fruitName]}\n";
} else {
echo "{$fruitName}은(는) 더 이상 남아있지 않습니다.\n";
}
} else {
echo "{$fruitName}은(는) 존재하지 않는 과일입니다.\n";
}
}

// checkFruit($fruits, '사과');
// checkFruit($fruits, '배');
// checkFruit($fruits, '수박');
// checkFruit($fruits, '포도');
// checkFruit($fruits, '망고');

// checkFruit($fruits, '사과');
// checkFruit($fruits, '수박');
// checkFruit($fruits, '수박');

// var_dump($fruits);

?>