<?php

$type = $_GET['type'];

if(isset($_GET['name']) && strpos($type, "meaning") !== false) {
    $name = $_GET['name'];
    populateMeaning($name);
}

if(isset($_GET['name']) && isset($_GET['gender']) && strpos($type, "rank") !== false) {
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

        if($lineExplode[0] == $selectOption){
            $meaning = substr($line, strpos(0, ' '), strlen($line));

            echo "<div><p>The name <strong>$option</strong> means ...</p> <hr>
                    <p><q>$meaning</q></p></div>";


            //echo $meaning;
            break;
        }
    }

    fclose($meanings);

}

function populateRanking($name, $gender) {
    $rankings = fopen("rank.txt", "r") or die("Unable to open file");

    while (!feof($rankings)) {  // iterates through file
        // gets line and divides it by spaces
        $line = fgets($rankings);
        $parsed = explode(' ', $line);


        // if first word of line is selected name, and second word is selected gender
        if(strtoupper($parsed[0]) == strtoupper($name) && $parsed[1] == $gender) {
            /*echo "name parsed is: " . $parsed[0] . " " .
                $parsed[1] . " gender is: " . $gender;*/
            // if there aren't enough objects (no rank data)
            if( count($parsed) < 15 ){
                // should send 410 http code
                http_response_code(410);
                break;  // exit loop
            }

            echo "<baby name=\"" . $name . "\" gender=\"" . $gender . "\">\n"; // sets baby tag with name/gender vals

            $index = 2;     // tracks index within $parsed array
            $year = 1890;   // tracks year the rank corresponds to
            while( $index < count($parsed)){
                // add the rank tag with year property, and the rank within the tag
                echo "<rank year=\"" . $year . "\">" . $parsed[$index] . "</rank>\n";

                // increment counters
                $index += 1;
                $year += 10;
            }

            echo "</baby>"; // closes baby tag

            break; // ends loop
        }
    }

}


