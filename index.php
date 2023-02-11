<?php
session_start();

    include("./utils/connection.php");
    include("./utils/utilities.php");

    $user_data = check_login($conn);

?>


<?php include("./includes/header.php"); ?>

<a href="logout.php">Click here to  Logout</a>
<h1>Welcome to the index page</h1>
<br>
Hello, <?php echo $user_data['user_name']; ?>

<?php include("./includes/footer.php"); ?>