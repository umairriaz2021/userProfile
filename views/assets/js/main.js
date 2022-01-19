/*Main Js File*/
jQuery(document).ready(function ($) {
    function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test( $email );
      }
      
    
    $('#login_user').on('click',function(e){
        e.preventDefault();
        var uname =  $('#u_name').val();
        var pass = $('#u_pass').val();
        var action = 'mylibrary';
        var param = 'user_login';
        if(uname.includes('@') && !validateEmail(uname)){
            $('#error_msg1').html('<span class="text-danger my-3">Email is not valid</span>');
                   

        }
        
        else if(uname == '')
        {
            $('#error_msg1').html('<span class="text-danger my-2">Username is required</span>');
            
            
        }
        
        else if(pass == '')
        {
            $('#error_msg2').html('<span class="text-danger my-2">Password is required</span>');
                        
        }
        else{
            $('#error_msg1 span').remove();
            $('#error_msg2 span').remove();
            $.ajax({
                url: myajaxurl,
                type: 'POST',
                data: { uname:uname,pass:pass,action:action,param:param },
                success: function (res) {
        
                       var data = $.parseJSON(res);
                   if(data.status == 400)
                   {    
                      
                       $('#error_msg3').addClass('text-danger my-3').html(data.message);
                    }
                   if(data.status == 200)
                   {
                    $('#error_msg3').html(`<span class="text-success my-2">${data.message}</span>`);
                       window.location.href = data.site_url;
                   }      
                }
            });
        }        

        
    
    });
 
   
    // jQuery('.container-fluid video').mouseover(function(){
    //     if(jQuery('section.editGallery').css('display')=='none'){
    //     jQuery(this).parent().next().hide('slow')
    //     jQuery(this).parent().next().attr('style','display:none !important')
    //     }
        
    //     })
    //     jQuery('.container-fluid video').mouseleave(function(){
    //     if(jQuery('section.editGallery').css('display')=='none'){
    //     jQuery(this).parent().next().show('slow')
    //     jQuery(this).parent().next().attr('style','display:flex !important')
    //     }
    
    //     });

   


    $('#form_submit').on('click', function (e) {
        e.preventDefault();
        var f_name = $('#f_name').val();
        var u_name = $('#u_name').val();
        var l_name = $('#l_name').val();

        var u_email = $('#u_email').val();
        var u_pass = $('#u_pass').val();
        var u_conf = $('#u_conf').val();
        var u_img_upload = $('#u_img').prop('files')[0];
        if (f_name == '') {
            alert('First name is empty');
            location.reload();
        }
        else if(u_name == '')
        {
            alert('Username is required');
            location.reload();
        }
        else if (l_name == '') {
            alert('Last name is empty')
            location.reload();
        }
        else if (u_pass == '') {
            alert('Password is empty');
            location.reload();
        }
        else if (u_conf == '') {
            alert('Confirm password is empty');
            location.reload();
        }


        var formData = new FormData();

        var action = 'mylibrary';
        var param = 'add_user';
        formData.append('fname', f_name);
        formData.append('lname', l_name);
        formData.append('uemail', u_email);
        formData.append('upass', u_pass);
        formData.append('uconf', u_conf);
        formData.append('u_name',u_name);
        formData.append('img_upload', u_img_upload);

        formData.append('action', action);
        formData.append('param', param);
        console.log(myajaxurl);
        $.ajax({
            url: myajaxurl,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: (res) => {
                //console.log(res);
                var data = $.parseJSON(res);
                console.log(res);
                if (data.status == 400) {
                    alert(`${data.msg}`);
                    location.reload();
                }
                else if (data.status == 200) {
                    // $('#error_msg').html(`<span class="vw-30 p-2 bg-success text-white mb-3">${res.msg}</span>`);
                    alert(`${data.msg}`);

                    window.location.href = data.site_url;

                }
            }
        });
    });

    $('#update_user').on('click',function(e){
        e.preventDefault();
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var u_email = $('#u_email').val();
        var id = $(this).attr('data-id');
        var action = 'mylibrary';
        var param = 'update_user_details';
        $.ajax({
            url:myajaxurl,
            type:'POST',
            data:{fname:fname,lname:lname,u_email:u_email,id:id,action:action,param:param},
            success:function(res)
            {
                var data = $.parseJSON(res);
                if(data.status==200)
                {
                    alert(`${data.message}`);
                    setTimeout(() => location.reload(),200);
                }
            }
        });
    });
    $('#edit_profile').on('click',function(){
		$('section.viewGallery').hide();
		$('section.editGallery').fadeIn();
        $('#update_user_form').hide();
        $('#profileEdit').hide();
        $('.openMyModal').show();
        $('.openMyModal1').show();
	});
    
    $('#view_profile').on('click',function(){
		$('section.editGallery').hide();
        $('.openMyModal').hide();
        $('.openMyModal1').hide();
        $('#privacy_settings').hide();
        $('#update_user_form').hide();
		$('section.viewGallery').fadeIn();
	}); 
    $('#change_password').on('click',function(){
        $('#changHeading h3').text('Change Your Password');
        $('#update_password ').fadeIn(200);
        $('#update_user_form').hide();
        $('#update_user_form').fadeOut();
        $('#privacy_settings').hide();
    });
    $('#my_account').on('click',function(){
        $('#changHeading h3').text('Update Your Information');
        $('#update_user_form').fadeIn(100);
        
        $('#update_password ').fadeOut();
    });
    $('#open_privacy').on('click',function(){
        $('#changHeading h3').text('Set Privacy');
        $('#update_user_form').hide();
        $('#update_password ').hide();
        $('#privacy_settings').fadeIn(200);
    });
    // $('#edit_profile').on('click',function(){
        
    //     $('#profile_overview ').hide();
    //     $('#all_images').hide();
    //     $('#all_galleries').hide();
    //     $('#profileEdit').fadeIn();
    // });

    // $('#view_profile').on('click',function(){
    //     $('#all_images').hide();
    //     $('#profileEdit').hide();
    //     $('#all_galleries').hide();
    //     $('#all_brands').hide();
    //     $('#all_brands_images').hide();
    //     $('#all_brand_external').hide();
    //     $('#all_brand_videos').hide();
    //     $('#profile_overview ').fadeIn();
    // });

    // //Galleries

    // $('#openGalleries').on('click',function(){
    //     $('#profile_overview ').hide();
    //     $('#profileEdit').hide();
    //     $('#all_images').hide();
    //     $('#all_galleries').fadeIn();
      
    // });
    // $('#galImages').on('click',function(){
    //     $('#all_galleries').hide();
    //     $('#all_videos').hide();
    //     $('#all_images').fadeIn();
    //     $('#all_external').hide();
    // });
    // $('#galIntVid').on('click',function(){
    //     $('#all_galleries').hide();
    //     $('#all_images').hide();
    //     $('#all_external').hide();
    //     $('#all_videos').fadeIn();
  
    // });

    // $('#galExtVid').on('click',function(){
    //     $('#all_galleries').hide();
    //     $('#all_images').hide();
    //     $('#all_videos').hide();
    //     $('#all_external').fadeIn();
  
    // });
    
    // //Galleries Ends
    // //Brands
    // $('#openBrandsSec').on('click',function(){
    //     $('#profile_overview ').hide();
    //     $('#profileEdit').hide();
    //     $('#all_brands_images').hide();
    //     $('#all_brands').fadeIn();
    // });
    
    // $('#braImages').on('click',function(){
    //     $('#all_brands').hide();
    //     $('#all_brand_external').hide();
    //     $('#all_brands_images').fadeIn();
    // });
    // $('#braIntVid').on('click',function(){
    //     $('#all_brands').hide();
    //     $('#all_brands_images').hide();
    //     $('#all_brand_external').hide();;
    //     $('#all_brand_videos').fadeIn();
  
    // });
    // $('#braExtVid').on('click',function(){
    //     $('#all_brands').hide();
    //     $('#all_brands_images').hide();
    //     $('#all_brand_videos').hide();
    //     $('#all_brand_external').fadeIn();
  
    // });
   
    //Brands Ends
    $('#update_role').on('click',function(e){
        e.preventDefault();
        var role = $('#select_role').val();
        var param = 'updateRole';
        var action = 'mylibrary';
        $.ajax({
            url:myajaxurl,
            type:'POST',
            data:{role:role,param:param,action:action},
            success:function(res)
            {
                var data = $.parseJSON(res)
                if(data.status==200)
                {
                    alert(data.message);
                    setTimeout(() => {
                        location.reload();
                    },2000);
                }
               
            }
        });
    });
    $(document).on('click','#change_pass1',function(e){
        e.preventDefault();
        var c_pass = $('#c_pass').val();
        var new_pass = $('#new_pass').val();
        var con_pass = $('#con_pass').val();
        var id = $(this).attr('data-id');
        var action = 'mylibrary';
        var param = 'change_pass';
        if(c_pass == '')
        {   $('#error_msg3 span').remove();
            $('#error_msg1').html('<span class="text-danger my-3">Current password is required</span>');
        }
        else if(new_pass == ''){
            $('#error_msg1 span').remove();
            $('#error_msg2').html('<span class="text-danger my-3">New password is required</span>');
        }
        else if(con_pass == '')
        {   
            $('#error_msg2 span').remove(); 
            $('#error_msg3').html('<span class="text-danger my-3">Confirm password is required</span>');
        }
        else{
              
            $('#error_msg3 span').remove();  

            $.ajax({
                url:myajaxurl,
                type:'POST',
                data:{c_pass:c_pass,new_pass:new_pass,con_pass:con_pass,id:id,action:action,param:param},
                success:function(res)
                {
                    var data = $.parseJSON(res);
                    if(data.status==200)
                    {
                        $('#error_msg3').html(`<span class="text-success my-3">${data.message}</span>`);
                        window.location.href = data.site_url;
                    }
                    else if(data.status==400)
                    {
                        $('#error_msg3').html(`<span class="text-danger my-3">${data.message}</span>`);

                    }
                }
            });

        }    
    });

    $('#delete_user').on('click',function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        var action = 'mylibrary';
        var param = 'delete_account'
        conf = confirm('Are you sure, you want to delete your account');
        if(conf)
        {
            $.ajax({
                url:myajaxurl,
                type:'POST',
                data:{id:id,param:param,action:action},
                success:function(res)
                {
                    var data = $.parseJSON(res);
                    if(data.status==200){
                    setTimeout(function(){
                        window.location.href = data.site_url;
                    },2000);
                    }
                }
            });

        }
    });

    $('#updateUserDetails').on('click',function(e){
        e.preventDefault();
       var id = $(this).attr('data-id');
       var user_desc = $('#user_desc').val();
       var fname = $('#fname').val();
       var lname = $('#lname').val();
       var fb = $('#fb').val();
       var instagram = $('#instagram').val();
       var linkedin = $('#linkedin').val();
       var tiktok = $('#tiktok').val();
       var snapchat = $('#snapchat').val();
       var twitter = $('#twitter').val();
       var action =  'mylibrary';
       var param = "update_edit_details";

       $.ajax({
           url:myajaxurl,
           type:'POST',
           data:{id:id,user_desc:user_desc,twitter:twitter,fname:fname,lname:lname,fb:fb,instagram:instagram,linkedin:linkedin,tiktok:tiktok,snapchat:snapchat,param:param,action:action},
           success:function(res){
                var data = $.parseJSON(res);
                if(data.status==200)
                {
                    alert(data.message);
                    setTimeout(function(){
                        location.reload();
                    },2000);
                }
           }
        });

    });

});


