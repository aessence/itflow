<div class="modal" id="addDocumentFromTemplateModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-fw fa-file-alt"></i> New Document from Template</h5>
        <button type="button" class="close text-white" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <form action="post.php" method="post" autocomplete="off">
        <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
        <div class="modal-body bg-white">

          <label>Template</label>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-fw fa-puzzle-piece"></i></span>
              </div>
              <select class="form-control" name="document_template_id" required>
                <option value="">- Select Template -</option>
                <?php
                $sql_document_templates = mysqli_query($mysqli, "SELECT * FROM documents WHERE document_template = 1 AND company_id = $session_company_id AND document_archived_at IS NULL ORDER BY document_name ASC");
                while ($row = mysqli_fetch_array($sql_document_templates)) {
                  $document_template_id = $row['document_id'];
                  $document_template_name = htmlentities($row['document_name']);

                ?>
                <option value="<?php echo $document_template_id ?>"><?php echo $document_template_name; ?></option>
                <?php
                }
                ?>

              </select>
            </div>
          </div>

          <label>Document name</label>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-fw fa-file"></i></span>
              </div>
              <input type="text" class="form-control" name="name" placeholder="Name" required>
            </div>
          </div>

          <label>Folder</label>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-fw fa-folder"></i></span>
              </div>
              <select class="form-control" name="folder">
                <option value="0">/</option>
                <?php
                $sql_folders = mysqli_query($mysqli, "SELECT * FROM folders WHERE folder_client_id = $client_id ORDER BY folder_name ASC");
                while ($row = mysqli_fetch_array($sql_folders)) {
                  $folder_id = $row['folder_id'];
                  $folder_name = htmlentities($row['folder_name']);

                ?>
                <option <?php if (isset($_GET['folder_id']) && $_GET['folder_id'] == $folder_id) echo "selected"; ?> value="<?php echo $folder_id ?>"><?php echo $folder_name; ?></option>
                <?php
                }
                ?>

              </select>
            </div>
          </div>

        </div>

        <div class="modal-footer bg-white">

          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" name="add_document_from_template" class="btn btn-primary text-bold"><i class="fa fa-check"></i> Create & edit</button>

        </div>
      </form>
    </div>
  </div>
</div>
