<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>

        </div>
    </div>
</div>


<script src="<?= $ROOT ?>/assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= $ROOT ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= $ROOT ?>/assets/js/ruang-admin.min.js"></script>

<script src="<?= $ROOT ?>/assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= $ROOT ?>/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= $ROOT ?>/assets/js/script.js"></script>
<script src="<?= $ROOT ?>/assets/js/sweetalert.js"></script>


<script>
    $(document).ready(function() {
        $('#dataTableHover').DataTable();
    });
</script>

</body>

</html>