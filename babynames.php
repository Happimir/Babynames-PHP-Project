<?php

function populateDropdown() {
    $names = fopen("rank.txt", "r") or die("Unable to open file");

    while(!feof($names)) {
        $nameRead = fgets($names);
        $nameRead = substr($nameRead, 0, strpos($nameRead, ' '));

        echo '<option value="' . $nameRead .'">' . $nameRead. '</option>';
    }
}


