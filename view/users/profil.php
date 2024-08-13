<?php

require '../../header.php';
require '../../actions/auth/securityAction.php';
require '../../navbar.php';
include '../../actions/users/editProfilAction.php';


?>

<section class="user-profile section">
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<div class="sidebar">
					<!-- User Widget -->
					<div class="widget user">
						<!-- User Image -->
						<div class="image d-flex justify-content-center">
							<img src="../../assets/<?= $row['photo']; ?>" alt="" class="">
						</div>
						<!-- User Name -->
						<h5 class="text-center"><?= $row['prenom'] .' '. $row['nom']; ?></h5>
					</div>
					<!-- Dashboard Links -->
         
				</div>
			</div>
			<div class="col-lg-8">
				<!-- Edit Profile Welcome Text -->
				<div class="widget welcome-message">
					<h2>Edit profile</h2>
					<p></p>
				</div>
				<!-- Edit Personal Info -->
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="widget personal-info">
							<h3 class="widget-header user">Edit Information</h3>
							<form method="post">
								<!-- First Name -->
								<div class="form-group">
									<label for="first-name">Prenom</label>
									<input type="text" class="form-control" name="prenom" value="<?php echo $row['prenom']; ?>">
								</div>
								<!-- Last Name -->
								<div class="form-group">
									<label for="last-name">Nom</label>
									<input type="text" class="form-control" name="nom" value="<?php echo $row['nom']; ?>">
								</div>
								
								<!-- Comunity Name -->
								<div class="form-group">
									<label for="comunity-name">Date de naissance</label>
									<input type="date" class="form-control" name="dateNai" value="<?php echo $row['dateNai']; ?>">
								</div>
								
								<!-- Zip Code -->
								<div class="form-group">
									<label for="zip-code">Telephone</label>
									<input type="text" class="form-control" name="tel" value="<?php echo $row['tel']; ?>">
								</div>
								<!-- Submit button -->
								<button class="btn btn-transparent" name="modifier" type="submit">Sauvegarder</button>
							</form>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<!-- Change Password -->
					<div class="widget change-password">
						<h3 class="widget-header user">Edit Password</h3>
						<form method="post">
							<!-- Current Password -->
							<div class="form-group">
								<label for="current-password">Ancien Password</label>
								<input type="password" name="password" class="form-control" id="current-password">
							</div>
							<!-- New Password -->
							<div class="form-group">
								<label for="new-password">New Password</label>
								<input type="password" name="newpassword" class="form-control" id="new-password">
							</div>
							<!-- Confirm New Password -->
							<div class="form-group">
								<label for="confirm-password">Confirm New Password</label>
								<input type="password" name="confirmpassword" class="form-control" id="confirm-password">
							</div>
							<?php
							if (isset($errorPass)) {
							?>
								<div class="alert alert-warning alert-dismissible fade show" role="alert">
									<?= $errorPass; ?>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
							<?php
							}

							?>
							<!-- Submit Button -->
							<button class="btn btn-transparent" name="editPassword" type="submit">Change Password</button>
						</form>
					</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<!-- Change Email Address -->
					<div class="widget change-email mb-0">
						<h3 class="widget-header user">Edit Email</h3>
						<form method="post">
							
							<div class="form-group">
								<label for="current-email">Email Actuel</label>
								<input type="email"  class="form-control" value="<?php echo $row['email']; ?>" >
							</div>
							<!-- New email -->
							<div class="form-group">
								<label for="new-email">New email</label>
								<input type="email" name="email" class="form-control" id="new-email">
							</div>
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
							<!-- Submit Button -->
							<button class="btn btn-transparent" name="upmail">Change email</button>
						</form>
					</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<!-- Change Password -->
					<div class="widget change-imge">
						<h3 class="widget-header user">Edit Image</h3>
						<form method="post" enctype="multipart/form-data">
							<!-- Current Password -->
							<!-- File chooser -->
							<div class="form-group choose-file d-inline-flex">
								<i class="fa fa-user text-center px-3"></i>
								<input type="file" name="profile_picture" class="form-control-file mt-2 pt-1" id="input-file">
							</div>
							<!-- Submit Button -->
							<button class="btn btn-transparent" name="upload_image" type="submit">Modifier</button>
						</form>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php require '../../footer.php'; ?>