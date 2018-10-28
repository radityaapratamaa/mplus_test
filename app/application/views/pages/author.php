<div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Master Data Author</div>
            <div class="card-body">
              <button class="btn btn-primary" onclick="show_modal('author', 'insert')">Add New</button>
              <br>
              <br>
              <div class="table-responsive">
                <?php $this->load->view('pages/tables'); ?>
              </div>
            </div>
            <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
          </div>
          <script type="text/javascript">
            $(function () {
              reload_tables("author");
            })
          </script>