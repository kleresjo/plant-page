<?php
include("database.php");
include("admin-product.php");
include("admin.php");
include("mypage.php");
?>

<select name="difficult_level">
    <option>Choose a difficulty level:</option>
    <?php
    foreach ($options as $option) {
    ?>
        <option><?php echo $option['difficult_level']; ?> </option>
    <?php
    }
    ?>
</select>