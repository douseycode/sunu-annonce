<?php
include_once '../../../header.php';
include_once '../../../navbar.php';
require '../../../actions/auth/securityAdmin.php';
require '../../../Database/admin_db.php';

$annonces = getAllAnnonces();

?>

<!-- <main class="flex-shrink-0"> -->
    <div class="container">
        <h1 class="mt-5">Annonce</h1>


        <table id="myDataTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>État</th>
                    <th>Date Publication</th>
                    <th>Date Modification</th>
                    <th>Categorie</th>
                    <th>View</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($annonce = $annonces->fetch()) : ?>
                    <tr>
                        <td><img class="tbimg" width="110px" height="100px" src="../../../uploads/<?= $annonce['image'] ?>"></td>
                        <td><?= $annonce['titre'] ?></td>
                        <td><?= $annonce['description'] ?></td>
                        <td><?= $annonce['etat'] ?></td>
                        <td><?= $annonce['date_creation'] ?></td>
                        <td><?= $annonce['date_update'] ?></td>
                        <td><?= $annonce['categorie_name'] ?></td>
                        <td>
                        <?php if($annonce['etat']!== 'REJETEE') : ?>
                          <a data-toggle="tooltip" data-placement="top" title="View" class="view" href="../../view_annonce.php?id=<?= $annonce['id'] ?>">
                                      <i class="fa fa-eye"></i>Voir
                          </a>
                          <?php endif; ?>
                        </td>
                        <td>
                
            
                        <?php if (!$annonce['validate'] && $annonce['etat'] !== 'REJETEE' ) { ?>
    <a href="../../../actions/admin/admin_action.php?action=validate&id=<?= $annonce['id'] ?>" class="btn btn-success">Valider</a>
    <a href="../../../actions/admin/admin_action.php?action=rejet&id=<?= $annonce['id'] ?>" class="btn btn-danger">Rejeter</a>
<?php } ?>
<a class="btn btn-danger" data-toggle="modal" data-target="#deleteaccount<?= $annonce['id'] ?>">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
    </svg>
</a>
   
                            
                        </td>
                    </tr>
               <!-- Modal -->
<div class="modal fade" id="deleteaccount<?= $annonce['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
        <h6 class="py-2">Êtes-vous sûr de vouloir supprimer votre annonce ?</h6>
        
      </div>
      <div class="modal-footer border-top-0 mb-3 mx-5 justify-content-center">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
        <!-- <button type="button"  class="btn btn-danger">Delete</button> -->
        <a href="/actions/admin/annoncedeleteAction.php?id=<?= $annonce['id'] ?>" type="button" class="btn btn-danger">Oui</a>
      </div>
    </div>
  </div>
</div>
                <?php endwhile; ?>
                
            </tbody>
        </table>
    </div>


<?php
include_once '../../../footer.php';
?>
