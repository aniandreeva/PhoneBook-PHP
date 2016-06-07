<?php if (isset($_SESSION['error'])) : ?>
    <div class="error-message"><?= $_SESSION['error'] ?></div>
    <?php
    unset($_SESSION['error']);
endif;
?>