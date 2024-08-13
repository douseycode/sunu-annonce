<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-expand-lg navbar-light navigation">
					<a class="navbar-brand" href="/index.php">
						
                        <img height="70px" src="/assets/log.png" alt="">
					</a>
                    
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto main-nav ">
							<li class="nav-item active">
								<a class="nav-link" href="/index.php">Home</a>
							</li>
							<?php if (isset($_SESSION['auth']) && $_SESSION['auth']) { ?>
							<?php
							if (isset($_SESSION['profil']) && $_SESSION['profil'] == 2)  { ?>
							<li class="nav-item ">
								<a class="nav-link" href="/view/users/myespace/my_annonce.php">Mes annonces</a>
							</li>
                            <li class="nav-item ">
								<a class="nav-link" href="/view/users/profil.php">Profil</a>
							</li>
							<?php } else { ?>
							<li class="nav-item ">
								<a class="nav-link" href="/view/admin/annonces/annonces.php">Gerer Annonces</a>
							</li>
                            <li class="nav-item ">
								<a class="nav-link" href="/view/admin/users/users.php">Gerer Utilisateurs</a>
							</li>
							<?php } ?>
							<?php } ?>
							
						</ul>
						<ul class="navbar-nav ml-auto mt-10">
						<li class="nav-item">
						<?php
						if (isset($_SESSION['auth'])&&$_SESSION['auth']) {
							echo '<a class="nav-link login-button" href="/actions/auth/logoutAction.php">Deconnexion</a>';
						} else {
								echo '<a class="nav-link login-button" href="/view/auth/login.php">Login</a>';
							}
							?>
						</li>

							<li class="nav-item">
								<a class="nav-link text-white add-button" href="/view/users/myespace/add_annonce.php"><i class="fa fa-plus-circle"></i> Publier Annonce</a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</header>