<?php

if(isset($_GET['name'])) {
    $name = $_GET['name'];
    populateMeaning($name, NULL);
}

if(isset($_GET['name']) && isset($_GET['gender'])) {
    $name = $_GET['name'];
    $gender = $_GET['gender'];

    populateRanking($name, $gender, NULL);
}

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

        $lineExplode = explode(' ', $line);

        if(strpos($lineExplode[0],$selectOption ) !== false) {
            $meaning = substr($line, strpos(0, ' '), strlen($line));

            echo $meaning;
            //break;
        }
    }

    fclose($meanings);

}

function populateRanking($name, $gender, $type) {
    $rankings = fopen("rank.txt", "r") or die("Unable to open file");

    while (!feof($rankings)) {
        $line = fgets($rankings);
        $parsed = explode(' ', $line);



        if(strtoupper($parsed[0]) == strtoupper($name) && $parsed[1] == $gender) {
            echo "name parsed is: " . $parsed[0] . " " .
                $parsed[1] . " gender is: " . $gender;
            break;
        }
    }

}


