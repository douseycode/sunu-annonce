<?php
require '../../actions/auth/login.php';
require '../../header.php';
// require '../../navbar.php';

?>



<section class="login py-5 border-top-1">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-8 align-item-center">
        <div class="border">
          <h3 class="bg-gray p-4">Connecte-toi</h3>
          <?php
						if (isset($errorMessage)) {
						?>
							<div class="alert alert-warning alert-dismissible fade show" role="alert">
								<?= $errorMessage; ?>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						<?php
						}

						?>
         <?php
    if (isset($_GET['message'])) {
      $message = $_GET['message'];
    ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $message; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php
    }
  
    ?>
          <form method="post">
    <fieldset class="p-4">
        <input class="form-control mb-3" type="email" name="email" placeholder="Email" required>
        <input class="form-control mb-3" type="password" name="password" placeholder="Password" required>
        <button type="submit" name="send" class="btn btn-primary font-weight-bold mt-3">Log in</button>
        <p class="mt-3">
                Vous n'avez pas de compte? <a href="register.php">Inscrivez-vous ici</a>.
        </p>
        
    </fieldset>
</form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require '../../footer.php'; ?>