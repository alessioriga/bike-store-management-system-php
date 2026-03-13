<?php
require_once 'utilities/header_footer.php';

title_bar("VeloWorld");
?>

<main>
    <!-- Hero Section -->
    <section class="welcome-message">
        <h1>Welcome to VeloWorld</h1>
        <p>Discover the perfect bike for your ride at VeloWorld. Whether you're exploring city streets, tackling mountain trails, 
            or training for long distances, our high-quality bikes are built for every journey. 
            Browse our collection and find your next adventure on two wheels.</p>
    </section>

    <!-- Featured Bikes Section -->
    <section aria-label="Featured Bikes">
        <h2>Featured Bikes</h2>
        <ul class="featured-bikes">
            <li>
                <img src="images/items/stock/mountain_bike_1.jpg" alt="Mountain Bike">
                <h3>Mountain Bike</h3>
                <p>Perfect for off-road trails and adventure rides.</p>
            </li>
            <li>
                <img src="images/items/stock/road_bike_1.jpg" alt="Road Bike">
                <h3>Road Bike</h3>
                <p>Lightweight and fast for long road rides.</p>
            </li>
            <li>
                <img src="images/items/stock/city_bike_1.jpg" alt="City Bike">
                <h3>City Bike</h3>
                <p>Comfortable and stylish for everyday city commuting.</p>
                <a href="items_in_stock.php" class="btn">See bikes in Stock</a>
            </li> 
        </ul>
        
    </section>
    
    <!-- About teaser -->
    <section aria-label="About VeloWorld" class="about-home">
        <h2>Why Choose VeloWorld?</h2>
        <p>At VeloWorld, we focus exclusively on bicycles, ensuring every bike we offer meets the highest standards of quality and performance. 
        Our team provides expert advice to help you find the perfect ride, and our commitment to exceptional service guarantees a smooth and enjoyable experience from purchase to the open road.</p>
        <a href="about_us.php" class="btn">Learn More</a>
    </section>

    <!-- Reviews teaser -->
    <section aria-label="Our Customer Reviews" class="reviews-home">
        <h2>Customer Reviews</h2>
        <p>See what riders are saying about their VeloWorld bikes.</p>
        <a href="reviews.php" class="btn">Read Reviews</a>
    </section>
</main>

<?php
footer_bar();
?>