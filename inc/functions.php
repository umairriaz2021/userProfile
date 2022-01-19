<?php

//add scripts
function dipexels_enqueue_scripts()
{

  global $post;
  $args = ['Sign up your account', 'Login Page', 'Profile Page', 'My Account'];
  // if (in_array($post->post_title, $args)) {

    //styles
    wp_enqueue_style('bootstrap-css', "https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css");
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
    wp_enqueue_style('main-profile', PLUGIN_URL . 'views/assets/css/profile.css');
    wp_enqueue_style('main-style', PLUGIN_URL . 'views/assets/css/style.css');

    //Scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array('jquery'), false, true);
    wp_enqueue_script('main-js', PLUGIN_URL . 'views/assets/js/main.js', array('jquery'), false, true);
    wp_localize_script('main-js', 'myajaxurl', admin_url('admin-ajax.php'));
  // }
  // $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  // $user = end(explode('/', $actual_link));
  // if (preg_match("/$user/i", $actual_link)) {
    //styles
    wp_enqueue_style('bootstrap-css', "https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css");
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
    wp_enqueue_style('drop-zone', 'https://unpkg.com/dropzone/dist/dropzone.css');
    wp_enqueue_style('cropper', 'https://unpkg.com/cropperjs/dist/cropper.css');
    wp_enqueue_style('croppiecs', 'https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css');

    wp_enqueue_style('profile-style', PLUGIN_URL . 'views/assets/css/profile.css');

    //Scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array('jquery'), false, true);
    wp_enqueue_script('dropzone-js', 'https://unpkg.com/dropzone', array('jquery'), false, true);
    wp_enqueue_script('cropper-js', 'https://unpkg.com/cropperjs', array('jquery'), false, true);
    wp_enqueue_script('croppie-js', 'https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js', array('jquery'), false, true);
    wp_enqueue_script('profile-js', PLUGIN_URL . 'views/assets/js/profile.js', array('jquery'), false, true);
    wp_enqueue_script('main-js', PLUGIN_URL . 'views/assets/js/main.js', array('jquery'), false, true);
    wp_localize_script('profile-js', 'myajaxurl', admin_url('admin-ajax.php'));
  }
//}
add_action('wp_enqueue_scripts', 'dipexels_enqueue_scripts');
add_action('init', function () {
  global $post;
  add_rewrite_rule('([^/]*)/?', 'index.php?user=$matches[1]', 'top');
  flush_rewrite_rules();
});

add_filter('query_vars', function ($query_vars) {
  $query_vars[] = 'user';

  return $query_vars;
});
add_action('template_include', function ($template) {

  // if (get_query_var('user') == false || get_query_var('user') == '') {
  //   return $template;
  // }
  // return PLUGIN_DIR_PATH . '/views/profile.php';

  if(get_query_var('user')){

    $template =  PLUGIN_DIR_PATH.'/views/profile.php';
  }
  if(get_query_var('user') == 'login'){

    $template =  PLUGIN_DIR_PATH.'/views/login.php';
  }
  if(get_query_var('user') == 'my-account'){

    $template =  PLUGIN_DIR_PATH.'/views/dashboard.php';
  }
  if(get_query_var('user') == 'register'){

    $template =  PLUGIN_DIR_PATH.'/views/register.php';
  }

  return $template;

});


function signup_page_redirect($template)
{

  global $post;
  $user = wp_get_current_user();
  $page_slug = $post->post_name;

  if ($page_slug == 'login') {
    $template = PLUGIN_DIR_PATH . '/views/login.php';
  }
  if ($page_slug == 'register') {
    $template = PLUGIN_DIR_PATH . '/views/register.php';
  }
  // if($page_slug == 'profile'){

  //   $template = PLUGIN_DIR_PATH.'/views/profile.php';
  // }
  if ($page_slug == 'my-account') {
    $template = PLUGIN_DIR_PATH . '/views/dashboard.php';
  }


  return $template;
}
add_filter('page_template', 'signup_page_redirect');

function add_custom_ajax()
{
  global $wpdb;
  require_once PLUGIN_DIR_PATH . '/inc/ajax.php';


  //echo "<pre>"; print_r($_REQUEST);die;
  wp_die();
}
add_action('wp_ajax_nopriv_mylibrary', 'add_custom_ajax');
add_action('wp_ajax_mylibrary', 'add_custom_ajax');


function add_profile_ajax()
{
  global $wpdb;
  require_once PLUGIN_DIR_PATH . '/inc/profile_ajax.php';


  //echo "<pre>"; print_r($_REQUEST);die;
  wp_die();
}
add_action('wp_ajax_nopriv_myProfilelibrary', 'add_profile_ajax');
add_action('wp_ajax_myProfilelibrary', 'add_profile_ajax');

function add_new_role()
{
  add_role(
    'private_role',
    __('Private User'),
    array(
      'read'  => true,
      'delete_posts'  => true,
      'delete_published_posts' => true,
      'edit_posts'   => true,
      'publish_posts' => true,
      'upload_files'  => true,
      'edit_pages'  => true,
      'edit_published_pages'  =>  true,
      'publish_pages'  => true,
      'delete_published_pages' => true, // This user will NOT be able to  delete published pages.
    )
  );
}
add_action('after_setup_theme', 'add_new_role');

//Image OR Video upload to media
function profileImageUpload($postId, $img)
{
  require_once(ABSPATH . 'wp-load.php');

  $wordpress_upload_dir = wp_upload_dir();
  // $wordpress_upload_dir['path'] is the full server path to wp-content/uploads/2017/05, for multisite works good as well
  // $wordpress_upload_dir['url'] the absolute URL to the same folder, actually we do not need it, just to show the link to file
  $i = 1; // number of tries when the file with the same name is already exists

  $profilepicture = $img;
  $new_file_path = $wordpress_upload_dir['path'] . '/' . $profilepicture['name'];
  $new_file_mime = mime_content_type($profilepicture['tmp_name']);

  if (empty($profilepicture))
    die('File is not selected.');

  if ($profilepicture['error'])
    die($profilepicture['error']);

  if ($profilepicture['size'] > wp_max_upload_size())
    die('It is too large than expected.');

  if (!in_array($new_file_mime, get_allowed_mime_types()))
    die('WordPress doesn\'t allow this type of uploads.');

  while (file_exists($new_file_path)) {
    $i++;
    $new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $profilepicture['name'];
  }

  if (move_uploaded_file($profilepicture['tmp_name'], $new_file_path)) {


    $upload_id = wp_insert_attachment(array(
      'guid'           => $new_file_path,
      'post_mime_type' => $new_file_mime,
      'post_title'     => preg_replace('/\.[^.]+$/', '', $profilepicture['name']),
      'post_content'   => '',
      'post_status'    => 'inherit'
    ), $new_file_path);

    // wp_generate_attachment_metadata() won't work if you do not include this file
    require_once(ABSPATH . 'wp-admin/includes/image.php');

    // Generate and save the attachment metas into the database
    wp_update_attachment_metadata($upload_id, wp_generate_attachment_metadata($upload_id, $new_file_path));


    //update_user_meta($userid,'ayecode-custom-avatar', wp_get_attachment_url($upload_id));
    update_post_meta($postId, '_thumbnail_id', $upload_id);
    set_post_thumbnail($postId, $upload_id);
    return $upload_id;
  }
}
//Image OR Video upload to media ends
//base 64 image upload to media
function save_base64_image($base64_img, $title)
{

  // Upload dir.
  $upload_dir  = wp_upload_dir();
  $upload_path = str_replace('/', DIRECTORY_SEPARATOR, $upload_dir['path']) . DIRECTORY_SEPARATOR;
  $image_array_1 = explode(';', $base64_img);
  $img             = str_replace($image_array_1[0] . ';base64,', '', $base64_img);


  $img             = str_replace(' ', '+', $img);
  $decoded         = base64_decode($img);

  $filename        = $title . '.png';
  $file_type       = 'image/png';
  $hashed_filename = md5($filename . microtime()) . '_' . $filename;

  // // Save the image in the uploads directory.
  $upload_file = file_put_contents($upload_path . $hashed_filename, $decoded);

  $attachment = array(
    'post_mime_type' => $file_type,
    'post_title'     => preg_replace('/\.[^.]+$/', '', basename($hashed_filename)),
    'post_content'   => '',
    'post_status'    => 'inherit',
    'guid'           => $upload_dir['url'] . '/' . basename($hashed_filename)
  );

  $attach_id = wp_insert_attachment($attachment, $upload_dir['path'] . '/' . $hashed_filename);
  return $attach_id;
  // return $attach_id;
}
//base 64 image upload to media Ends