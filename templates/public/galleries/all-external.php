
        
        
        <div id="all_external" style="display:none;">
        <div class="card p-3">
           
           <div class="row">

           
           <?php if($gal_result): ?>
           <?php foreach($gal_result as $res): ?>
            <?php if($res->ext_url): ?>
                <div class="col-md-6 col-sm-12 col-12 my-3">
           <a href="javascript:void(0)" class="text-decoration-none">
           <div class="card gal_card">
           <a href="<?php echo $res->ext_url;?>" target="_blank"><img class="card-img-top" src="<?php echo wp_get_attachment_url($res->video_thumbnail); ?>" class="img-fluid" height="50px;" alt="Card image cap">
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
             <?php if($res->desc_status == 0): ?>
               <p class="card-text text-dark" style="font-size:1rem;"><?php echo $res->desc;?></h5>
               <?php endif; ?>
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
        

