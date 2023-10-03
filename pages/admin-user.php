<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";

$user_db = new UsersDatabase();

$user = $user_db->get_one_by_username($_GET["username"]);

Template::header("Admin-user");

?>

<!-- den här koden är för att uppdatera roller på användare -->

<div>
    <div class="skapa-produkt-card">
        <h4>Uppdatera <?= $_GET["username"] ?></h2>
            <form action="/admin-scripts/post-update-user.php?username=<?= $_GET["username"] ?>" method="post">
                <select name="role">

                    <option disabled selected>Roll</option>
                    <option value="admin">Admin</option>
                    <option value="customer">Kund</option>
                </select><br>

                <input type="submit" value="Spara" class="produkt-btn"><br>

            </form>

            <h4>Radera <?= $_GET["username"] ?></h2>

                <form action="/admin-scripts/post-delete-user.php" method="post">
                    <input type="hidden" name="username" value="<?= $_GET["username"] ?>">
                    <input type="submit" value="Radera användare" class="logout-btn">
                </form>
    </div>
</div>

<?php

Template::footer();

?>