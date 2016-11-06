<?php

$type = $_GET['type'];

if(isset($_GET['name']) && strpos($type, "meaning") !== false) {
    echo $_GET['type'];
    $name = $_GET['name'];
    populateMeaning($name);
}

if(isset($_GET['name']) && isset($_GET['gender']) && strpos($type, "rank") !== false) {
    echo $_GET['type'];
    $name = $_GET['name'];
    $gender = $_GET['gender'];

    populateRanking($name, $gender);
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

function populateMeaning($option) {


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

function populateRanking($name, $gender) {
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


