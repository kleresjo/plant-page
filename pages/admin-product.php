<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";

// kollar så att du är admin som är inloggad

$is_logged_in = isset($_SESSION["user"]);
$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;
$is_admin = $is_logged_in && $logged_in_user->role == "admin";

if (!$is_admin) {
    http_response_code(401);
    die("Access denied");
}

if (!isset($_GET["id"])) {
    die("Invalid input");
}

// den här koden gör att man kan uppdatera produkterna
$products_db = new ProductsDatabase();

$product = $products_db->get_one($_GET["id"]);


Template::header("Update product");

if ($product == null) : ?>

    <h2>No product</h2>

<?php else : ?>

    <form action="/admin-scripts/post-update-product.php?id=<?= $_GET["id"] ?>" method="post" enctype="multipart/form-data" class="skapa-produkt-card">
        <input type="text" name="title" placeholder="Titel" value="<?= $product->title ?>"> <br>
        <textarea name="description" placeholder="Description"><?= $product->description ?></textarea> <br>
        <label for="Difficulty level">Choose a difficulty level:</label>
        <select id="difficulty_level_form" name="difficulty_level">
            <option value="Beginner">Beginner</option>
            <option value="Intermediate">Intermediate</option>
            <option value="Advanced">Advanced</option>
        </select> <br>
        <input type="file" name="img_url" accept="image/*"> <br>
        <input type="submit" value="Save" class="produkt-btn">
    </form>

    <p><b>Delete:</b></p>

    <form action="/admin-scripts/post-delete-product.php" method="post">
        <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
        <input type="submit" value="Radera produkt" class="logout-btn">
    </form>


<?php

endif;

Template::footer();
