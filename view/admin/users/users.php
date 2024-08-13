<?php


$user = true;

include_once '../../../header.php';

include_once '../../../navbar.php';
require '../../../actions/auth/securityAdmin.php';

require('../../../Database/utilisateur_db.php');


$users = getAllusers();
?>
<style>
    .tbimg{
        border-radius: 50%;
    }
</style>
<!-- Begin page content -->

    <div class="container">
        <h1 class="mt-5">Utilisateurs</h1>
        <?php if (isset($errorMessage)) {
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
    
        <a href="add_user.php">
      <button type="button" class="float-end mb-2 btn btn-primary">
        Nouveau
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
          <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
        </svg>
      </button>
    </a>

  
    <table id="myDataTable" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Image</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Email</th>
            <th>Profil</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while($user = $users->fetch(PDO::FETCH_OBJ)) :?>
            <tr>
                <td><img class="tbimg" width="110px" height="100px" src="../../../assets/<?= $user->photo ?>"></td>
                <td><?= $user->nom ?></td>
                <td><?= $user->prenom ?></td>
                <td><?= $user->email ?></td>
               
                <td><?= $user->profil_name ?></td>
                <td>
                <?php if($user->status == 'Activer'){?>
                <a href="/actions/admin/bloquerUserAction.php?id=<?= $user->id ?>" class="btn btn-warning">
                  Bloquer
              </a>
              <?php } else {?>
              <a href="/actions/admin/debloquerUserAction.php?id=<?= $user->id ?>" class="btn btn-success">
                  Debloquer
              </a>
              <?php } ?>
        </td>
        <td>
        <a  class="btn btn-danger" data-toggle="modal" data-target="#deleteaccount<?=  $user->id ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                </svg>
                            </a> 
              <a href="edit_user.php?id=<?= $user->id ?>" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                </svg>
              </a>
                </td>
            </tr>
                <!-- Modal -->
          
          <div class="modal fade" id="deleteaccount<?= $user->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <img src="images/account/Account1.png" class="img-fluid mb-2" alt="">
        <h6 class="py-2">Êtes-vous sûr de vouloir supprimer cet user ?</h6>
        
      </div>
      <div class="modal-footer border-top-0 mb-3 mx-5 justify-content-center">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
        <!-- <button type="button"  class="btn btn-danger">Delete</button> -->
        <a href="/actions/admin/deleteUserAction.php?id=<?= $user->id ?>" type="button" class="btn btn-danger">Oui</a>
      </div>
    </div>
  </div>
</div>
        <?php endwhile;?>
    </tbody>
</table>

    </div>


<?php
include_once '../../../footer.php'
?>