<?php
require_once 'utilities/header_footer.php';

title_bar("VeloWorld | Contact Us");
?>

<main>
    <h1>Consult with us before you commit</h1>

    
  <form action="contact_submit.php" class="forms">
    <fieldset>
        <legend>Get in Touch</legend>

        <label for="name">First Name</label>
        <input type="text" id="name" name="name" placeholder="Your name.." required>

        <label for="surname">Last Name</label>
        <input type="text" id="surname" name="surname" placeholder="Your last name.." required>

        <label for="email">Enter your email</label>
        <input type="email" id="email" name="email" placeholder="Your email.." required>

        <label for="country">Country</label>
        <select id="country" name="country">
            <option value="uk">United Kingdom</option>
            <option value="canada">Canada</option>
            <option value="usa">USA</option>
            <option value="spain">Spain</option>
            <option value="italy">Italy</option>
            <option value="germany">Germany</option>
            <option value="france">France</option>
        </select>

        <label for="subject">Your message</label>
        <textarea id="subject" name="subject" placeholder="How can we help?"></textarea>
    </fieldset>
    <input type="submit" value="Submit">
    

  </form>

  <article class='contact-info'>
    <h2 class="h2_title">Contact Us</h2>
        <h3>📧 <strong>Email:</strong> <a href="mailto:info@veloworld.com" aria-label="Send an email to VeloWorld">info@veloworld.com</a></h3>
        <h3>📞 <strong>Phone:</strong> <a href="tel:+441234567890" aria-label="Call VeloWorld">+44 1234 567890</a></h3>
        <h3>📍 <strong>Address:</strong> <a href="https://maps.google.com/?q=123+Bike+Lane,+London,+EC1A+1BB" target="_blank" aria-label="View VeloWorld's location on Google Maps">123 Bike Lane, London, EC1A 1BB, United Kingdom</a></h3>
  </article>


</main>

<?php
footer_bar();
?>

