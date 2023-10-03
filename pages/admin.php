<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";

// kontrollera att användaren är inloggad som admin
$is_logged_in = isset($_SESSION["user"]);
$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;
$is_admin = $is_logged_in && $logged_in_user->role == "admin";

if (!$is_admin) { // om användaren inte är admin
    http_response_code(401);
    die("Access denied!!");
}

$products_db = new ProductsDatabase();
$users_db = new UsersDatabase();

$users = $users_db->get_all();
$products = $products_db->get_all();

// kod för att kunna skapa produkter

Template::header(""); ?>

<h2 class="konto-h2"> Skapa en produkt </h2>

<hr>

<form action="/admin-scripts/post-create-product.php" method="post" enctype="multipart/form-data" class="skapa-produkt-card">
    <input type="text" name="title" placeholder="Titel" id="produkt-input"> <br>
    <textarea name="description" placeholder="Beskrivning" id="produkt-input"></textarea> <br>
    <input type="file" name="image" accept="image/*" id="edit-btn"><br>
    <input type="submit" value="Spara" class="produkt-btn">
</form>

<hr>

<!-- kod som skriver ut produkter -->

<h2 class="konto-h2"> My plants </h2>

<?php foreach ($products as $product) : ?>
    <div class="skapa-produkt-card">
        <div class="produkt-card">
            <a href="/pages/admin-product.php?id=<?= $product->id ?>">
                <?= $product->title ?> <br>
        </div>
        </a>
    </div>

<?php endforeach; ?>

<hr>

<!-- skriver ut användare -->

<h2 class="konto-h2"> Users </h2>

<?php foreach ($users as $user) : ?>
    <p class="skapa-produkt-card">
        <a class="admin-user" href="/pages/admin-user.php?username=<?= $user->username ?>"><?= $user->username ?></a>
        <i><?= $user->role ?></i>
    </p>

<?php endforeach; ?>

<?php



Template::footer();



?>