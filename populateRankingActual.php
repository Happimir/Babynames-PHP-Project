<?php

require_once 'babynames.php';

if(isset($_GET['name']) && isset($_GET['gender'])) {
    $option = $_GET['name'];
    $gender = $_GET['gender'];

    populateRanking($option, $gender, NULL);
}