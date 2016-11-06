<?php
/**
 * Created by PhpStorm.
 * User: koval
 * Date: 11/5/2016
 * Time: 9:30 PM
 */

require_once 'babynames.php';

if(isset($_GET['name'])) {
    $option = $_GET['name'];

    populateMeaning($option, NULL);
}

