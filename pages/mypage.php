<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";

$is_logged_in = isset($_SESSION['user']);
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;

Template::header("");

?>
<!-- writes who you are -->
<div class="logged-in-box">
    <p class="log-in">Logged in as:</p>
    <b class="username"><?= $logged_in_user->username ?></b>
    <form action="/scripts/post-logout.php" method="post">
        <input class="logout-btn" type="submit" value="Log out">
    </form>
</div>

<!--  kod för att kunna skapa produkter -->

<h2 class="account-h2"> Add a plant </h2>


<div class="product-div">
    <form action="/admin-scripts/post-create-product.php" method="post" enctype="multipart/form-data" class="create-product-form">
        <input type="text" name="title" placeholder="Plant name" class="product-input">
        <textarea name="description" placeholder="Plant description" class="product-input"></textarea>
        <input type="text" name="difficult_level" placeholder="Difficult level" class="product-input">
        <input type="file" name="image" accept="image/*" id="edit-btn" class="image-btn">
        <input type="submit" value="Save" class="create-product-btn">
    </form>
</div>

<!-- kod som skriver ut produkter -->
<?php
$products_db = new ProductsDatabase();
$users_db = new UsersDatabase();

$users = $users_db->get_all();
$products = $products_db->get_all();
?>

<h2 class="account-h2"> My plants </h2>
<div class="create-product-card">

    <?php foreach ($products as $product) : ?>
        <div class="product-card">
            <a href="/pages/admin-product.php?id=<?= $product->id ?>">
                <img class="product-image" src="<?= $product->img_url ?>" alt="<?= $product->description ?>">
                <div class="product-card-text">
                    <h3><?= $product->title ?></h3>
                    <p><?= $product->difficult_level ?></p>
                    <p><?= $product->description ?></p>
                </div>
            </a>
        </div>

    <?php endforeach; ?>
</div>

<?php
Template::footer();
?>