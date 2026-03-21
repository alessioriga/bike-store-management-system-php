<?php
require_once 'utilities/header_footer.php';
require_once 'utilities/pdo.php';

title_bar("VeloWorld | Reviews");
?>


<main>
    <h1>Reviews</h1>
    <p>We are happy to know what you think about our products. Add a new review below.</p>
    

    <?php
    // Display success message after redirect
    if (isset($_SESSION['review_added'])) {
        echo "<p style='color:green; font-weight:bold;'>" . $_SESSION['review_added'] . "</p>";
        unset($_SESSION['review_added']);
    }

    // Insert review if form submitted
    if (isset($_POST['name'], $_POST['surname'], $_POST['item'], $_POST['review'], $_POST['rating'])) {

        $sql = "INSERT INTO reviews (name, surname, item, review, rating) 
            VALUES (:name, :surname, :item, :review, :rating)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $_POST['name'],
            ':surname' => $_POST['surname'],
            ':item' => $_POST['item'],
            ':review' => $_POST['review'],
            ':rating' => $_POST['rating']
        ]);

        // Set session message and redirect to avoid resubmission
        $_SESSION['review_added'] = "Review added successfully!";
        header("Location: reviews.php");
        exit;
    }

    // Fetch all reviews
    $stmt = $pdo->query("SELECT name, surname, item, review, rating, DATE_FORMAT(inserted_at, '%d-%m-%Y %H:%i:%s') AS inserted_at FROM reviews ORDER BY rating DESC");
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <?php
    // Display reviews
    if ($reviews) {
        foreach ($reviews as $row) {
            echo "<article class='review-box'>";
            echo "<h2><strong>"
                . htmlentities($row['name']) . " "
                . htmlentities($row['surname'])
                . "</strong></h2>";

            echo "<h3>" . htmlentities($row['item']) . "</h3>";

            echo "<h4>" . htmlentities($row['review']) . "</h4>";

            $rating = round($row['rating']);
            $stars = str_repeat('★', $rating) . str_repeat('☆', 5 - $rating);
            echo "<h5 class='star-rating'>$stars</h5>";


            echo "<h6>Added on: "
                . htmlentities($row['inserted_at'])
                . "</h6>";
            echo "</article>";
        }
    } else {
        echo "<p>No reviews yet.</p>";
    }
    ?>

    <h2 class="h2_title">Add a Review</h2>
    <form method="post" class="forms">
        <fieldset>
            <legend>Personal Information</legend>

            <label for="name">First Name</label>
            <input type="text" id="name" name="name" placeholder="Your name.." required>

            <label for="surname">Last Name</label>
            <input type="text" id="surname" name="surname" placeholder="Your last name.." required>
        </fieldset>

        <fieldset>
            <legend>Product Review</legend>

            <label for="item">Item</label>
            <input type="text" id="item" name="item" placeholder="Item you bought from us.." required>

            <label for="review">Review</label>
            <textarea  id="review" name="review" rows="4" required></textarea>

            <label for="rating">Rating (0-5)</label>
            <input type="number" id="rating" name="rating" value="5" min="0" max="5" required>
        </fieldset>

        <input type="submit" value="Add Review">
    </form>
</main>

<?php
footer_bar();
?>