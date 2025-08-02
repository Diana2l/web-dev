<div class="topnav">
    <!-- Top nav section -->
    <a href="./">Home</a>
    <a href="about.php">About</a>
    <a href="#">Projects</a>
    <a href="products.php">Products</a>
    <a href="persons.php">Persons</a>
    <a href="contacts.php">Contacts</a>

    <div class="topnav-right">
        <?php if(isset($_SESSION['consort'])) { ?>
        <a href="profile.php">Profile</a>
        <a href="process.php?logout=true">Logout</a>
        <?php } else { ?>
        <a href="login.php">Sign In</a>
        <a href="register.php">Sign Up</a>
        <?php } ?>
    </div>
</div>
<div class="header">
    <h1>
    <?php 
$title = explode('.', basename($_SERVER['PHP_SELF']));
print ucwords(reset($title));
    ?>
    </h1>
</div>