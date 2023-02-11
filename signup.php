<?php
session_start();

    include("./utils/connection.php");
    include("./utils/utilities.php");

    if ($_SERVER['REQUEST_METHOD'] == "POST") {


        // if (empty($_POST['user_name'])) {
        //     exit("Name is required");
        // }
        // if (is_numeric($_POST['user_name'])) {
        //     exit("Name must not contain number");
        // }
        // if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
        //     exit("Valid email is required");
        // }
        // if (strlen($_POST['password']) < 8) {
        //     exit("Password must be at least 8 characters");
        // }
        // if (!preg_match("/[a-z]/i", $_POST['password'])) {
        //     exit("Password must contain at least one letter");
        // }
        // if (!preg_match("/[0-9]/", $_POST['password'])) {
        //     exit("Password must contain at least one number");
        // }

        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $password = $_POST['password'];

        $hashed_pw = password_hash($password, PASSWORD_DEFAULT);

        if (!empty($user_name) && !empty($user_email) && !empty($password)) {
            
            $find_duplicate = "SELECT * FROM users WHERE user_email = '$user_email'";
            $find = mysqli_query($conn, $find_duplicate);
            
            if ($find && mysqli_num_rows($find) === 0) {

                $user_id = random_num(20);
                $query = "INSERT INTO users (user_id,user_name,user_email,password) VALUES ('$user_id','$user_name','$user_email','$hashed_pw')";

                mysqli_query($conn, $query);

                header("Location: login.php");
                exit;
            }
            else {
                echo 'This email has been registered';
            }            
        }
        else {
            echo "Please enter valid information";
        }
    }
?>

<?php include("./includes/header.php"); ?>

<form method="post" >
    <label>Name:</label>
    <input type="text" name="user_name" autofocus>
    <br>
    <br>
    <label>Email:</label>
    <input type="email" name="user_email" >
    <br>
    <br>
    <label>Password:</label>
    <input type="password" name="password" >
    <br>
    <br>
    <button class="btn btn-primary" type="submit">Signup</button>
</form>
<br>
<a href="login.php">Click here to Login</a>

<?php include("./includes/footer.php"); ?>