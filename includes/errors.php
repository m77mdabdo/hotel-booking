<?php
// session_start();

if (isset($_SESSION['error'])) {
    foreach ($_SESSION['error'] as $err) { ?>
        <div class="alert alert-danger text-white bg-danger p-2"> 
            <?php echo $err . "<br>"; ?>
        </div>
    <?php }
    unset($_SESSION['error']); 
}
?>
