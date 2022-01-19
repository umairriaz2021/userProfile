<?php

if($_REQUEST['param'] === 'user_login')
{
    
    $user = $_REQUEST['uname'];
    $pass = $_REQUEST['pass'];

    $creds = array();
    $creds['user_login'] = $user;
    $creds['user_password'] = $pass;
    $creds['remember'] = true;
    $user = wp_signon( $creds, true );
    if(is_wp_error($user))
    {
        echo json_encode(['status'=>400,'message'=>$user->get_error_message()]);
    }
    else{
        wp_set_current_user( $user->ID);
        
        echo json_encode(['status'=>200,'message'=>'user logged in successfully','site_url'=>site_url().'/my-account']);
    }


}
if($_REQUEST['param'] === 'update_user_details')
{
    $fname = $_REQUEST['fname'];
    $lname = $_REQUEST['lname'];
    $email = $_REQUEST['u_email'];
    $id = $_REQUEST['id'];

    wp_update_user(['ID'=>$id,'user_email' => $email]);
    update_user_meta($id,'first_name',$fname);
    update_user_meta($id,'last_name',$lname);
    
    echo json_encode(['status'=>200,'message'=>'User details updated']);

}
if($_REQUEST['param'] === 'change_pass')
{
    $curr_pass = $_REQUEST['c_pass'];
    $new_pass = $_REQUEST['new_pass'];
    $con_pass = $_REQUEST['con_pass'];

    $id = $_REQUEST['id'];
    $user = get_user_by('id',$id);
    if($new_pass !== $con_pass)
    {
        echo json_encode(['status'=>400,'message'=>'Your new password not match with confirm password']);die;
    }
    
    elseif(wp_check_password($curr_pass,$user->user_pass) == false)
    {
        echo json_encode(['status'=>400,'message'=>'Your current password is not correct']);die;
    }
    elseif($new_pass === $con_pass && wp_check_password($curr_pass,$user->user_pass) == true){
        $wp_hasher = new PasswordHash(16, FALSE);
        $hashedPassword = wp_hash_password($new_pass);
        $wpdb->update('wp_users',array('ID'=>$id,'user_pass'=>$hashedPassword),array('ID'=>$id));
        //$wpdb->update('wp_users',['ID'=>$id,'user_pass'=>$hashedPassword],['ID'=>$id]);

        echo json_encode(['status'=>200,'message'=>'Your password has been changed','site_url'=>site_url().'/login']);
    }


}

if($_REQUEST['param'] === 'updateRole'){
    $user = wp_get_current_user();
    $role = $_REQUEST['role'];
    if($role === 'private_role')
    {
        update_user_meta($user->ID,'_privacy','private');
        update_user_meta($user->ID,'_ulogin','login');
    }
    else{
        update_user_meta($user->ID,'_privacy','everyone');
        
    }
    echo json_encode(['status'=>200,'message'=>'Privacy set successfully']);
}

if($_REQUEST['param'] === 'delete_account')
{
  
    $id = $_REQUEST['id'];
    $deleted = wp_delete_user($id);
    if($deleted)
    {
        echo json_encode(['status'=>200,'site_url'=>site_url().'/login']);
    }
}

if($_REQUEST['param'] === 'update_edit_details')
{
       $id = $_REQUEST['id'];
       $user_desc = $_REQUEST['user_desc'];
       $fname = $_REQUEST['fname'];
       $lname = $_REQUEST['lname'];
       $fb = $_REQUEST['fb'];
       $desc = $_REQUEST['user_desc'];
       $instagram = $_REQUEST['instagram'];
       $linkedin = $_REQUEST['linkedin'];
       $tiktok = $_REQUEST['tiktok'];
       $snapchat = $_REQUEST['snapchat'];
       $twitter = $_REQUEST['twitter'];

       update_user_meta($id,'first_name',$fname);
       update_user_meta($id,'user_desc',$desc);
       update_user_meta($id,'last_name',$lname);
       update_user_meta($id,'_twitter',$twitter);
       update_user_meta($id,'_facebook',$fb);
       update_user_meta($id,'_instagram',$instagram);
       update_user_meta($id,'_linkedin',$linkedin);
       update_user_meta($id,'_tiktok',$tiktok);
       update_user_meta($id,'_snapchat',$snapchat);

       echo json_encode(['status'=>200,'message'=>'Details updated successfully']);
       

}

if($_REQUEST['param'] === 'add_user'){
  
    
    
    $fname = $_REQUEST['fname'];
    $lname = $_REQUEST['lname'];
    $uemail = $_REQUEST['uemail'];
    $upass = $_REQUEST['upass'];
    $uconf = $_REQUEST['uconf'];
    $username = $_REQUEST['u_name'];

    $image = $_FILES['img_upload'];
    $gallery = $_FILES['gallery'];
    
    
    if($upass == $uconf){
   
    $userid = dipexel_create_user(str_replace(' ','',strtolower($username)),$upass,$uemail);
    $role = new WP_User($userid);
    $role->set_role('editor');
    $userdata = array(
        'ID'                   => $userid,      
        'display_name'          => $fname.' '.$lname,   
        'first_name'            => $fname,   
        'last_name'             => $lname,
    );

    wp_update_user($userdata);
    update_user_meta($userid,'_privacy','everyone');
    update_user_meta($userid,'_ulogin','login');
    //Image Upload Code
         
         if($image){
            userImageUpload($userid,$image);  
         }
            
            
        
        echo json_encode(['status'=>200,'msg'=>'User Created Successfully','site_url'=>site_url().'/login']);   

    }
        else{
            
            echo json_encode(['status'=>400,'msg'=>'Your confirm password not matched']);   
      }

    

}
