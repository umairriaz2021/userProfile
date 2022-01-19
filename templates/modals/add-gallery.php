<div class="modal fade" id="openGallery" tabindex="-1" role="dialog" aria-labelledby="openGalleryLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="openGalleryLabel">Add Gallery</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="submitGallery" method="POST" data-uid="<?php echo $user->ID; ?>" enctype="multipart/form-data">
        <input type="hidden" name="insertId" id="insertId">
        <div class="modal-body">

          <div class="form-group">
            <label for="g_title">Gallery Title</label>
            <input type="text" required name="g_title" id="g_title" class="form-control rounded-0" placeholder="Gallery Title">
          </div>
          <div class="form-group">
            <label for="g_desc">Description</label>
            <textarea name="g_desc" required id="g_desc" class="form-control rounded-0" cols="10" rows="1"></textarea>
          </div>
          <div class="form-group">
            <label for="g_link">URL</label>
            <input type="url" required name="g_url" id="g_url" class="form-control rounded-0" placeholder="https://www.abc.com">
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="check_ext_link" name="check_ext_link" value="0">
            <label class="form-check-label" for="check_ext_link"> External Link </label>
          </div>

          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="check_img" name="check_img" value="0">
            <label class="form-check-label" for="check_img">Upload Video Or Image</label>
          </div>

          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="check_ex" name="check_ex" value="0">
            <label class="form-check-label" for="check_img">Exclusive Content</label>
          </div>
          <div class="form-group my-3" id="g_ext_id">
            <label for="g_link">External Link</label>
            <input type="url" name="ext_link" id="ext_link" class="form-control rounded-0" placeholder="https://www.abc.com">
          </div>
          <div class="form-group my-3" id="g_img_id1">
            <label for="ext_thumbnail">Thumbnail Image</label>
            <input type="file" name="ext_thumbnail" class="form-control rounded-0" id="ext_thumbnail">
          </div>
          <div class="form-group my-3" id="g_img_id">
            <input type="file" name="img_upload" class="form-control rounded-0" id="img_upload">
          </div>
          <div id="pre_loader">
          <img src="<?php echo PLUGIN_URL.'views/assets/img/preloader.gif';?>" width="50px" height="50px" class="img-fluid">
          </div>    

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

