<!-- den här koden raderar en produkt -->
<?php

require_once __DIR__ . "/../classes/ProductsDatabase.php";
require_once __DIR__ . "/force-admin.php";

$success = false;

if (isset($_POST["id"])) {
    $products_db = new ProductsDatabase();
    $success = $products_db->delete($_POST["id"]);
} else {
    die("Invalid input");
}

if ($success) {
    header("Location: /pages/admin.php");
    die();
} else {
    die("Error deleting product");
}
