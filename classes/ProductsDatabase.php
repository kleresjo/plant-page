<?php
require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/Product.php";

class ProductsDatabase extends Database{
    
    // get_one
    
    public function get_one($id){
        $query = "SELECT * FROM products WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $db_product = mysqli_fetch_assoc($result);
        $product = null;

        if($db_product){
            $product = new Product(
                $db_product["title"],
                $db_product["description"],
                $db_product["difficult_level"],
                $db_product["img-url"],
                $id
            );
        }
            return $product;
    }

    // get_all
    public function get_all(){
        $query = "SELECT * FROM products";
        $result = mysqli_query($this->conn, $query);
        $db_products = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $products = [];

        foreach ($db_products as $db_product){
            $db_id = $db_product["id"];
            $db_title = $db_product["title"];
            $db_description = $db_product["description"];
            $db_difficult_level = $db_product["difficult_level"];
            $db_img_url = $db_product["img-url"];

            $products[] = new Product($db_title, $db_description, $db_difficult_level, $db_img_url, $db_id);
        }
        return $products;
    }

     // get by order id

     public function get_by_order_id($order_id)
     {
         $query = "SELECT op.id, op.`order-id`, u.username, p.`title`, p.`description`,  p.`img-url`, o.`user-id`, o.`order-date`, o.`status` FROM `order-products` AS op
         JOIN orders AS o ON op.`order-id` = o.id 
         JOIN users AS u ON o.`user-id` = u.id
         JOIN products AS p ON op.`product-id` = p.id
         WHERE op.`order-id` = ?";
 
         $stmt = mysqli_prepare($this->conn, $query);
         $stmt->bind_param("i", $order_id);
         $stmt->execute();
         $result = $stmt->get_result();
 
         $db_products = mysqli_fetch_all($result, MYSQLI_ASSOC);
 
         $products = [];
 
      foreach ($db_products as $db_product){
 
             $product = new Product(
                 $db_product["title"],
                 $db_product["description"],
                 $db_product["difficult_level"],
                 $db_product["img-url"],
             );
             $products[] = $product;
         } 
         return $products;
     }
     
    

    // create produkt 
    public function create(Product $product){
        $query = "INSERT INTO products (title, `description`,`difficult_level`, `img-url`) VALUES (?, ?,?, ?)";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("ssss", $product->title, $product->description, $product->difficult_level, $product->img_url);
        $success = $stmt->execute();
        return $success;
    }

   // update produkt 
   public function update (Product $product, $id){

    $query = "UPDATE products SET `title`=?, `description`=?, `difficult_level`=?, `img-url`=? WHERE id=?";
    $stmt = mysqli_prepare($this->conn, $query);
    $stmt->bind_param("ssssi", $product->title, $product->description, $product->difficult_level, $product->img_url, $id);
    return $stmt->execute();
}

    // delete produkt 
    public function delete($id){
        $query = "DELETE FROM products WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

}
