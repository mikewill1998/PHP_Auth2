<?php

function check_login($conn) {

    if (isset($_SESSION['user_id'])) {

        $user_id = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE user_id = '$user_id' LIMIT 1";

        $res = mysqli_query($conn, $query);
        if ($res && mysqli_num_rows($res) > 0) {

            $user_data = mysqli_fetch_assoc($res);
            return $user_data;
        }
    }
    header("Location: login.php");
    exit;
}

function random_num($length) {

    $text = "";
    $leng = rand(5, $length);

    for ($i=0; $i<$leng; $i++) {
        $text .= rand(0, 9);
    }

    return $text;
}