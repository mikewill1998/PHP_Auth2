<?php

$dbhost = "localhost";
$dbuser = "mike";
$dbpass = "password";
$dbname = "nofwproject";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$conn) {

    die("Failed to connect");
}