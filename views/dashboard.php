<?php if(!is_user_logged_in()){
    header('location:'.site_url().'/login');
}
?>


<?php 

get_header(); 

$user = wp_get_current_user();






?>

<div class="container-fluid accPage">
    	<div class="login-header d-flex justify-content-center">
		<img src="<?php echo site_url();?>/wp-content/uploads/2021/12/logo_2.png">
	</div>
<div class="row">
    		

    <div class="col-md-4 col-sm-6 col-xs-12 d-block p-info myAccSideBar">
    <?php 
        $avatar1 =  get_user_meta($user->ID,'avatar_attachment_id',true); 
        if($avatar1 != '')
        {
            $avatar =  wp_get_attachment_url(get_user_meta($user->ID,'avatar_attachment_id',true));
        }
        else{
            $avatar = PLUGIN_URL.'views/assets/img/no-img.png';
        }
        ?>  
        <div class="user_img mb-3 userDetail">
            <img src="<?php echo $avatar; ?>" class="img-fluid img-thumbnail rounded-circle" width="200px" height="200px" alt="">
            <h4 class="pt-3"><?php echo get_user_meta($user->ID,'first_name',true).' '.get_user_meta($user->ID,'last_name',true); ?></h4>
            <a href="<?php $url = site_url().'/'.strtolower($user->user_login); echo $url;  ?>" class='nav-link p-0'>View Profile</a>
        </div>
        <ul class="pt-3 sideBarEx" style="list-style:none; margin:0; padding:0; ">
            <li><a href="javascript:void(0)" class="nav-link " id="my_account">My Account</a></li>
            <li><a href="javascript:void(0)" class="nav-link " id="change_password">Change Password</a></li>
            <li><a href="javascript:void(0)" class="nav-link " id="open_privacy">Privacy</a></li>
            <li><a href="javascript:void(0)" class="nav-link " id="delete_user" data-id="<?php echo $user->ID; ?>">Delete Account</a></li>
            <li><a href="<?php echo wp_logout_url(site_url().'/login'); ?>" class="nav-link">Logout</a></li>

        </ul>
    </div>
    <div class="col-md-8 col-sm-6 col-xs-12 d-block p-edit">
		
        <div class="">
           
            <div id="changHeading"><h3>Account</h3></div>
            <!---Update user form starts--->
            <div id="update_user_form">
            <div class="">
                <div class="form-group">
                    <label for="u_name">Username</label>
                    <input type="text" name="u_name" disabled value="<?php echo $user->user_login; ?>" id="u_name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" value="<?php echo get_user_meta($user->ID,'first_name',true); ?>" id="fname" class="form-control">
                </div>
                <div class="form-group">
                    <label for="lname">Last name</label>
                    <input type="text" name="lname" id="lname" value="<?php echo get_user_meta($user->ID,'last_name',true); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="u_email">Email</label>
                    <input type="text" name="u_email" value="<?php echo $user->user_email; ?>" id="u_email" class="form-control">
                </div>
                
            </div>
            <div class="">
                <button class="btn btn-primary"  id="update_user" data-id="<?php echo $user->ID; ?>">Update</button>
            </div>
            </div>
            <!---Update user Form Ends--->
            <!---Update user form starts--->
            <div id="update_password" style="display:none;">
            <div class="">
                <div class="form-group">
                    <label for="c_pass">Current Password</label>
                    <input type="password" name="c_pass" id="c_pass" class="form-control">
                    <div id="error_msg1"></div>
                </div>
                <div class="form-group">
                    <label for="new_pass">New Password</label>
                    <input type="password" name="new_pass" id="new_pass" class="form-control">
                    <div id="error_msg2"></div>
                </div>
                <div class="form-group">
                    <label for="con_pass">Confirm Password</label>
                    <input type="password" name="con_pass" id="con_pass" class="form-control">
                    <div id="error_msg3"></div>
                </div>
                
            </div>
            <div class="">
                <button class="btn btn-primary" type="button"  id="change_pass1" data-id="<?php echo $user->ID; ?>">Update</button>
                <div id="error_msg4"></div>
            </div>
            </div>
            <!---Update user Form Ends--->
            <!---Privacy Settings starts--->
            <div id="privacy_settings" style="display:none;">
            <div class="">
                <div class="form-group">
                    <label for="privacy">Profile Privacy</label>
                     <select class="form-control" id="select_role"> 
                     <option value="private_role" <?php if(get_user_meta(wp_get_current_user()->ID,'_privacy',true) == 'private'){ echo "selected"; } ?>>Only for me</option>
                     <option value="editor" <?php if(get_user_meta(wp_get_current_user()->ID,'_privacy',true) == 'everyone'){ echo "selected"; } ?>>Everyone</option>
                    </select>  
                    <div id="error_msg1"></div>
                </div>
            </div>
            <div class="">
                <button class="btn btn-primary" type="button"  id="update_role" data-id="<?php echo $user->ID; ?>">Update</button>
                <div id="error_msg4"></div>
            </div>
            </div>
            <!---Privacy Settings Ends--->
        </div>
    </div>
</div>

</div>



</div>


<?php get_footer(); ?>