<?php 
if(isset($_POST['submit'])){
    $difficult_level = $_POST['difficult_level'];
  if(!empty($difficult_level)){
      $query = "INSERT INTO products (difficult_level) VALUES('$difficult_level')";
      $result = $conn->query($query);
      if($result){
        echo "Difficulty level is inserted successfully";
      }  
    }
  }
  ?>
