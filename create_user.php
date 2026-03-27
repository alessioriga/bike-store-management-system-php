<?php
session_start();
require_once 'utilities/header_footer.php';
require_once 'utilities/pdo.php';

// Check if user is logged in
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] != true) {
    header("Location: login.php");
    exit;
}

title_bar("VeloWorld | Create User");

if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['name']) &&
    isset($_POST['email']) &&
    isset($_POST['password'])
) {

    $sql = "INSERT INTO users (name, email, password) 
            VALUES (:name, :email, :password)";

    $stmt = $pdo->prepare($sql);

    $my_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt->execute([
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':password' => $my_hash
    ]);

    $_SESSION['user_created'] = "User successfully created!";
    header("Location: member.php");
    exit;
}

$stmt = $pdo->query("SELECT id, name, email, password FROM users ORDER BY id ASC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main>

    <h1>Create User</h1>

    <?php if ($users): ?>

        <table class="member-table">

            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
            </tr>

            <?php foreach ($users as $user): ?>

                <tr>

                    <td>
                        <?php echo htmlentities($user['id']); ?>
                    </td>

                    <td>
                        <?php echo htmlentities($user['name']); ?>
                    </td>

                    <td>
                        <?php echo htmlentities($user['email']); ?>
                    </td>

                    <td>
                        ********
                    </td>

                </tr>

            <?php endforeach; ?>

        </table>

    <?php else: ?>

        <p>No users found.</p>

    <?php endif; ?>


    <a href="member.php" class="btn">Go Back</a>
    <a href="logout.php" class="btn">Logout</a>

    <form method="post" class="forms" style="margin-top:2em;">
        <fieldset>

            <legend>Create a new user</legend>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Alex" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="you@example.com" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Create a password" required>

        </fieldset>

        <input type="submit" value="Add New User" class="btn">

    </form>

</main>

<?php footer_bar(); ?>