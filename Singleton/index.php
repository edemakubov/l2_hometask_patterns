<?php

require ('./Superman.php');

$superman = Superman::getInstance();
echo $superman->name . PHP_EOL;
$superman2 = Superman::getInstance();
$superman3 = Superman::getInstance();
