<?php 
// $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// $user = end(explode('/',$actual_link));

$current_user = wp_get_current_user();
if(is_user_logged_in()){
  header('location:'.site_url().'/my-account');
}
?>
<?php get_header();?>

<div class="container">

<div class="d-flex flex-column login-form justify-content-center align-items-center">
	    	<div class="login-header">
		<img src="<?php echo site_url();?>/wp-content/uploads/2021/12/logo_2.png">
	</div>
    <div class="input-form-wrapper"  >
  <div class="input">
    <label for="u_name" class="form-label">Username / Email</label>
    <input type="text" class="form-control" id="u_name">
    <div id="error_msg1">
    
</div>
</div>
  <div class="input">
    <label for="u_pass" class="form-label">Password</label>
    <input type="password" id="u_pass" class="form-control">
    <div id="error_msg2">
    
   </div>
</div>
  
  

<div class="login-btns">
<button type="submit" class="btn btn-primary" id="login_user">Login</button>

<a href="<?php echo site_url().'/register'; ?>" type="button" class="btn login_register">Register</a>

</div>    
		<div id="error_msg3">
    
</div>
</div>       
    </div>
</div>

<?php get_footer(); ?>