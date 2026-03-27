<?php
session_start();
require_once 'utilities/header_footer.php';
require_once 'utilities/pdo.php';

// Check if user is logged in
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: login.php");
    exit;
}

title_bar("VeloWorld | Edit Items");

// Handle form submission for updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_id'])) {

    $imagePath = $_POST['current_image'] ?? null;

    // Handle new uploaded image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $uploadDir = 'images/items/stock/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

        $originalName = basename($_FILES['image']['name']);
        $ext = pathinfo($originalName, PATHINFO_EXTENSION);
        $imageName = time() . '_' . preg_replace("/[^a-zA-Z0-9_-]/", "", pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $ext;
        $imagePath = $uploadDir . $imageName;

        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }

    // Update item in database
    $sql = "UPDATE items SET 
                item_name = :item_name, 
                colour = :colour, 
                description = :description, 
                price = :price, 
                quantity = :quantity, 
                image = :image
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':item_name'   => $_POST['item_name'],
        ':colour'      => $_POST['colour'],
        ':description' => $_POST['description'],
        ':price'       => $_POST['price'],
        ':quantity'    => $_POST['quantity'],
        ':image'       => $imagePath,
        ':id'          => $_POST['item_id']
    ]);

    $_SESSION['item_updated'] = "Item updated successfully!";
    header("Location: edit_items.php");
    exit;
}

// Handle item deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_item_id'])) {
    $deleteId = $_POST['delete_item_id'];

    // Get current image path to delete the file
    $stmt = $pdo->prepare("SELECT image FROM items WHERE id = :id");
    $stmt->execute([':id' => $deleteId]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($item && !empty($item['image']) && file_exists($item['image'])) {
        unlink($item['image']); // delete the image file
    }

    // Delete the item from database
    $stmt = $pdo->prepare("DELETE FROM items WHERE id = :id");
    $stmt->execute([':id' => $deleteId]);

    $_SESSION['item_deleted'] = "Item deleted successfully!";
    header("Location: edit_items.php");
    exit;
}

// Fetch items for listing
$stmt = $pdo->query("SELECT id, item_name, colour, description, price, quantity, image FROM items ORDER BY id ASC");
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main>
    <h1>Edit Items</h1>

    <?php
    if (isset($_SESSION['item_updated'])) {
        echo "<p style='color:green; font-weight:bold;'>" . htmlentities($_SESSION['item_updated']) . "</p>";
        unset($_SESSION['item_updated']);
    }

    elseif (isset($_SESSION['item_deleted'])) {
    echo "<p style='color:red; font-weight:bold;'>" . htmlentities($_SESSION['item_deleted']) . "</p>";
    unset($_SESSION['item_deleted']);
    }
    ?>

    <?php if ($items): ?>
        <table class="member-table">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Colour</th>
                <th>Price (£)</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?php echo htmlentities($item['id']); ?></td>
                    <td>
                        <?php if (!empty($item['image']) && file_exists($item['image'])): ?>
                            <img src="<?php echo htmlentities($item['image']); ?>" alt="" width="80">
                        <?php else: ?>
                            No image
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlentities($item['item_name']); ?></td>
                    <td><?php echo htmlentities($item['description']); ?></td>
                    <td><?php echo htmlentities($item['colour']); ?></td>
                    <td>£<?php echo htmlentities($item['price']); ?></td>
                    <td><?php echo htmlentities($item['quantity']); ?></td>
                    <td>
                        <form method="post" style="display:inline-block;">
                            <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                            <input type="hidden" name="item_name" value="<?php echo htmlentities($item['item_name']); ?>">
                            <input type="hidden" name="colour" value="<?php echo htmlentities($item['colour']); ?>">
                            <input type="hidden" name="description" value="<?php echo htmlentities($item['description']); ?>">
                            <input type="hidden" name="price" value="<?php echo htmlentities($item['price']); ?>">
                            <input type="hidden" name="quantity" value="<?php echo htmlentities($item['quantity']); ?>">
                            <input type="hidden" name="current_image" value="<?php echo htmlentities($item['image']); ?>">
                            <button type="button" onclick="showEditForm(<?php echo $item['id']; ?>)">Edit</button>
                        </form>

                        <form method="post" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this item?');">
                            <input type="hidden" name="delete_item_id" value="<?php echo $item['id']; ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No items found.</p>
    <?php endif; ?>

    <a href="member.php" class="btn">Go Back</a>

    <!-- Edit form (hidden by default) -->
    <form method="post" class="forms" enctype="multipart/form-data" id="editForm" style="display:none; margin-top:2em;">
        <fieldset>
            <legend>Edit Item</legend>
            <input type="hidden" id="item_id" name="item_id">
            <input type="hidden" id="current_image" name="current_image">

            <label for="item_name_edit">Item Name:</label>
            <input type="text" id="item_name_edit" name="item_name" required>

            <label for="description_edit">Description:</label>
            <textarea id="description_edit" name="description" rows="4" required></textarea>

            <label for="price_edit">Price (£):</label>
            <input type="number" id="price_edit" name="price" min="0" step="0.01" required>

            <label for="colour_edit">Colour:</label>
            <input type="text" id="colour_edit" name="colour" required>

            <label for="quantity_edit">Quantity:</label>
            <input type="number" id="quantity_edit" name="quantity" min="0" required>

            <label for="image_edit">Change Image (optional):</label>
            <input type="file" id="image_edit" name="image" accept="image/*">
        </fieldset>

        <input type="submit" value="Update Item" class="btn">
        <button type="button" class="btn" onclick="hideEditForm()">Cancel</button>
    </form>

</main>


<?php footer_bar(); ?>