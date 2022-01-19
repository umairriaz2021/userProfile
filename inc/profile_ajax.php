<?php

if ($_REQUEST['param'] === 'update_social_links') {
    $id = $_REQUEST['id'];
    $fname = $_REQUEST['fname'];
    $lname = $_REQUEST['lname'];
    $fb = $_REQUEST['fb'];
    $instagram = $_REQUEST['instagram'];
    $linkedin = $_REQUEST['linkedin'];
    $tiktok = $_REQUEST['tiktok'];
    $snapchat = $_REQUEST['snapchat'];
    $twitter = $_REQUEST['twitter'];
    $des = $_REQUEST['user_desc'];
    update_user_meta($id, 'user_desc', $des);
    update_user_meta($id, 'first_name', $fname);
    update_user_meta($id, 'last_name', $lname);
    update_user_meta($id, '_twitter', $twitter);
    update_user_meta($id, '_facebook', $fb);
    update_user_meta($id, '_instagram', $instagram);
    update_user_meta($id, '_linkedin', $linkedin);
    update_user_meta($id, '_tiktok', $tiktok);
    update_user_meta($id, '_snapchat', $snapchat);

    echo json_encode(['status' => 200, 'message' => 'Details updated successfully']);
}

if ($_REQUEST['param'] === 'changeProfileImage') {
    $userid = wp_get_current_user()->ID;

    $basImage = $_REQUEST['image'];
    $random_int = random_int(1, 1000);
    $attach_id = save_base64_image($basImage, $random_int);

    $url = wp_get_attachment_url($attach_id);
    //wp_user_avatars_update_avatar( $userid, $url );
    //update_user_meta($userid,'ayecode-custom-avatar',wp_get_attachment_url($attach_id));
    update_user_meta($userid, 'avatar_attachment_id', $attach_id);


    echo json_encode(['status' => 200, 'url' => $url]);
}

if ($_REQUEST['param'] === 'changeCoverImage') {
    $userid = wp_get_current_user()->ID;
    $basImage = $_REQUEST['image'];
    $random_int = random_int(1, 1000);
    $attach_id = save_base64_image($basImage, $random_int);
    $url = wp_get_attachment_url($attach_id);
    update_user_meta($userid, '_user_profile_cover', $attach_id);
    echo json_encode(['status' => 200, 'url' => $url]);
}

if ($_REQUEST['param'] === 'galleryUploadImage' && $_REQUEST['param'] !== 'brandUploadImage') {
    $user = wp_get_current_user();
    $image = $_REQUEST['image'];
    if(!empty($_REQUEST['id']))
    {
        $random_int = random_int(1, 1000);
        $attach_id = save_base64_image($image, $random_int);
        $wpdb->update("gallery", ['id'=>$_REQUEST['id'],'img_upload' => $attach_id],['id'=>$_REQUEST['id']]);
        $done = json_encode(['status' => 200, 'type' => 'gal', 'lastid' => $lastid]);
    }
    else{
        $random_int = random_int(1, 1000);
        $attach_id = save_base64_image($image, $random_int);
        $wpdb->insert("gallery", ['img_upload' => $attach_id, 'user_id' => $user->ID]);
        $lastid = $wpdb->insert_id;
        $done = json_encode(['status' => 200, 'type' => 'gal', 'lastid' => $lastid]);
    }
    
        echo $done;
   
}

if ($_REQUEST['param'] === 'brandUploadImage' && $_REQUEST['param'] !== 'galleryUploadImage') {

    $user = wp_get_current_user();
    $image = $_REQUEST['image'];
    if(!empty($_REQUEST['id']))
    {
        $random_int = random_int(1, 1000);
        $attach_id = save_base64_image($image, $random_int);
        $wpdb->update("brands", ['id'=>$_REQUEST['id'],'img_upload' => $attach_id],['id'=>$_REQUEST['id']]);
        $lastid = $wpdb->insert_id;
        $done = json_encode(['status' => 201, 'type' => 'bra', 'lastid' => $lastid]);
    }
    else{
    $random_int = random_int(1, 1000);
    $attach_id = save_base64_image($image, $random_int);
    $wpdb->insert("brands", ['img_upload' => $attach_id, 'user_id' => $user->ID]);
    $lastid = $wpdb->insert_id;
    $done = json_encode(['status' => 201, 'type' => 'bra', 'lastid' => $lastid]);
    }

    
    echo $done;
}

if ($_REQUEST['param'] === 'addGallery') {

    $user = wp_get_current_user()->ID;
    $title = $_REQUEST['g_title'];
    $g_desc = $_REQUEST['g_desc'];
    $g_url = $_REQUEST['g_url'];
    $ext_link = $_REQUEST['ext_link'];
    $check_ex = $_REQUEST['check_ex'];
    $lastid = $_REQUEST['lastid'];
    $thumbnail = $_FILES['thumbnail'];
    $video = $_FILES['video'];
    if (!empty($lastid)) {
        $args = [];
        $args['id'] = $lastid;
        $args['title'] = $title;
        $args['desc'] = $g_desc;
        $args['url'] = $g_url;
        $args['ext_url'] = $ext_link;
        $args['desc_status'] = ($check_ex == 1) ?  $check_ex : '';
        $done = $wpdb->update('gallery', $args, ['id' => $lastid]);
    }

    if (empty($lastid)) {
        if (!empty($ext_link)) {
            $res = parse_url($ext_link);
            $host = $res['host'];
            if (preg_match("/$host/", 'www.youtube.com')) {
                $explode = explode('=', $ext_link);
                $link = "https://www.youtube.com/embed/$explode[1]";
            }
        } else {
            $link = '';
        }
        $args = [];
        $args['title'] = $title;
        $args['desc'] = $g_desc;
        $args['url'] = $g_url;
        $args['ext_url'] = $link;
        $args['user_id'] = $user;
        $args['desc_status'] = ($check_ex == 1) ?  $check_ex : '';
        if (empty($video) && !empty($thumbnail)) {

            $attach_id = insertGeneralImages($thumbnail);
            $args['video_thumbnail'] = $attach_id;
            $done = $wpdb->insert('gallery', $args);
        } else if (!empty($video) && empty($thumbnail)) {
            $attach_id = insertGeneralImages($video);
            $args['video_upload'] = $attach_id;
            $done = $wpdb->insert('gallery', $args);
        }
    }
    if ($done) {
        echo json_encode(['status' => 200, 'message' => 'Gallery added successfully']);
    } else {
        echo json_encode(['status' => 200, 'message' => 'Gallery added successfully']);
    }
}

if ($_REQUEST['param'] === 'addBrands') {

    $title = $_REQUEST['b_title'];
    $b_url = $_REQUEST['b_url'];
    $user = $_REQUEST['uid'];
    $ext_link = $_REQUEST['ext_link'];
    $check_ex = $_REQUEST['check_ex'];
    $lastid = $_REQUEST['lastid'];
    $thumbnail = $_FILES['thumbnail'];
    $video = $_FILES['video'];

    if (!empty($lastid)) {
        $args = [];
        $args['title'] = $title;
        $args['url'] = $b_url;
        $args['ext_url'] = $ext_link;
        $args['user_id'] = $user;
        $args['desc_status'] = ($check_ex == 1) ?  $check_ex : '';
        $done = $wpdb->update('brands', $args, ['id' => $lastid]);
    }

    if (empty($lastid)) {
        if (!empty($ext_link)) {
            $res = parse_url($ext_link);
            $host = $res['host'];
            if (preg_match("/$host/", 'www.youtube.com')) {
                $criptNumber = end(explode('=', $ext_link));
                $link = "https://www.youtube.com/embed/$criptNumber";
            }
        } else {
            $link = '';
        }

        $args = [];
        $args['title'] = $title;
        $args['url'] = $b_url;
        $args['ext_url'] = $link;
        $args['user_id'] = $user;
        $args['desc_status'] = ($check_ex == 1) ?  $check_ex : '';
        if (empty($video) && !empty($thumbnail)) {

            $attach_id = insertGeneralImages($thumbnail);
            $args['video_thumbnail'] = $attach_id;
            $done = $wpdb->insert('brands', $args);
        } else if (!empty($video) && empty($thumbnail)) {
            $attach_id = insertGeneralImages($video);
            $args['video_upload'] = $attach_id;
            $done = $wpdb->insert('brands', $args);
        }
    }
    if ($done) {
        echo json_encode(['status' => 200, 'message' => 'Brands added successfully']);
    } else {
        echo json_encode(['status' => 200, 'message' => 'Brands added successfully']);
    }
}


if ($_REQUEST['param'] === 'get_gal_images') {
    $id = $_REQUEST['id'];
    $result = $wpdb->get_row("SELECT * from gallery where id = $id");
    if ($result->desc_status == 1) {
        $ext_url = 'checked';
    } else {
        $ext_url = '';
    }
    if ($result->video_thumbnail !== '') {

        $checked = 'checked';
        $type = "thumb";
        $tag = '<img src="' . wp_get_attachment_url($result->video_thumbnail) . '" class="img-fluid img-thumbnail my-3" width="150px" height="150px">';
    } else {
        $checked = '';
    }




    if ($result->img_upload !== "" || $result->video_upload !== "" && $result->video_thumbnail == "") {

        $checked1 = 'checked';
        $type = 'img';
        if ($result->img_upload) {

            $tag1 = '<img src="' . wp_get_attachment_url($result->img_upload) . '" class="img-fluid img-thumbnail" id="latest_gal_img" width="150px" height="150px">';
        } else {

            $tag1 = '<video src="' . wp_get_attachment_url($result->video_upload) . '" style="width:150px; height:150px;" controls></video>';
        }
    }




    $modal = '<div class="modal openCropper1" id="openCropper1"  tabindex="-1" role="dialog" aria-labelledby="openCropper1Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="openCropper1Label">Upload & Crop Image</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="img_demo1" style="width:350px; margin-top:30px;">
          </div>
          <div class="modal-footer">
            <button class="btn btn-success crop_img1" data-post="' . $id . '">Crop & Upload Image</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>';


    $output = '<form id="updateGallery" method="POST" data-form-id="' . $result->id . '" enctype="multipart/form-data">
    <input type="hidden" name="insertId3" id="insertId3">
 
    <div class="modal-body">
      
        <div class="form-group">
            <label for="update_g_title">Gallery Title</label>
            <input type="text" name="update_g_title" required id="update_g_title" value="' . $result->title . '" class="form-control rounded-0" placeholder="Gallery Title">
        </div>
        <div class="form-group">
            <label for="update_g_desc">Description</label>
              <textarea name="update_g_desc" required id="update_g_desc"  class="form-control rounded-0" cols="10" rows="1">' . $result->desc . '</textarea>
          </div>   
        <div class="form-group">
            <label for="update_g_url">URL</label>
            <input type="url" name="update_g_url" required id="update_g_url" value="' . $result->url . '" class="form-control rounded-0" placeholder="https://www.abc.com">
        </div> 
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" id="check_ext_link201" ' . $checked . ' name="check_ext_link201" value="0">
          <label class="form-check-label" for="check_ext_link201"> External Link </label>
          </div>
         
          <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" id="check_img201" ' . $checked1 . ' name="check_img201" value="0">
          <label class="form-check-label" for="check_img201">Upload Video Or Image</label>
          </div>
          
          <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="check_ex201" name="check_ex201" ' . $ext_url . ' value="0">
          <label class="form-check-label" for="check_img201">Exclusive Content</label>
          </div>
          <div class="form-group my-3" id="g_ext_id201">
          <label for="g_link">External Link</label>
            <input type="url" name="ext_link201" id="ext_link201" class="form-control rounded-0" value="' . $result->ext_url . '" placeholder="https://www.abc.com">
            </div>
            <div class="form-group my-3" id="g_img_id1201">
            <label for="update_ext_thumbnail">Thumbnail Image</label>
            <input type="file" name="update_ext_thumbnail" class="form-control rounded-0" id="update_ext_thumbnail">
            ' . $tag . '    
            </div>
          <div class="form-group my-3" id="g_img_id201">
          <input type="file" name="update_img_upload" class="form-control rounded-0" id="update_img_upload">
          <div class="uploaded_img py-3">
          ' . $tag1 . '
          </div>
          </div>
          <div class="pre_loader" style="display:none;">
          <img src="'.PLUGIN_URL.'/views/assets/img/preloader.gif" width="50px" height="50px" class="img-fluid">
          </div>   
      
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>';
    echo json_encode(['status' => 200, 'data' => $output, 'modal' => $modal, 'type' => $type]);

    //echo $json;
}

if ($_REQUEST['param'] === 'editGalleryImage') {

    $user = wp_get_current_user();
    $image = $_REQUEST['image'];
    $postid = $_REQUEST['postid'];
    $random_int = random_int(1, 1000);
    $attach_id = save_base64_image($image, $random_int);
    $wpdb->update("gallery", ['id' => $postid, 'img_upload' => $attach_id], ['id' => $postid]);
    $lastid = $wpdb->insert_id;
    if ($lastid > 0) {
        echo json_encode(['status' => 200, 'img_url' => wp_get_attachment_url($attach_id), 'lastid' => $lastid]);
    }
}

if ($_REQUEST['param'] === 'updateGallery') {

    $user = wp_get_current_user()->ID;
    $title = $_REQUEST['g_title'];
    $g_desc = $_REQUEST['g_desc'];
    $g_url = $_REQUEST['g_url'];
    $check_ex = $_REQUEST['check_ex'];
    $lastid = $_REQUEST['lastid'];
    $imageId = $_REQUEST['imgId'];
    $ext_link = $_REQUEST['ext_link'];
    $thumbnail = $_FILES['thumbnail'];
    $video = $_FILES['video'];
  


    if(isset($thumbnail))
    {
       
        $attach_id = insertGeneralImages($thumbnail);
                //$args['video_thumbnail'] = $attach_id;
                //$done = $wpdb->update('gallery', $args, ['id' => $lastid]);

        if (explode('/', parse_url($ext_link)['path'])[1] === 'embed' && !empty($video)) {
            $link =  $ext_link;
        } elseif (explode('/', parse_url($ext_link)['path'])[1] !== 'embed') {
            $res = parse_url($ext_link);
            $host = $res['host'];
            if (preg_match("/$host/", 'www.youtube.com')) {
                $explode = explode('=', $ext_link);
                $link = "https://www.youtube.com/embed/$explode[1]";
            }
        } else {
            $link = '';
        }
        $args = [];
            $args['id'] = $lastid;
            $args['title'] = $title;
            $args['desc'] = $g_desc;
            $args['url'] = $g_url;
            $args['ext_url'] = $link;
            $args['video_thumbnail'] = $attach_id;
            $args['video_upload'] = '';
            $args['img_upload'] = '';
            $args['desc_status'] = ($check_ex == 1) ?  $check_ex : '';
            $done = $wpdb->update('gallery', $args, ['id' => $lastid]);
    }
  
    elseif (!empty($imageId)) {
            $args = [];
            $args['id'] = $lastid;
            $args['title'] = $title;
            $args['desc'] = $g_desc;
            $args['url'] = $g_url;
            $args['ext_url'] = '';
            $args['video_thumbnail'] = '';
            $args['video_upload'] = '';
            $args['desc_status'] = ($check_ex == 1) ?  $check_ex : '';
            $done = $wpdb->update('gallery', $args, ['id' => $lastid]);
        } 
    elseif(!empty($video))
    {
        $attach_id = insertGeneralImages($video);
        $args = [];
        $args['id'] = $lastid;
        $args['title'] = $title;
        $args['desc'] = $g_desc;
        $args['url'] = $g_url;
        $args['ext_url'] = '';
        $args['video_thumbnail'] = '';
        $args['img_upload'] = '';
        $args['video_upload'] = $attach_id;
        $args['desc_status'] = ($check_ex == 1) ?  $check_ex : '';
             
        $done = $wpdb->update('gallery', $args, ['id' => $lastid]);

    }
    elseif(empty($thumbnail) && empty($video))
    {
        $data = $wpdb->get_row("SELECT * from gallery where id = $lastid");
     
            if ($data->video_upload !== '' || $data->img_upload !== '') {
                $args = [];
                $args['id'] = $lastid;
                $args['title'] = $title;
                $args['desc'] = $g_desc;
                $args['url'] = $g_url;
                $args['ext_url'] = $ext_link;
                $args['video_thumbnail'] = '';
                if ($data->video_upload !== '') {
                    $args['video_upload'] = $data->video_upload;
                } elseif ($data->img_upload !== '') {
                    $args['img_upload'] = $data->img_upload;
                }
                $args['desc_status'] = ($check_ex == 1) ?  $check_ex : '';
                $done = $wpdb->update('gallery', $args, ['id' => $lastid]);
            } elseif ($data->video_thumbnail !== '') {
                $args = [];
                $args['id'] = $lastid;
                $args['title'] = $title;
                $args['desc'] = $g_desc;
                $args['url'] = $g_url;
                $args['ext_url'] = $ext_link;
                $args['video_thumbnail'] = $data->video_thumbnail;
                $args['video_upload'] = '';
                $args['img_upload'] = '';
                $args['desc_status'] = ($check_ex == 1) ?  $check_ex : '';
                $done = $wpdb->update('gallery', $args, ['id' => $lastid]);
            }
    }    
        

   



    if ($done) {
        echo json_encode(['status' => 200, 'message' => 'Gallery updated successfully']);
    } else {
        echo json_encode(['status' => 200, 'message' => 'Gallery updated successfully']);
    }
}

if ($_REQUEST['param'] === 'get_all_brands') {

    $id = $_REQUEST['id'];
    $result = $wpdb->get_row("SELECT * from brands where id = $id");

    if ($result->desc_status == 1) {
        $ext_url = 'checked';
    } else {
        $ext_url = '';
    }
    if ($result->video_thumbnail !== '') {

        $checked = 'checked';
        $type = "thumb";
        $tag = '<img src="' . wp_get_attachment_url($result->video_thumbnail) . '" class="img-fluid img-thumbnail my-3" width="150px" height="150px">';
    } else {
        $checked = '';
    }




    if ($result->img_upload !== "" || $result->video_upload !== "" && $result->video_thumbnail == "") {

        $checked1 = 'checked';
        $type = 'img';
        if ($result->img_upload) {

            $tag1 = '<img src="' . wp_get_attachment_url($result->img_upload) . '" class="img-fluid img-thumbnail" id="latest_gal_img" width="150px" height="150px">';
        } else {

            $tag1 = '<video src="' . wp_get_attachment_url($result->video_upload) . '" style="width:150px; height:150px;" controls></video>';
        }
    }




    $modal = '<div class="modal openCropper1" id="openCropper1"  tabindex="-1" role="dialog" aria-labelledby="openCropper1Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="openCropper1Label">Upload & Crop Image</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="img_demo1" style="width:350px; margin-top:30px;">
          </div>
          <div class="modal-footer">
            <button class="btn btn-success crop_img1" data-post="' . $id . '">Crop & Upload Image</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>';


    $output = '<form id="updateBrands" method="POST" data-form-id="' . $result->id . '" enctype="multipart/form-data">
    <input type="hidden" name="insertId3" id="insertId3">
 
    <div class="modal-body">
      
        <div class="form-group">
            <label for="update_b_title">Brand Title</label>
            <input type="text" name="update_b_title" required id="update_b_title" value="' . $result->title . '" class="form-control rounded-0" placeholder="Brand Title">
        </div>
        <div class="form-group">
            <label for="update_b_url">URL</label>
            <input type="url" name="update_b_url" required id="update_b_url" value="' . $result->url . '" class="form-control rounded-0" placeholder="https://www.abc.com">
        </div> 
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" id="check_ext_linkbr" ' . $checked . ' name="check_ext_linkbr" value="0">
          <label class="form-check-label" for="check_ext_linkbr"> External Link </label>
          </div>
         
          <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" id="check_imgbr" ' . $checked1 . ' name="check_imgbr" value="0">
          <label class="form-check-label" for="check_imgbr">Upload Video Or Image</label>
          </div>
          
          <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="check_exbr" name="check_ex201" ' . $ext_url . ' value="0">
          <label class="form-check-label" for="check_exbr">Exclusive Content</label>
          </div>
          <div class="form-group my-3" id="g_ext_idbr">
          <label for="ext_linkbr">External Link</label>
            <input type="url" name="ext_linkbr" id="ext_linkbr" class="form-control rounded-0" value="' . $result->ext_url . '" placeholder="https://www.abc.com">
            </div>
            <div class="form-group my-3" id="g_img_id1br">
            <label for="update_ext_thumbnail">Thumbnail Image</label>
            <input type="file" name="update_ext_thumbnail" class="form-control rounded-0" id="update_ext_thumbnail">
            ' . $tag . '    
            </div>
          <div class="form-group my-3" id="g_img_idbr1">
          <input type="file" name="update_img_upload" class="form-control rounded-0" id="update_img_upload">
          <div class="uploaded_img py-3">
          ' . $tag1 . '
          </div>
          </div>
          <div class="pre_loader" style="display:none;">
          <img src="'.PLUGIN_URL.'/views/assets/img/preloader.gif" width="50px" height="50px" class="img-fluid">
          </div> 
      
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>';
    echo json_encode(['status' => 200, 'data' => $output, 'modal' => $modal, 'type' => $type]);

    //echo $json;
}

if ($_REQUEST['param'] === 'editBrandImage') {

    $user = wp_get_current_user();
    $image = $_REQUEST['image'];
    $postid = $_REQUEST['postid'];
    $random_int = random_int(1, 1000);
    $attach_id = save_base64_image($image, $random_int);
    $wpdb->update("brands", ['id' => $postid, 'img_upload' => $attach_id], ['id' => $postid]);
    $lastid = $wpdb->insert_id;
    if ($lastid > 0) {
        echo json_encode(['status' => 200, 'img_url' => wp_get_attachment_url($attach_id), 'lastid' => $lastid]);
    }
}
// if ($_REQUEST['param'] === 'updateBrands') {

//     $user = wp_get_current_user()->ID;
//     $title = $_REQUEST['g_title'];

//     $g_url = $_REQUEST['g_url'];
//     $check_ex = $_REQUEST['check_ex'];
//     $lastid = $_REQUEST['lastid'];
//     $imageId = $_REQUEST['imgId'];
//     $ext_link = $_REQUEST['ext_link'];
//     $thumbnail = $_FILES['thumbnail'];
//     $video = $_FILES['video'];
//     if (!empty($imageId)) {
//         $args = [];
//         $args['id'] = $lastid;
//         $args['title'] = $title;
//         $args['url'] = $g_url;
//         $args['ext_url'] = '';
//         $args['video_thumbnail'] = '';
//         $args['video_upload'] = '';
//         $args['desc_status'] = ($check_ex == 1) ?  $check_ex : '';
//         $done = $wpdb->update('brands', $args, ['id' => $lastid]);
//     } else {

//         if (explode('/', parse_url($ext_link)['path'])[1] === 'embed' && !empty($video)) {
//             $link =  $ext_link;
//         } elseif (explode('/', parse_url($ext_link)['path'])[1] !== 'embed') {
//             $res = parse_url($ext_link);
//             $host = $res['host'];
//             if (preg_match("/$host/", 'www.youtube.com')) {
//                 $explode = explode('=', $ext_link);
//                 $link = "https://www.youtube.com/embed/$explode[1]";
//             }
//         } else {
//             $link = '';
//         }
//         $args = [];
//         $args['title'] = $title;
//         $args['url'] = $g_url;
//         $args['img_upload'] = '';
//         $args['video_upload'] = '';
//         $args['ext_url'] = $link;
//         $args['desc_status'] = ($check_ex == 1) ?  $check_ex : '';
//         if (!empty($thumbnail)) {

//             $attach_id = insertGeneralImages($thumbnail);
//             $args['video_thumbnail'] = $attach_id;
//             $done = $wpdb->update('brands', $args, ['id' => $lastid]);
//         } elseif (empty($thumbnail)) {
//             $attach_id = insertGeneralImages($video);
//             $args['video_upload'] = $attach_id;
//             $args['ext_url'] = '';
//             $done = $wpdb->update('brands', $args, ['id' => $lastid]);
//         }
//     }

//     if ($done) {
//         echo json_encode(['status' => 200, 'message' => 'Brands updated successfully']);
//     } else {
//         echo json_encode(['status' => 400, 'message' => 'Error ! inserting Brands']);
//     }
// }


if ($_REQUEST['param'] === 'updateBrands') {
    
    $user = wp_get_current_user()->ID;
    $title = $_REQUEST['g_title'];

    $g_url = $_REQUEST['g_url'];
    $check_ex = $_REQUEST['check_ex'];
    $lastid = $_REQUEST['lastid'];
    $imageId = $_REQUEST['imgId'];
    $ext_link = $_REQUEST['ext_link'];
    $thumbnail = $_FILES['thumbnail'];
    $video = $_FILES['video'];
  


    if(isset($thumbnail))
    {
       
        $attach_id = insertGeneralImages($thumbnail);
                //$args['video_thumbnail'] = $attach_id;
                //$done = $wpdb->update('gallery', $args, ['id' => $lastid]);

        if (explode('/', parse_url($ext_link)['path'])[1] === 'embed' && !empty($video)) {
            $link =  $ext_link;
        } elseif (explode('/', parse_url($ext_link)['path'])[1] !== 'embed') {
            $res = parse_url($ext_link);
            $host = $res['host'];
            if (preg_match("/$host/", 'www.youtube.com')) {
                $explode = explode('=', $ext_link);
                $link = "https://www.youtube.com/embed/$explode[1]";
            }
        } else {
            $link = '';
        }
        $args = [];
            $args['id'] = $lastid;
            $args['title'] = $title;
            $args['url'] = $g_url;
            $args['ext_url'] = $link;
            $args['video_thumbnail'] = $attach_id;
            $args['video_upload'] = '';
            $args['img_upload'] = '';
            $args['desc_status'] = ($check_ex == 1) ?  $check_ex : '';
            $done = $wpdb->update('brands', $args, ['id' => $lastid]);
    }
  
    elseif (isset($imageId) && $imageId > 0) {
          
        $args = [];

            $args['id'] = $lastid;
            $args['title'] = $title;
            $args['url'] = $g_url;
            $args['ext_url'] = '';
            $args['video_thumbnail'] = '';
            $args['video_upload'] = '';
            $args['desc_status'] = ($check_ex == 1) ?  $check_ex : '';
            $done = $wpdb->update('brands', $args, ['id' => $lastid]);
        } 
    elseif(isset($video))
    {
        $attach_id = insertGeneralImages($video);
        $args = [];
        $args['id'] = $lastid;
        $args['title'] = $title;
        $args['url'] = $g_url;
        $args['ext_url'] = '';
        $args['video_thumbnail'] = '';
        $args['img_upload'] = '';
        $args['video_upload'] = $attach_id;
        $args['desc_status'] = ($check_ex == 1) ?  $check_ex : '';
             
        $done = $wpdb->update('brands', $args, ['id' => $lastid]);

    }
    elseif(empty($thumbnail) && empty($video))
    {
        $data = $wpdb->get_row("SELECT * from brands where id = $lastid");
     
            if ($data->video_upload !== '' || $data->img_upload !== '') {
                $args = [];
                $args['id'] = $lastid;
                $args['title'] = $title;
                $args['url'] = $g_url;
                $args['ext_url'] = $ext_link;
                $args['video_thumbnail'] = '';
                if ($data->video_upload !== '') {
                    $args['video_upload'] = $data->video_upload;
                } elseif ($data->img_upload !== '') {
                    $args['img_upload'] = $data->img_upload;
                }
                $args['desc_status'] = ($check_ex == 1) ?  $check_ex : '';
                $done = $wpdb->update('brands', $args, ['id' => $lastid]);
            } elseif ($data->video_thumbnail !== '') {
                $args = [];
                $args['id'] = $lastid;
                $args['title'] = $title;
                $args['url'] = $g_url;
                $args['ext_url'] = $ext_link;
                $args['video_thumbnail'] = $data->video_thumbnail;
                $args['video_upload'] = '';
                $args['img_upload'] = '';
                $args['desc_status'] = ($check_ex == 1) ?  $check_ex : '';
                $done = $wpdb->update('brands', $args, ['id' => $lastid]);
            }
    }    
        

   



    if ($done) {
        echo json_encode(['status' => 200, 'message' => 'Brands updated successfully']);
    } else {
        echo json_encode(['status' => 400, 'message' => 'Brands updated successfully']);
    }
}



if ($_REQUEST['param'] === 'deleteGal') {
    //echo "<pre>"; print_r($_REQUEST);die;
    $id = $_REQUEST['id'];

    $result = $wpdb->get_row("SELECT * from gallery where id = $id");

    if (!empty($result->img_upload)) {
        wp_delete_attachment($result->img_upload, true);
    } elseif (!empty($result->video_upload)) {
        wp_delete_attachment($result->video_upload, true);
    }
    $wpdb->delete('gallery', array('id' => $id));
    echo json_encode(['status' => 200]);
}
if ($_REQUEST['param'] === 'deleteBrand') {
    //echo "<pre>"; print_r($_REQUEST);die;
    $id = $_REQUEST['id'];

    $result = $wpdb->get_row("SELECT * from brands where id = $id");

    if (!empty($result->img_upload)) {
        wp_delete_attachment($result->img_upload, true);
    } elseif (!empty($result->video_upload)) {
        wp_delete_attachment($result->video_upload, true);
    }
    $wpdb->delete('brands', array('id' => $id));
    echo json_encode(['status' => 200]);
}
