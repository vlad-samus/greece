<?php

$a = array(1, 2, 3, 4, 5, 6, 7, 8);
print('----<br>' . count($a) . '<br>');
foreach($a as $k => $v) var_dump($k, $v);
print('----<br>');

unset($a[2]);
array_push($a, 9);

print('----<br>' . count($a) . '<br>');
foreach($a as $k => $v) var_dump($k, $v);
print('----<br>');

?>