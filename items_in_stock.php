<?php
require_once 'utilities/header_footer.php';
require_once 'utilities/pdo.php';

title_bar("VeloWorld | Items in Stock");
?>

<main class="items-page">

    <h1>Items in Stock</h1>
    <p>Check out our bicycles currently available for purchase!</p>

    <section class="filter-panel">
        <h2>Filter Bikes</h2>
        <form method="GET" class="forms">
            <fieldset>
                <legend>Colour</legend>
                <?php
                $colors = ['Red', 'Green', 'Blue', 'Black'];
                foreach ($colors as $color) {
                    $checked = (isset($_GET['colour']) && $_GET['colour'] === $color) ? 'checked' : '';
                    echo '<label><input type="radio" name="colour" value="' . $color . '" ' . $checked . '> ' . $color . '</label>';
                }
                ?>
                <label><input type="radio" name="colour" value="" <?php if(!isset($_GET['colour'])) echo 'checked'; ?>> All Colours</label>
            </fieldset>

            <fieldset>
                <legend>Price Range (£)</legend>
                <label>Min <input type="number" name="min_price" value="<?php echo isset($_GET['min_price']) ? htmlentities($_GET['min_price']) : ''; ?>"></label>
                <label>Max <input type="number" name="max_price" value="<?php echo isset($_GET['max_price']) ? htmlentities($_GET['max_price']) : ''; ?>"></label>
            </fieldset>

            <input type="submit" value="Apply Filters">
        </form>
    </section>

    <!-- Items List -->
    <?php
    
    $sql = "SELECT item_name, colour, description, price, quantity, image FROM items WHERE 1=1";
    $params = [];

    if (!empty($_GET['colour'])) {
        $sql .= " AND colour = :colour";
        $params[':colour'] = $_GET['colour'];
    }

    if (!empty($_GET['min_price'])) {
        $sql .= " AND price >= :min_price";
        $params[':min_price'] = $_GET['min_price'];
    }

    if (!empty($_GET['max_price'])) {
        $sql .= " AND price <= :max_price";
        $params[':max_price'] = $_GET['max_price'];
    }

    $sql .= " ORDER BY price ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($items) {
        echo '<ul class="items-list">';
        foreach ($items as $item) {
            echo '<li class="item-card">';
            if (!empty($item['image']) && file_exists($item['image'])) {
                echo '<img src="' . htmlentities($item['image']) . '" alt="">';
            } else {
                echo '<img src="images/no_image.png" alt="No image available">';
            }
            echo '<h3>' . htmlentities($item['item_name']) . '</h3>';

            echo "<details>
            <summary>Read full description</summary>
            <p>" . htmlentities($item['description']) . "</p> </details>";

            echo '<p><strong>Price:</strong> £' . htmlentities($item['price']) . '</p>';
            echo '<p><strong>Colour:</strong> ' . htmlentities($item['colour']) . '</p>';
            echo '<p><strong>Quantity in stock:</strong> ' . htmlentities($item['quantity']) . '</p>';
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No items match your filters. Please adjust your search.</p>';
    }
    ?>

</main>

<?php footer_bar(); ?>

