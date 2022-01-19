<section class="<?php echo (!empty($user)) ? 'viewGallery': ''; ?>">
    <div class="container">
    <div class="row">
            <div class="col-md-12 col-12">
            <?php if($current_user->ID != $user->ID && get_user_meta($user->ID,'_privacy',true) == 'everyone' || $user->ID == $current_user->ID  && get_user_meta($current_user->ID,'_ulogin',true) == 'login' ):?>
            
                <h4 class="text-white"><?php echo (get_user_meta($user->ID,'user_desc',true) ?'Hello,':'' ); ?></h4>
                <p class="text-white wordBreak"><?php echo get_user_meta($user->ID,'user_desc',true); ?></p>
           
            </div>
        </div>
    </div>
    <div class="container-fluid">
        
        <div class="row align-items-center">
        
            <div class="col-2">
                <h1 class="p-4 brands-heading">My Gallery</h1>
            </div>
            <div class="col-10 for-flow GallViewSec">
                <div class="parent-row d-flex py-5">
                   
                    <?php if ($gal_result) : ?>

                        <?php foreach ($gal_result as $res) : ?>
                            <?php if ($res->ext_url) : ?>
                                <a href="<?php echo $res->ext_url; ?>" target="_blank">
                               
                                <?php elseif(!empty($res->url)) : ?>
                                    
                                    <a href="<?php echo $res->url; ?>" target="_blank">
                                                                                  
                                <?php endif; ?>
                                <div class="data-img">
                                    <?php if ($res->img_upload) : ?>
                                        <img src="<?php echo wp_get_attachment_url($res->img_upload); ?>" class=" p-2" alt="">
                                    <?php elseif ($res->video_thumbnail) : ?>
                                    <img src="https://explainervideoz.com/stagging/profile2/wp-content/uploads/2022/01/video_play-removebg-preview.png" alt="" class="img-fluid" style="position:absolute;top:38%;left:38%;width:100px;height:50px;">
                                        <img src="<?php echo wp_get_attachment_url($res->video_thumbnail); ?>" class=" p-2" alt="">
                                    <?php elseif ($res->video_upload) : ?>
                                        <video src="<?php echo wp_get_attachment_url($res->video_upload); ?>" controls></video>
                                    <?php endif; ?>
                                    <div class="d-flex flex-row flex-wrap justify-content-between item_info">
                                        <h5 class="card-title">
                                        <?php if(!empty($res->url)): ?>    
                                        <a href="<?php echo $res->url; ?>" target="_blank"><?php echo $res->title; ?></a>
                                        <?php else: ?>
                                            <a href="javascript:void(0)"><?php echo $res->title; ?></a>
                                            
                                        <?php endif; ?>
                                       </h5>
                                        <?php if ($res->desc_status == 1) : ?>
                                            <span><i class="fas fa-lock"></i></span>
                                        <?php endif; ?>
                                        <?php if ($res->desc_status == 0) : ?>
                                            <p class="card-text text-dark" style="font-size:1rem;"><?php echo $res->desc; ?></h5>
                                            <?php endif; ?>

                                    </div>
                                </div>
                                <?php if ($res->ext_url) : ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    
                </div>
            </div>
            
        </div>
        <div class="row align-items-center">
            <div class="col-2">
                <h1 class="p-4 brands-heading">My Brands</h1>
            </div>
            <div class="col-10 for-flow BrandViewSec">
                <div class="parent-row d-flex py-5">
              
                    <?php if ($bra_result) : ?>
                        <?php foreach ($bra_result as $result) : ?>
                            <?php if ($result->ext_url) : ?>
                                <a href="<?php echo $result->ext_url; ?>" target="_blank">
                                <?php elseif(!empty($result->url)): ?>
                                    <a href="<?php echo $result->url; ?>" target="_blank">
                                <?php endif; ?>
                                <div class="data-img">
                                    <?php if ($result->img_upload) : ?>
                                        <img src="<?php echo wp_get_attachment_url($result->img_upload); ?>" class=" p-2" alt="">
                                    <?php elseif ($result->video_thumbnail) : ?>
                                        <img src="https://explainervideoz.com/stagging/profile2/wp-content/uploads/2022/01/video_play-removebg-preview.png" alt="" class="img-fluid" style="position:absolute;top:38%;left:38%;width:100px;height:50px;">
                                        <img src="<?php echo wp_get_attachment_url($result->video_thumbnail); ?>" class="test_upload_thumb p-2" alt="">
                                    <?php elseif ($result->video_upload) : ?>
                                        <video src="<?php echo wp_get_attachment_url($result->video_upload); ?>" controls></video>
                                    <?php endif; ?>
                                    <div class="d-flex flex-row flex-wrap justify-content-between item_info">
                                        <h5 class="card-title">
                                        <?php if(!empty($result->url)): ?>    
                                        <a href="<?php echo $result->url; ?>" target="_blank"><?php echo $result->title; ?></a>
                                        <?php else: ?>
                                        <a href="javascript:void(0)"><?php echo $result->title; ?></a>
                                        <?php endif; ?> 
                                       </h5>
                                        <?php if ($result->desc_status == 1) : ?>
                                            <span><i class="fas fa-lock"></i></span>
                                        <?php endif; ?>

                                    </div>
                                </div>
                                <?php if ($result->ext_url) : ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                        

                </div>
                                    
            </div>
            <?php  elseif($current_user->ID != $user->ID &&  get_user_meta($user->ID,'_privacy',true) == 'privacy'): ?>
              
            <?php if(!empty($user)): ?>
            <h4 class="text-white">Hello,</h4>
            <p class="text-white wordBreak"><?php echo get_user_meta($user->ID,'user_desc',true); ?></p>
       
        </div>
    </div>
</div>
<div class="container-fluid">
    
    <div class="row align-items-center">
    
        <div class="col-2">
            <h1 class="p-4 brands-heading">My Gallery</h1>
        </div>
        <div class="col-10 for-flow ">
            <div class="parent-row d-flex py-5">
               
                <?php if ($gal_result) : ?>

                    <?php foreach ($gal_result as $res) : ?>
                        <?php if ($res->ext_url) : ?>
                            <a href="<?php echo ($res->ext_url); ?>" target="_blank">
                                <?php elseif(!empty($res->url)):?>
                                    <a href="<?php echo ($res->url); ?>" target="_blank">
                            <?php endif; ?>
                            <div class="data-img">
                                <?php if ($res->img_upload) : ?>
                                    <img src="<?php echo wp_get_attachment_url($res->img_upload); ?>" class=" p-2" alt="">
                                <?php elseif ($res->video_thumbnail) : ?>
                                <img src="https://explainervideoz.com/stagging/profile2/wp-content/uploads/2022/01/video_play-removebg-preview.png" alt="" class="img-fluid" style="position:absolute;top:38%;left:38%;width:100px;height:50px;">
                                    <img src="<?php echo wp_get_attachment_url($res->video_thumbnail); ?>" class=" p-2" alt="">
                                <?php elseif ($res->video_upload) : ?>
                                    <video src="<?php echo wp_get_attachment_url($res->video_upload); ?>" controls></video>
                                <?php endif; ?>
                                <div class="d-flex flex-row flex-wrap justify-content-between item_info">
                                    <h5 class="card-title">
                                    <?php if(!empty($res->url)):  ?>    
                                    <a href="<?php echo $res->url; ?>" target="_blank"><?php echo $res->title; ?></a>
                                    <?php else: ?>
                                        <a href="javascript:void(0)"><?php echo $res->title; ?></a>
                                    <?php endif; ?>    
                                    </h5>
                                    <?php if ($res->desc_status == 1) : ?>
                                        <span><i class="fas fa-lock"></i></span>
                                    <?php endif; ?>
                                    <?php if ($res->desc_status == 0) : ?>
                                        <p class="card-text text-dark" style="font-size:1rem;"><?php echo $res->desc; ?></h5>
                                        <?php endif; ?>

                                </div>
                            </div>
                            <?php if ($res->ext_url) : ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
                
            </div>
        </div>
        
    </div>
    <div class="row align-items-center">
        <div class="col-2">
            <h1 class="p-4 brands-heading">My Brands</h1>
        </div>
        <div class="col-10 for-flow">
            <div class="parent-row d-flex py-5">
          
                <?php if ($bra_result) : ?>
                    <?php foreach ($bra_result as $result) : ?>
                        <?php if ($result->ext_url) : ?>
                            <a href="<?php echo $result->ext_url; ?>" target="_blank">
                            <?php elseif(!empty($result->url)): ?>
                                <a href="<?php echo $result->url; ?>" target="_blank"><?php echo $result->title; ?></a>
                            <?php endif; ?>
                            <div class="data-img">
                                <?php if ($result->img_upload) : ?>
                                    <img src="<?php echo wp_get_attachment_url($result->img_upload); ?>" class=" p-2" alt="">
                                <?php elseif ($result->video_thumbnail) : ?>
                                <img src="https://explainervideoz.com/stagging/profile2/wp-content/uploads/2022/01/video_play-removebg-preview.png" alt="" class="img-fluid" style="position:absolute;top:38%;left:38%;width:100px;height:50px;">
                                    <img src="<?php echo wp_get_attachment_url($result->video_thumbnail); ?>" class=" p-2" alt="">
                                <?php elseif ($result->video_upload) : ?>
                                    <video src="<?php echo wp_get_attachment_url($result->video_upload); ?>" controls></video>
                                <?php endif; ?>
                                <div class="d-flex flex-row flex-wrap justify-content-between item_info">
                                    <h5 class="card-title">
                                    <?php if(!empty($result->url)): ?>    
                                    <a href="<?php echo $result->url; ?>" target="_blank"><?php echo $result->title; ?></a>
                                    <?php else: ?>
                                    <a href="javascript:void(0)"><?php echo $result->title; ?></a>
                                    <?php endif; ?>        
                                </h5>
                                    <?php if ($result->desc_status == 1) : ?>
                                        <span><i class="fas fa-lock"></i></span>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <?php if ($result->ext_url) : ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
                    

            </div>
                                
        </div>
        <?php endif; ?>
                <?php else: ?>
                    <?php if(!empty($user)): ?> 
                    <div class="d-flex flex-column justify-content-center align-items-center w-100 vh-50 dd">
                         <i class="fas fa-lock fa-7x"></i>
                         <h3 class="text-white py-3">This User is Private</h3>
                     </div>
                     <?php endif; ?>  
                    <?php endif;?>
           
        </div>



    </div>
</section>

<section class="editGallery" style="display:none;">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-12 col-10 d-block m-auto">
                <div class="social_Links">
                    <form id="social_links_update" data-id="<?php echo $current_user->ID; ?>" class="w-75 m-auto" method="POST">
                        <div class="form-group">
                            <label for="p_desc">Profile Description</label>
                            <textarea name="p_desc" id="p_desc" cols="10" maxlength="180" rows="5" datatext="<?php echo strlen(get_user_meta($current_user->ID, 'user_desc', true)); ?>"><?php echo get_user_meta($current_user->ID, 'user_desc', true); ?></textarea>
                            <p class="d-flex justify-content-end w-100" style="color:#fff;"><span id="desc_count"><?php echo strlen(get_user_meta($current_user->ID, 'user_desc', true)); ?></span>/ 180</p>
                        </div>
                        <div class="form-group">
                            <label for="fname">First Name</label>
                            <input type="text" name="fname" value="<?php echo get_user_meta($current_user->ID, 'first_name', true); ?>" id="fname" class="form-control rounded-0">
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name</label>
                            <input type="text" name="lname" id="lname" value="<?php echo get_user_meta($current_user->ID, 'last_name', true); ?>" class="form-control rounded-0">
                        </div>
                        <div class="form-group">
                            <label for="twitter">Twitter</label>
                            <input type="url" name="twitter" value="<?php echo $twitter; ?>" id="twitter" class="form-control rounded-0">
                        </div>
                        <div class="form-group">
                            <label for="instagram">Instagram</label>
                            <input type="url" name="instagram" value="<?php echo $instagram; ?>" id="instagram" class="form-control rounded-0">
                        </div>
                        <div class="form-group">
                            <label for="linkedin">Linkedin</label>
                            <input type="text" name="linkedin" value="<?php echo $linkedin; ?>" id="linkedin" class="form-control rounded-0">
                        </div>
                        <div class="form-group">
                            <label for="tiktok">Tiktok</label>
                            <input type="text" name="tiktok" id="tiktok" value="<?php echo $tiktok; ?>" class="form-control rounded-0">
                        </div>
                        <div class="form-group">
                            <label for="snapchat">Snapchat</label>
                            <input type="text" name="snapchat" value="<?php echo $snapchat; ?>" id="snapchat" class="form-control rounded-0">
                        </div>
                        <div class="form-group">
                            <label for="facebook">Facebook</label>
                            <input type="text" name="facebook" id="facebook" value="<?php echo $fb; ?>" class="form-control rounded-0">
                        </div>
                        <div class="d-flex justify-content-center w-100">
                            <button class="btn btn-dark" type="submit">Update</button>
                        </div>

                    </form>
                </div>
            </div>
            <div class="col-2 my-5">
                <h1 class="p-4 brands-heading">My Gallery</h1>
            </div>
            <div class="col-10 for-flow GallEditSec">
                <div class="parent-row d-flex py-5">

                    <?php if ($gal_result) : ?>

                        <?php foreach ($gal_result as $res) : ?>
                            <?php if ($res->ext_url) : ?>
                                <a href="<?php echo $res->ext_url; ?>" target="_blank" id="ext_vdo_gal">
                                <?php endif; ?>
                                <div class="data-img editGalImg" data-toggle="modal" data-target="#editGal" data-id="<?php echo $res->id; ?>" id="editGalImg">
                                    <?php if ($user->ID == $current_user->ID) : ?>
                                        <div class="actionBtns">
                                            <button type="button" class="btn btn-primary editGalImg" data-toggle="modal" data-target="#editGal" data-id="<?php echo $res->id; ?>" id="editGalImg"><i class="fas fa-pencil-alt"></i></button>
                                            <button type="button" class="btn btn-danger delGal" id="delGal" data-attr="<?php echo $res->id; ?>"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($res->img_upload) : ?>
                                        <img src="<?php echo wp_get_attachment_url($res->img_upload); ?>" class=" p-2" alt="">

                                    <?php elseif ($res->video_thumbnail) : ?>
                                        <img src="<?php echo wp_get_attachment_url($res->video_thumbnail); ?>" class=" p-2" alt="">
                                    <?php elseif ($res->video_upload) : ?>
                                        <video src="<?php echo wp_get_attachment_url($res->video_upload); ?>" controls></video>
                                    <?php endif; ?>
                                    <?php if ($res->ext_url) : ?>

                                    <?php endif; ?>

                                    <div class="d-flex flex-row flex-wrap justify-content-between item_info">
                                        <h5 class="card-title">
                                        <?php if(!empty($res->url)): ?>    
                                        <a href="<?php echo $res->url; ?>" target="_blank"><?php echo $res->title; ?></a>
                                        
                                        <?php else: ?>
                                            <a href="javascript:void(0)"><?php echo $res->title; ?></a>
                                            <?php endif; ?> 
                                       </h5>
                                        <?php if ($res->desc_status == 1) : ?>
                                            <span><i class="fas fa-lock"></i></span>
                                        <?php endif; ?>
                                        <?php if ($res->desc_status == 0) : ?>
                                            <p class="card-text text-dark" style="font-size:1rem;"><?php echo $res->desc; ?></h5>
                                            <?php endif; ?>
                                    </div>
                                </div>
                                <?php if ($res->ext_url) : ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <a href="javascript:void(0)" class="openMyModal" style="display:none;" data-toggle="modal" data-target="#openGallery" id="openModal">
                        <div class="data-img before-plus">
                            <img src="https://explainervideoz.com/stagging/profile2/wp-content/uploads/2022/01/Capture.png">
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="row align-items-center">
            <div class="col-2">
                <h1 class="p-4 brands-heading">My Brands</h1>
            </div>
            <div class="col-10 for-flow BrandEditSec">
                <div class="parent-row d-flex py-5">
                    <?php if ($bra_result) : ?>
                        <?php foreach ($bra_result as $result) : ?>
                            <?php if ($result->ext_url) : ?>
                                <a href="<?php echo $res->ext_url; ?>" target="_blank" id="ext_vdo_br">
                                <?php endif; ?>
                                <div class="data-img editBrImg" data-toggle="modal" data-target="#editBr" data-id="<?php echo $result->id; ?>" id="editBrImg">
                                    <?php if ($user->ID == $current_user->ID) : ?>
                                        <div class="actionBtns">
                                            <button type="button" class="btn btn-primary editBrImg" data-toggle="modal" data-target="#editBr" data-id="<?php echo $result->id; ?>" id="editBrImg"><i class="fas fa-pencil-alt"></i></button>
                                            <button type="button" class="btn btn-danger delBr" id="delBr" data-attr="<?php echo $result->id; ?>"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($result->img_upload) : ?>
                                        <img src="<?php echo wp_get_attachment_url($result->img_upload); ?>" class=" p-2" alt="">
                                    <?php elseif ($result->video_thumbnail) : ?>
                                        <img src="<?php echo wp_get_attachment_url($result->video_thumbnail); ?>" class=" p-2" alt="">
                                    <?php elseif ($result->video_upload) : ?>
                                        <video src="<?php echo wp_get_attachment_url($result->video_upload); ?>" controls></video>
                                    <?php endif; ?>
                                    <div class="d-flex flex-row flex-wrap justify-content-between item_info">
                                        <h5 class="card-title">
                                        <?php if(!empty($result->url)): ?>    
                                        <a href="<?php echo $result->url; ?>" target="_blank"><?php echo $result->title; ?></a>
                                        <?php else: ?>
                                            <a href="javascript:void(0)"><?php echo $result->title; ?></a>
                                        <?php endif; ?>    
                                       </h5>
                                        <?php if ($result->desc_status == 1) : ?>
                                            <span><i class="fas fa-lock"></i></span>
                                        <?php endif; ?>

                                    </div>
                                </div>
                                <?php if ($res->ext_url) : ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <a href="javascript:void(0)" class="openMyModal1" data-toggle="modal" data-target="#openBrands" style="display:none;" id="openModal1">
                        <div class="data-img before-plus">
                            <img src="https://explainervideoz.com/stagging/profile2/wp-content/uploads/2022/01/Capture.png">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade editBr" id="editBr" tabindex="-1" role="dialog" aria-labelledby="editBrLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBrLabel">Edit Brand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="editBrandsform">

                </div>
            </div>
        </div>
    </div>
    <div id="crops1">

    </div>
</section>

<div class="modal fade editGal" id="editGal" tabindex="-1" role="dialog" aria-labelledby="editGalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editGalLabel">Edit Gallery</h5>
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



<!--Add Gallery Modal-->
<?php require_once PLUGIN_DIR_PATH . '/templates/modals/add-gallery.php'; ?>

<?php require_once PLUGIN_DIR_PATH . '/templates/modals/add-brands.php'; ?>

<div class="modal openCropper" id="openCropper" tabindex="-1" role="dialog" aria-labelledby="openCropperLabel" aria-hidden="true">
  <input type="hidden" id="lastId">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="openCropperLabel">Upload & Crop Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="img_demo" id="img_demo" style="width:350px; margin-top:30px;">
        </div>
        <div class="modal-footer">
          <button class="btn btn-success" id="crop_img">Crop & Upload Image</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!--Add Gallery Modal Ends-->
<!--Edit Gallery & Brands-->


<!--Edit Gallery & Brands Ends-->