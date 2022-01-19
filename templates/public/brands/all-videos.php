
        
        
        <div id="all_brand_videos" style="display:none;">
        <div class="card p-3">
           
           <div class="row">

           
           <?php if($bra_result): ?>
           <?php foreach($bra_result as $res): ?>
            <?php if($res->video_upload): ?>
                <div class="col-md-6 col-sm-12 col-12 my-3">
           <a href="javascript:void(0)" class="text-decoration-none">
           <div class="card gal_card">
           <video src="<?php echo wp_get_attachment_url($res->video_upload); ?>" controls></video>
           <?php if($user->ID == $current_user->ID): ?>
           <div class="actionBtns">
               <a href="javascript:void(0)" id="editGal"><i class="fas fa-pencil-alt"></i></a>
               <a href="javascript:void(0)" id="delGal"><i class="fas fa-trash-alt"></i></a>
           </div>
           <?php endif; ?>
           <div class="card-body">
               <div class="d-flex flex-row flex-wrap justify-content-between">
               <h5 class="card-title"><?php echo $res->title; ?></h5>
                <?php if($res->desc_status == 1): ?>
               <span><i class="fas fa-lock"></i></span>
               <?php endif; ?>
             </div>
               <p class="card-text text-dark" style="font-size:1rem;"><?php echo $res->desc;?></h5>
               
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
        

