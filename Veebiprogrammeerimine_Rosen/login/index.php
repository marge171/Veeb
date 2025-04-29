<?php
	session_start();
    include_once 'includes/header.php';
?>
       <section class="hero">
    <div class="hero-overlay">
        <div class="hero-text">
            <?php if (isset($_SESSION['u_id'])): ?>
                <h1>Tere tulemast tagasi!</h1>
                <p>Oled sisse logitud kasutajana.</p>
                <a class="cta-button" href="autoleht.php">Vaata autosid</a>
                <?php if (isset($_SESSION['u_isadmin']) && intval($_SESSION['u_isadmin']) === 1): ?>
                    <br><br>
                    <a class="cta-button" href="admin.php">Mine adminpaneeli</a>
                <?php endif; ?>
            <?php else: ?>
                <h1>Tere tulemast Autolehele!</h1>
                <p>Hallake oma lemmikautosid kiirelt ja mugavalt.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
    include_once 'includes/footer.php';
?>
