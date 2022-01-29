<?php if (!isset($path)) {
    $path = '';
} ?>
<nav class="">

    <div class="right_nav">
        <ul class="navlist">
            <li> <a href="<?php echo $path; ?>index.php"> Home </a></li>
            <?php if (isset($_SESSION['name'])) { ?>
                <li><a href="<?php echo $path; ?>forum.php">Comunitate</a></li>
                <li><a href="<?php echo $path; ?>logout.php">Log out</a></li>
            <?php  } else { ?>
                <li><a href="<?php echo $path; ?>login.php">Sign in</a></li>
                <li><a href="<?php echo $path; ?>signup.php">Sign up</a></li>
            <?php } ?>


        </ul>
    </div>
</nav>