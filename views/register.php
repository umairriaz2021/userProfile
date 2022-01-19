<?php if(is_user_logged_in()){
    header('location:'.site_url().'/my-account');
}
?>

<?php
/*
Template Name: User Signup Page
*/

get_header();
?>
<div class="container">

  <div class="d-flex flex-column justify-content-center align-items-center register-form">
 
     	<div class="login-header">
		<img src="<?php echo site_url();?>/wp-content/uploads/2021/12/logo_2.png">
	</div>
         <div class=" " id="error_msg">
         <form id="user_register" method="POST"  enctype="multipart/form-data">
         <div class="form-group">
             <label for="f_name">First Name</label>
             <input type="text" class="form-control" id="f_name" name="f_name" required >
         </div>
         <div class="form-group">
             <label for="l_Name">Last Name</label>
             <input type="text" class="form-control" id="l_name" name="l_name" required >
         </div>
         <div class="form-group">
             <label for="u_name">Username</label>
             <input type="text" class="form-control" required id="u_name" name="u_name" required >
         </div>
         <div class="form-group">
             <label for="u_email">Email</label>
             <input type="email" class="form-control" required id="u_email" name="u_email" required >
         </div>
         <div class="form-group">
             <label for="u_email">Password</label>
             <input type="password" class="form-control" required id="u_pass" name="u_pass" required >
         </div>
         <div class="form-group">
             <label for="u_conf">Confirm Password</label>
             <input type="password" class="form-control" required id="u_conf" required name="u_conf">
         </div>
         <div class="form-group">
             <label for="u_img">Upload Image</label>
             <input type="file" class="form-control" required id="u_img" name="u_img">
         </div>
       
         <button class="btn" id="form_submit" type="submit">Register</button>
         </form>
         </div>
     </div>

</div>


<?php get_footer();?>