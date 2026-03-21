<?php
session_start();
require_once 'utilities/header_footer.php';
require_once 'utilities/pdo.php';

$error = "";

// If form was submitted
if (isset($_POST['username']) && isset($_POST['password'])) {

    $typed_email = $_POST['username'];
    $typed_password = $_POST['password'];

    // Prepared statement (safe)
    $sql = "SELECT * FROM users WHERE email = :email
    -- AND password = :password // (no hash verification)
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':email' => $typed_email
        // ,':password' => $typed_password // (no hash verification)
    ]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Alternative: Unsafe query (vulnerable to SQL injection)
    // $sql = "SELECT * FROM users WHERE email = '$typed_email' AND password = '$typed_password'";
    // $stmt = $pdo->query($sql);
    // $user = $stmt->fetch(PDO::FETCH_ASSOC);
    // if ($user) {
    //     // Successful login 
    //     $_SESSION["logged_in"] = true;
    //     header('Location: member.php');
    //     exit;
    // } else {
    //     // Failed login
    //     $error = "Invalid username or password!";
    // }

    if ($user && password_verify($typed_password, $user['password'])) {
        $_SESSION["logged_in"] = true;
        header('Location: member.php');
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}

title_bar("VeloWorld | Member Page");
?>

<main>
    <h1>Member Area</h1>

    <form method="post" class="forms">
        <fieldset>
            <legend>Login</legend>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter your username">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter the password">
            <?php

            if ($error != "") {
                echo "<p style='color:red;'>$error</p>";
            }

            if (isset($_SESSION['logout_message'])) {
                echo "<p style='color:green;'>" . $_SESSION['logout_message'] . "</p>";
                unset($_SESSION['logout_message']);
            }
            ?>


        </fieldset>

        <input type="submit" value="Login">
    </form>
</main>

<?php footer_bar(); ?>