<?php


function populateDropdown() {
    $names = fopen("rank.txt", "r") or die("Unable to open file");

    while(!feof($names)) {
        $nameRead = fgets($names);
        $nameRead = substr($nameRead, 0, strpos($nameRead, ' '));

        echo '<option value="' . $nameRead .'">' . $nameRead. '</option>';
    }

    fclose($names);
}

function populateMeaning($option, $type) {


    $meanings = fopen("meanings.txt", "r") or die("Unable to open file");


    while(!feof($meanings)) {
        $selectOption = strtoupper($option);
        $line = fgets($meanings);

        if(strpos($line,$selectOption ) !== false) {
            $meaning = substr($line, strpos(0, ' '), strlen($line));

            echo $meaning;
            break;
        }
    }
}


