
<!-- Bootstrap core JavaScript-->
<script src="<?=ASSETS_URL?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?=ASSETS_URL?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="<?=ASSETS_URL?>vendor/chart.js/Chart.min.js"></script>
<script src="<?=ASSETS_URL?>vendor/datatables/jquery.dataTables.js"></script>
<script src="<?=ASSETS_URL?>vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?=ASSETS_URL?>js/sb-admin.min.js"></script>

<!-- Demo scripts for this page-->
<!-- <script src="<?//=ASSETS_URL?>js/demo/datatables-demo.js"></script> -->
<!-- <script src="<?//=ASSETS_URL?>js/demo/chart-area-demo.js"></script> -->

<script type="text/javascript">
    var dtTable = null;
    $(document).ready(function() {
        // show_modal("mm", "insert");
    });
        function show_modal(menu, action, id) {
            $.post('<?=BASE_URL?>ajax/show_modal/'+menu+"/"+action, {myid:id}, function(data, textStatus, xhr) {
                /*optional stuff to do after success */
                $("#modal-container").html(data);
            });
        }
    function reload_tables(menu) {
        $.get('<?=BASE_URL?>'+menu+'/reload_table', function(data) {
            // console.log(data)
            $("#datanya").html(data.body);
            $("#headernya").html(data.header);
            if (dtTable == null) dtTable = $("#dataTable").DataTable();
            else dtTable.fnDraw();
        }, "json");
    }
</script>