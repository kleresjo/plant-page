<?php
require_once __DIR__ . "/../classes/ProductsDatabase.php";
require_once __DIR__ . "/force-admin.php";


$success = false;

// this code updates the plant

if (isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["difficult_level"]) && isset($_GET["id"])) {
    $upload_directory = __DIR__ . "/../assets/uploads/";
    $upload_name = basename($_FILES["image"]["name"]);
    $name_parts = explode(".", $upload_name);
    $file_extension = end($name_parts);
    $timestamp = time();
    $file_name = "{$timestamp}.{$file_extension}";
    $full_upload_path = $upload_directory . $file_name;
    $full_relative_url = "/assets/uploads/{$file_name}";
    $success = move_uploaded_file($_FILES["image"]["tmp_name"], $full_upload_path);
    $product = new Product($_POST["title"], $_POST["description"], $_POST["difficult_level"], $full_relative_url);
    $products_db = new ProductsDatabase();

    $success = $products_db->update($product, $_GET["id"]);
} 
else {
    die("Invalid input");
}

if ($success) {
    header("Location: /pages/mypage.php");
    die();
} else 
{
    die("Error saving product");
}
