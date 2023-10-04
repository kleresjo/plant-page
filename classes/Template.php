<?php

require_once __DIR__ . "/User.php";
session_start();

// den här koden kollar ifall man är inloggad och ifall man är admin eller inte och uppdaterar varukorgen
class Template
{
    public static function header($title)
    {
        $is_logged_in = isset($_SESSION["user"]);
        $logged_in_user = $is_logged_in ? $_SESSION["user"] : null;
        $is_admin = $is_logged_in && ($logged_in_user->role == "admin");
        $cart_count = isset($_SESSION["cart"]) ? count($_SESSION["cart"]) : 0;
?>
        <!DOCTYPE html>
        <html lang="sv">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="/assets/style.css">
            <title> <?= $title ?> - Your page for plants </title>
        </head>

        <body>
            <!-- Menyn -->
            <nav class="meny-nav">
                <a href="/"><i class="fa-solid fa-leaf"></i></a>
                <div class="nav-links">
                    <a href="" class="meny-link">Discover</a>
                    <a href="" class="meny-link">Plant care</a>
                </div>
                <div class="meny-links">
                    <?php if (!$is_logged_in) : ?>
                        <a href="/pages/login.php" class="meny-link">Sign in</a>
                        <a href="/pages/register.php" class="meny-link">Register account</a>
                    <?php elseif ($is_admin) : ?>
                        <a href="/pages/admin.php" class="meny-link">Admin page</a>
                    <?php endif; ?>
                    <?php if ($is_logged_in) : ?>
                        <a href="/pages/mypage.php" class="meny-link">My plants</a>
                        <form action="/scripts/post-logout.php" method="post">
                            <input class="logout-btn" type="submit" value="Log out">
                        </form>
                </div>
                </div>
            <?php endif; ?>
            </div>
            </nav>

        <?php }
    public static function footer()
    {
        ?>
            <!-- Footer -->
            <footer class="footer">
                <a href="/"><i class="fa-solid fa-leaf"></i></a>
                <div class="footer-menu">
                    <h3>Find your way</h3>
                    <a href="/" class="footer-link">Home</a>
                    <a href="/pages/login.php" class="footer-link">Log in</a>
                    <a href="/pages/register.php" class="footer-link">Register account</a>
                </div>
                <div class="footer-menu-contact">
                    <h3>Contact us</h3>
                    <a href="/" class="footer-link">Contact us</a>
                    <a href="/" class="footer-link">Work with us</a>
                </div>
            </footer>
            <div class="footer-menu2">
                <p class="footer-p"> &copy; PLANT PAGE 2023</p>
            </div>
        </body>
        <script src="https://kit.fontawesome.com/49654d2d6c.js" crossorigin="anonymous"></script>
        </html>
<?php }
}
