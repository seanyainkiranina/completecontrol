#!/usr/bin/php
<?php

include('scripthelper.class.php');

$sh= new ScriptHelper();
$sh->disable();

$counter=1;

while ($counter<100) {
    $counter++;
}

$ch=$sh->duplicate;
$ch->disable();

echo "swap ";
echo $ch->utime;
echo "\n";
echo "swap ";
echo $sh->utime;
echo "\n";


$sh->enable();
