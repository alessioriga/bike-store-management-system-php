<?php
session_start();
require_once 'utilities/header_footer.php';
require_once 'utilities/pdo.php';

// Check if user is logged in
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {

    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id' => $_POST['delete_id']
    ]);

    $_SESSION['user_deleted'] = "User deleted successfully!";
    header("Location: member.php");
    exit;
}

title_bar("VeloWorld | Member Page");

// Fetch users
$stmt = $pdo->query("SELECT id, name, email, password FROM users ORDER BY id ASC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main>
    <h1>Member Area</h1>

    <?php
    if (isset($_SESSION['user_created'])) {
        echo "<p style='color:green; font-weight:bold;'>" . htmlentities($_SESSION['user_created']) . "</p>";
        unset($_SESSION['user_created']);
    }

    elseif (isset($_SESSION['user_deleted'])) {
        echo "<p style='color:red; font-weight:bold;'>" . htmlentities($_SESSION['user_deleted']) . "</p>";
        unset($_SESSION['user_deleted']);
    }
    ?>

    <?php if ($users): ?>

        <table class="member-table">

            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Action</th>
            </tr>

            <?php foreach ($users as $user): ?>

                <tr>
                    <td><?php echo htmlentities($user['id']); ?></td>

                    <td><?php echo htmlentities($user['name']); ?></td>

                    <td><?php echo htmlentities($user['email']); ?></td>

                    <td>********</td>

                    <td>
                        <form method="post" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this user?');">

                            <input type="hidden" name="delete_id" value="<?php echo $user['id']; ?>">

                            <button type="submit" class="btn">
                                Delete
                            </button>

                        </form>
                    </td>
                </tr>

            <?php endforeach; ?>

        </table>

    <?php else: ?>

        <p>No users found.</p>

    <?php endif; ?>

    <a href="create_user.php" class="btn">Create User</a>
    <a href="edit_items.php" class="btn">Edit Items</a>
    <a href="insert_item.php" class="btn">Insert an Item</a>
    <a href="logout.php" class="btn">Logout</a>

</main>

<?php footer_bar(); ?>