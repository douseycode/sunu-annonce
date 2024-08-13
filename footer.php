
<script src="/plugins/jquery/jquery.min.js"></script>
<script src="/plugins/bootstrap/popper.min.js"></script>
<script src="/plugins/bootstrap/bootstrap.min.js"></script>
<script src="/plugins/bootstrap/bootstrap-slider.js"></script>
<script src="/plugins/tether/js/tether.min.js"></script>
<script src="/plugins/raty/jquery.raty-fa.js"></script>
<script src="/plugins/slick/slick.min.js"></script>
<script src="/plugins/jquery-nice-select/js/jquery.nice-select.min.js"></script>
z
<script src="/DataTables/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable({
            "oLanguage": {
                "sSearch": "Rechercher",
                "sLengthMenu": "Afficher _MENU_ Lignes par page",
                "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ enregistrements",
                "oPaginate": {
                    "sNext": "Suivant",
                    "sPrevious": "Précédent"
                }
            }
        });
    });
</script>
</body>
</html>