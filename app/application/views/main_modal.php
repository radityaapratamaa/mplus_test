<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><?= "Form $action" ?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="myalert" class="alert alert-danger">test</div>
            <br>
            <br>
            <?php $this->load->view("forms/$menu/$action"); ?>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" id="cancel-btn" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" id="save-btn" href="javascript:;">Save</a>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      $("#myalert").hide();
      $("#logoutModal").modal({
        "show": true,
        "backdrop": "static"
      });
      $("#save-btn").click(function() {
        $.post('<?=$link?>', $("#frm").serialize(), function(data, textStatus, xhr) {
          
          if(data.valid){
            if (data.resp == "sukses") {
              $("#cancel-btn").click();
              reload_tables(data.menu);
            }
          }else{
            $("#myalert").html(data.message).show("fast");
          }
          setTimeout(function() {
            $("#myalert").html("").hide("fast");
          }, 3000);
        }, "json");
      });
    </script>