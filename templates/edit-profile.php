<div id="profileEdit" style="display:none;">
        <div class="card p-3">
         <h4 class="card-header bg-white">Edit User Profile</h4>  
         <div class="card-body">
             <div class="form-group">
                 <label for="user_desc">About User</label>
                 <textarea name="" class="form-control rounded-0" id="user_desc" cols="10" rows="5"><?php echo get_user_meta($user->ID,'user_desc',true);?></textarea>
             </div>
             <div class="row">
                 <div class="col-md-6 col-sm-12 col-xs-12">
                 <div class="form-group">
                 <label for="fname">First Name</label>
                 <input type="text" name="" id="fname" class="form-control rounded-0" value="<?php echo get_user_meta($user->ID,'first_name',true); ?>" placeholder="Enter firstname">
                </div>
                 </div>
                 <div class="col-md-6 col-sm-12 col-xs-12">
                 <div class="form-group">
                 <label for="lname">Last Name</label>
                 <input type="text" name="" id="lname" class="form-control rounded-0" value="<?php echo get_user_meta($user->ID,'last_name',true); ?>" placeholder="Enter firstname">
                </div>
                 </div>
             </div>
             <div class="form-group">
                 <label for="twitter">Twitter</label>
                 <input type="url" name="" id="twitter" class="form-control rounded-0" value="<?php echo get_user_meta($user->ID,'_twitter',true); ?>" placeholder="Enter Twitter URL">
                </div>
                <div class="form-group">
                 <label for="fb">Facebook</label>
                 <input type="url" name="" id="fb" class="form-control rounded-0" value="<?php echo get_user_meta($user->ID,'_facebook',true); ?>" placeholder="Enter Twitter URL">
                </div>
                <div class="form-group">
                 <label for="instagram">Instagram</label>
                 <input type="url" name="" id="instagram" class="form-control rounded-0" value="<?php echo get_user_meta($user->ID,'_instagram',true); ?>" placeholder="Enter Twitter URL">
                </div>
                <div class="form-group">
                 <label for="linkedin">Linkedin</label>
                 <input type="url" name="" id="linkedin" class="form-control rounded-0" value="<?php echo get_user_meta($user->ID,'_linkedin',true); ?>" placeholder="Enter Twitter URL">
                </div>
                <div class="form-group">
                 <label for="tiktok">Tiktok</label>
                 <input type="url" name="" id="tiktok" class="form-control rounded-0" value="<?php echo get_user_meta($user->ID,'_tiktok',true); ?>" placeholder="Enter Twitter URL">
                </div>
                <div class="form-group">
                 <label for="snapchat">Snapchat</label>
                 <input type="url" name="" id="snapchat" class="form-control rounded-0" value="<?php echo get_user_meta($user->ID,'_snapchat',true); ?>" placeholder="Enter Twitter URL">
                </div>

         </div>
         <div class="card-footer bg-white">
             <button class="btn btn-success" id="updateUserDetails" data-id="<?php echo $user->ID; ?>">Update Details</div>
         </div>
        </div>