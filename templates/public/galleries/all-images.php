<div id="all_images" style="display:none;">
  <div class="card p-3">

    <div class="row">


      <?php if ($gal_result) : ?>
        <?php foreach ($gal_result as $res) : ?>
          <?php if ($res->img_upload) : ?>
            <div class="col-md-6 col-sm-12 col-12 my-3">
              <a href="javascript:void(0)" class="text-decoration-none">
                <div class="card gal_card">
                  <img class="card-img-top" src="<?php echo wp_get_attachment_url($res->img_upload); ?>" class="img-fluid" height="50px;" alt="Card image cap">
                  <?php if ($user->ID == $current_user->ID) : ?>
                    <div class="actionBtns">
                      <button type="button" class="btn btn-primary editGalImg" data-toggle="modal" data-target="#editGal" data-id="<?php echo $res->id; ?>" id="editGalImg"><i class="fas fa-pencil-alt"></i></button>
                      <button type="button" class="btn btn-danger delGal" id="delGal" data-attr="<?php echo $res->id; ?>"><i class="fas fa-trash-alt"></i></button>
                    </div>
                  <?php endif; ?>
                  <div class="card-body">
                    <div class="d-flex flex-row flex-wrap justify-content-between">
                      <h5 class="card-title"><?php echo $res->title; ?></h5>
                      <?php if ($res->desc_status == 1) : ?>
                        <span><i class="fas fa-lock"></i></span>
                      <?php endif; ?>
                    </div>
                    <?php if ($res->desc_status == 0) : ?>
                      <p class="card-text text-dark" style="font-size:1rem;"><?php echo $res->desc; ?></h5>
                      <?php endif; ?>
                  </div>

                </div>
              </a>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>



    </div>
  </div>
</div>


<div class="modal fade editGal" id="editGal" tabindex="-1" role="dialog" aria-labelledby="editGalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editGalLabel">Edit Gallery Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="editGalleryform">

      </div>
    </div>
  </div>
</div>

<div id="crops">

</div>