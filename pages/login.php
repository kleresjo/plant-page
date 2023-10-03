<?php

require_once __DIR__ . "/../classes/Template.php";

Template::header("");
if (isset($_GET["register"]) && $_GET["register"] == "success") {
    echo "<h2> User registered, log in </h2>";
}

// ifall man skriver in fel lösenord så blir det fel

if (isset($_GET["error"]) && $_GET["error"] == "wrong_pass") : ?>

    <h2>Fel användarnamn eller lösenord! </h2>
<?php endif; ?>

<!-- kod för att logga in -->

<h2> Logga in </h2>

<form action="/scripts/post-login.php" method="post" class="skapa-produkt-card">
    <input type="text" name="username" placeholder="Användarnamn"><br>
    <input type="password" name="password" placeholder="Lösenord"><br>
    <input type="submit" value="Logga in">
    <a href="/pages/register.php"> Registrera dig </a>
</form>

<?php

Template::footer();
