<?php

get_header();
require ABSPATH.'wp-load.php';
global $wpdb;




$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$username = explode('/', $actual_link)[5];
 
$user = get_user_by('login', $username);

$current_user = wp_get_current_user();

$gal_result = $wpdb->get_results("SELECT * from gallery where user_id = $user->ID");

$bra_result = $wpdb->get_results("SELECT * from brands where user_id = $user->ID");

function countData($v, $args)
{
    foreach ($args as $ar) {
        if ($ar->video_upload && $v == 'video') {
            $count[] = $ar->video_upload;
        } elseif ($ar->img_upload && $v == 'image') {
            $count[] = $ar->img_upload;
        } elseif ($ar->ext_url && $v == 'ext') {
            $count[] = $ar->ext_url;
        }
    }
    return count((array)$count);
}

$galImageCount = countData('image', $gal_result);
$galVideoCount = countData('video', $gal_result);
$galExtCount = countData('ext', $gal_result);
$braImages = countData('image', $bra_result);
$braVideoCount = countData('video', $bra_result);

$bragalExtCount = (countData('ext', $bra_result)) ?: 0;

?>

<?php
$userCover = get_user_meta($user->ID, '_user_profile_cover', true);
if ($userCover == '') {
    $userCoverImage = 'http://localhost/test/wp-content/uploads/2021/12/download-1.png';
} else {
    $userCoverImage = wp_get_attachment_url($userCover);
}
?>
<?php if(!empty($user)): ?>
<div id="profile_cover" style="background:url(<?php echo $userCoverImage; ?>) no-repeat; background-size:cover; height:400px; position:relative">
    
<div class="camera">
        <?php if ($user->ID == $current_user->ID) : ?>
            <div class="camera_form">
                <label for="open_cover">
                    <i class="fas fa-camera"></i>

                    <input type="file" data-idd="<?php echo $current_user->ID; ?>" data-idd2="<?php echo $user->ID; ?>" name="image" class="image" data-id="<?php echo $user->ID; ?>" id="open_cover" style="display:none" />

            </div>
            </label>
    </div>

<?php endif; ?>
</div>
<?php endif; ?>
</div>
<div class="custom-container">
<?php if(empty($user)): ?>
    <div class="row">
        <div class="col-sm-12 col-12 d-block">
           <div class="d-flex flex-column justify-content-center align-items-center" style="height:100vh;"> 
           <i class="far fa-frown text-white fa-5x border-0"></i>
           <h3 class="text-white">No user exists</h3>
           <a href="<?php echo site_url().'/register'; ?>">Register your account</a>
</div>
        </div>
    </div>
    <?php endif;?>   
    <?php if(!empty($user)): ?>
    <div class="row">
    
    <div class="w-100 d-block">
            <div class="card profile_card_page">
                <div class="user_img mb-3 d-block ">
                    <div class="image_area">
                        <label for="upload_image">
                            <?php
                            $avatar1 =  get_user_meta($user->ID, 'avatar_attachment_id', true);
                            if ($avatar1) {
                                $avatar =  wp_get_attachment_url(get_user_meta($user->ID, 'avatar_attachment_id', true));
                            } else {
                                $avatar = PLUGIN_URL.'views/assets/img/no-img.png';
                            }
                            ?>
                            <img src="<?php echo $avatar; ?>" id="profileImageUpload" class="img-fluid img-thumbnail rounded-circle" width="200px" height="200px" alt="">
                            <?php if($current_user->ID == $user->ID): ?>
                            <div class="overlay">
                                <div class="text">Upload Image</div>

                            </div>
                            <?php endif; ?>
                        </label>
                        <?php if($current_user->ID == $user->ID): ?>
                        <input type="file" name="image" class="image" data-id="<?php echo $user->ID; ?>" id="upload_image" style="display:none;" />
                        <?php endif; ?>
                        <!--<ul class="overlay" style="list-style:none;padding:0;">-->
                        <!--    <a href="javascript:void(0)" onclick="openfileinput()">-->
                        <!--        <li class="text">Upload Image </li>-->
                        <!--    </a>-->
                        <!--</ul>-->
                    </div>
                    <!--        <div class="d-flex justify-content-center my-2">
                        <button class="btn btn-danger rounded-0">Follow</button>
                        <button class="btn btn-success ml-2 rounded-0 ">Message</button>
                    </div> -->
                </div>
                <!--
                <hr style="background:#ccc; height:0.5px;">
                <ul class="all_profile_status py-3" style="list-style:none; margin:0; padding:0; ">
                    <li>
                        <div class="text-center">22<br>Gallery</div>
                    </li>
                    <li>
                        <div class="text-center">2<br>Brands</div>
                    </li>
                    <li>
                        <div class="text-center">10<br>Externals</div>
                    </li>


                </ul>
                -->

                <?php

                $fb = get_user_meta($user->ID, '_facebook', true);
                $twitter = get_user_meta($user->ID, '_twitter', true);
                $instagram = get_user_meta($user->ID, '_instagram', true);
                $linkedin = get_user_meta($user->ID, '_linkedin', true);
                $tiktok = get_user_meta($user->ID, '_tiktok', true);
                $snapchat = get_user_meta($user->ID, '_snapchat', true);


                ?>
                <div class="socials-title">
                    <ul class="all_profile_social_links" style="list-style:none; margin:0; padding:0; ">
                        <?php if ($fb != '') : ?>
                            <li><a href="<?php echo get_user_meta($user->ID, '_facebook', true); ?>" class="nav-link p-0"><i class="fab fa-facebook-f"></i></a></li>
                        <?php endif; ?>
                        <?php if ($twitter != '') : ?>
                            <li><a href="<?php echo get_user_meta($user->ID, '_twitter', true); ?>" class="nav-link p-0"><i class="fab fa-twitter"></i> </a></li>
                        <?php endif; ?>
                        <?php if ($instagram != '') : ?>
                            <li><a href="<?php echo get_user_meta($user->ID, '_instagram', true); ?>" class="nav-link p-0"><i class="fab fa-instagram"></i></a></li>
                        <?php endif; ?>
                        <?php if ($linkedin != '') : ?>
                            <li><a href="<?php echo get_user_meta($user->ID, '_linkedin', true); ?>" class="nav-link p-0"><i class="fab fa-linkedin-in"></i></a></li>
                        <?php endif; ?>
                        <?php if ($tiktok != '') : ?>
                            <li><a href="<?php echo get_user_meta($user->ID, '_tiktok', true); ?>" class="nav-link p-0"><i class="fab fa-tiktok"></i></a></li>
                        <?php endif; ?>
                        <?php if ($snapchat != '') : ?>
                            <li><a href="<?php echo get_user_meta($user->ID, '_snapchat', true); ?>" class="nav-link p-0"><i class="fab fa-snapchat-ghost"></i></a></li>
                        <?php endif; ?>

                    </ul>

                    <h4 class="ml-3"><?php echo get_user_meta($user->ID, 'first_name', true) . ' ' . get_user_meta($user->ID, 'last_name', true); ?></h4>


                </div>

                <div class="profile-sidebar-drop">
                    <a><i class="fas fa-cog for-drop-click"></i></a>
                    <ul class="all_profile_sidebar py-3" style="list-style:none; margin:0; padding:10px; ">
                        <li><a href="javascript:void(0)" class="nav-link p-0" id="view_profile"><i class="fas fa-home mr-1"></i> Overview</a></li>
                        <?php if (is_user_logged_in() && $user->ID == $current_user->ID) : ?>
                            <li><a href="javascript:void(0)" class="nav-link p-0" id="edit_profile"><i class="far fa-edit mr-1"></i> Edit Profile</a></li>
                            <li><a href="<?php echo site_url() . '/my-account'; ?>" class="nav-link p-0" id="open_privacy"><i class="far fa-user mr-1"></i> Account Settings</a></li>
                        <?php endif; ?>
                        <!-- <li><a href="javascript:void(0)" class="nav-link p-0" data-id="<?php /*echo $user->ID;*/ ?>"><i class="far fa-flag mr-1"></i> Help</a></li> -->
                    </ul>
                </div>


            </div>
        </div>
        <!--View Profile Div Starts-->
    </div>
</div>
<?php endif; ?>
<?php require_once PLUGIN_DIR_PATH . 'templates/view-profile.php'; ?>
<!--Profile Overview Ends-->



<!--Card Ends -->



<!--Card Ends -->

</div>

</div>
<!--Last-->
<!--View Profile Div ends-->
<!--Edit Form-->
<?php require_once PLUGIN_DIR_PATH . 'templates/edit-profile.php'; ?>
<!--Edit Form Ends-->
<!--Edit Form-->
<?php require_once PLUGIN_DIR_PATH . 'templates/public/galleries/all-galleries.php'; ?>

<!--Edit Form Ends-->
</div>

<?php require_once PLUGIN_DIR_PATH . 'templates/public/galleries/all-images.php'; ?>
<?php require_once PLUGIN_DIR_PATH . 'templates/public/galleries/all-videos.php'; ?>
<?php require_once PLUGIN_DIR_PATH . 'templates/public/galleries/all-external.php'; ?>
<?php require_once PLUGIN_DIR_PATH . 'templates/public/brands/all-brands.php'; ?>
<?php require_once PLUGIN_DIR_PATH . 'templates/public/brands/all-images.php'; ?>
<?php require_once PLUGIN_DIR_PATH . 'templates/public/brands/all-external.php'; ?>
<?php require_once PLUGIN_DIR_PATH . 'templates/public/brands/all-videos.php'; ?>
<?php require_once PLUGIN_DIR_PATH . 'templates/modals/editGallery.php'; ?>

</div>



</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Image Before Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="" id="sample_image" />
                        </div>
                        <div class="col-md-4">
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="crop" class="btn btn-primary">Crop & Upload</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
    <!--Profile Image Crop Modal Ends-->
    <!--Profile Cover Crop Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crop Image Before Upload</h5>
                    <button type="button" class="close" data-dismiss="exampleModal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img src="" id="sample_image1" />
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="crop1" class="btn btn-primary">Crop & Upload</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>

        <div class="modal openCropper1" tabindex="-1" role="dialog" aria-labelledby="openCropper1Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="openCropper1Label">Upload & Crop Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img_demo1" style="width:350px; margin-top:30px;">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success crop_img1">Crop & Upload Image</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

           
            <!--Profile Cover Crop Modal Ends-->
            <?php get_footer(); ?>