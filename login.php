<?php 
session_start();
    include("./utils/connection.php");
    include("./utils/utilities.php");

    // $is_invalid = false;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        // if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
        //     exit("Valid email is required");
        // }
        // if (empty($_POST['password'])) {
        //     exit("Password is required");
        // }

        $login_email = $_POST['user_email'];
        $login_pw = $_POST['password'];

        if(!empty($login_email) && !empty($login_pw)) {

            $query = "SELECT * FROM users WHERE user_email = '$login_email' LIMIT 1";
            $res = mysqli_query($conn, $query);

            if ($res) {

                if ($res && mysqli_num_rows($res) > 0) {

                    $user_data = mysqli_fetch_assoc($res);
                    $checked = password_verify($login_pw, $user_data['password']);
                    
                    if ($user_data['user_email'] == $login_email && $checked) {

                        $_SESSION['user_id'] = $user_data['user_id'];
                        header("Location: index.php");
                        exit;
                    }
                    else {
                        echo "Invalid Credentials, Please Retry";
                    }
                }
            }
            else {
                echo "Invalid Credentials, Please Retry";
            }
        }
        else {
            echo "Invalid Credentials, Please Retry";
        }
        // $is_invalid = true;
    }
?>

<?php include("./includes/header.php"); ?>

<div>
    <?php
    //  if ($is_invalid) {?>
        <!-- <em>Invalid Login</em> -->
    <?php
    //  ;} ?>
    <form method="post">
        <label>Email:</label>
        <input type="email" name="user_email" value="<?php echo htmlspecialchars($_POST['user_email'] ?? "") ?>" autofocus>
        <br>
        <br>
        <label>Password:</label>
        <input type="password" name="password" >
        <br>
        <br>
        <button class="btn btn-primary" type="submit">Login</button>
    </form>
    <br>
    <a href="signup.php">Click here to register</a>
</div>

<?php include("./includes/footer.php"); ?>