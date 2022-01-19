<div class="modal fade" id="openBrands" tabindex="-1" role="dialog" aria-labelledby="openBrandsLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="openBrandsLabel">Add Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="submitBrands" method="POST" data-uid="<?php echo $user->ID; ?>" enctype="multipart/form-data">
        <input type="hidden" name="insertId12" id="insertId12">
        <div class="modal-body">

          <div class="form-group">
            <label for="b_title">Brand Title</label>
            <input type="text" name="b_title1" required id="b_title1" class="form-control rounded-0" placeholder="Brand Title">
          </div>

          <div class="form-group">
            <label for="b_url">URL</label>
            <input type="url" name="b_url1" required id="b_url1" class="form-control rounded-0" placeholder="https://www.abc.com">
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="check_ext_link1" name="check_ext_link1" value="0">
            <label class="form-check-label" for="check_ext_link"> External Link </label>
          </div>

          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="check_img1" name="check_img1" value="0">
            <label class="form-check-label" for="check_img1">Upload Video Or Image</label>
          </div>

          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="check_ex1" name="check_ex1" value="0">
            <label class="form-check-label" for="check_img">Exclusive Content</label>
          </div>
          <div class="form-group my-3" id="g_ext_id3">
            <label for="g_link">External Link</label>
            <input type="url" name="ext_link1" id="ext_link1" class="form-control rounded-0" placeholder="https://www.abc.com">
          </div>
          <div class="form-group my-3" id="g_img_id2">
            <label for="ext_thumbnail">Thumbnail Image</label>
            <input type="file" name="ext_thumbnail1" class="form-control rounded-0" id="ext_thumbnail1">
          </div>
          <div class="form-group my-3" id="g_img_id4">
            <input type="file" name="img_upload1" class="form-control rounded-0" id="img_upload1">
          </div>
          <div class="pre_loader" style="display:none;">
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

