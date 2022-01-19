jQuery(document).ready(function($){
	
	
	
	$('#p_desc').keyup(function(){
		var length = $(this).val().length;
		if(length <=180)
		{
			
			$('#desc_count').fadeIn().text(length);
		}
		else if(length == 180){
			//$('#desc_count').fade.text(length - 1);
			return false;
		}
	});
	$('#social_links_update').on('submit',function(e){
		e.preventDefault();
	
	   var id = $(this).attr('data-id');
	   var user_desc = $('#p_desc').val();
	   var fname = $('#fname').val();
	   var lname = $('#lname').val();
	   var fb = $('#facebook').val();
	   var instagram = $('#instagram').val();
	   var linkedin = $('#linkedin').val();
	   var tiktok = $('#tiktok').val();
	   var snapchat = $('#snapchat').val();
	   var twitter = $('#twitter').val();
	   var action =  'myProfilelibrary';
	   var param = "update_social_links";
	
	   $.ajax({
	       url:myajaxurl,
	       type:'POST',
	       data:{id:id,user_desc:user_desc,twitter:twitter,fname:fname,lname:lname,fb:fb,instagram:instagram,linkedin:linkedin,tiktok:tiktok,snapchat:snapchat,param:param,action:action},
	       success:function(res){
	        console.log(res);   
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
	jQuery(document).on('mouseover','button.delGal',function(){
		jQuery(this).parent().parent().attr('data-toggle','');
	});
	jQuery(document).on('mouseleave','button.delGal',function(){
		jQuery(this).parent().parent().attr('data-toggle','modal')
	});
    jQuery(document).on('mouseover','button.delBr',function(){
		jQuery(this).parent().parent().attr('data-toggle','');
	});
	jQuery(document).on('mouseleave','button.delBr',function(){
		jQuery(this).parent().parent().attr('data-toggle','modal')
	});

	function mouseOver(hoverClass,aid)
	{	
		if($(aid).attr('href') !== '')
		{
			jQuery(document).on('mouseover',hoverClass,function(){
				jQuery(this).parent().attr('data-toggle','');
			});
			jQuery(document).on('mouseleave',hoverClass,function(){
				jQuery(this).parent().attr('data-toggle','modal')
			});
		}

	}

	mouseOver('#ext_vdo_gal','button.delGal');
	mouseOver('#ext_vdo_br','button.delBr');
		
	//Profile image crop
	var $modal = $('#modal');

	var image = document.getElementById('sample_image');
	

	var cropper;

	$('#upload_image').change(function(event){
		var files = event.target.files;
		
		var done = function(url){
			image.src = url;
			$modal.modal('show');
		};

		if(files && files.length > 0)
		{
			reader = new FileReader();
			reader.onload = function(event)
			{
			
				done(reader.result);
			};
			reader.readAsDataURL(files[0]);
		}
	});

	$modal.on('shown.bs.modal', function() {
		cropper = new Cropper(image, {
			aspectRatio: 1,
			viewMode: 3,
			preview:'.preview'
		});
	}).on('hidden.bs.modal', function(){
		cropper.destroy();
   		cropper = null;
	});

	$('#crop').click(function(){
		canvas = cropper.getCroppedCanvas({
			width:400,
			height:400
		});
		//var userid = $('#upload_image').attr('data-id');
		canvas.toBlob(function(blob){
			url = URL.createObjectURL(blob);
			var reader = new FileReader();
			reader.readAsDataURL(blob);
			reader.onloadend = function(){
				var image = reader.result;
                var param = 'changeProfileImage';
                var action = 'myProfilelibrary';
				$.ajax({
					url:myajaxurl,
					method:'POST',
					data:{image:image,param:param,action:action},
					success:function(res)
					{
						//console.log(res);
						var data = $.parseJSON(res);
						if(data.status==200)
						{
							$('#profileImageUpload').attr('src',data.url);
							jQuery('#modal').modal('hide');
						}

						$modal.modal('hide');
						$('#uploaded_image').attr('src', data);
					}
				});
			};
		});
	});
	//Profile image crop Ends
	//Profile Cover Crop

	//Profile Cover Crop Ends
	
});


jQuery(document).ready(function($){

	
	//Profile image crop
	var $modal = $('#exampleModal');

	var image = document.getElementById('sample_image1');
	

	var cropper;

	$('#open_cover').change(function(event){
		var files = event.target.files;
		
		// function done(url){
		// 	// image.src = url;
		// 	// $modal.appendTo("body").modal('show');
		// 	var image1 =  $('#sample_image1').attr('src',url);
		// 	console.log(image1);
		// 	$('#exampleModal').appendTo("body").modal('show');

		// };
		var done = function(url){
			image.src = url;
			$('#exampleModal').appendTo("body").modal('show');
		};

		if(files && files.length > 0)
		{
			reader = new FileReader();
			reader.onload = function(event)
			{
		
				done(reader.result);
			};
			reader.readAsDataURL(files[0]);
			
		}
	});
    
	$modal.on('shown.bs.modal', function() {
		cropper = new Cropper(image, {
			// aspectRatio: 1,
			// viewMode: 3,
			
		
			autoCrop: true,
			autoCropArea: 1,
			aspectRatio: 20/6,
			minCropBoxWidth: 500,
			minCropBoxHeight: 660,
			viewMode: 3,
			preview:'.preview'
		});
	}).on('hidden.bs.modal', function(){
		cropper.destroy();
   		cropper = null;
	});

	$('#crop1').click(function(){
		canvas = cropper.getCroppedCanvas({
			width:400,
			height:400
		});
		//var userid = $('#upload_image').attr('data-id');
		canvas.toBlob(function(blob){
			url = URL.createObjectURL(blob);
			var reader = new FileReader();
			reader.readAsDataURL(blob);
			reader.onloadend = function(){
				var image = reader.result;
                var param = 'changeCoverImage';
                var action = 'myProfilelibrary';
				$.ajax({
					url:myajaxurl,
					method:'POST',
					data:{image:image,param:param,action:action},
					success:function(res)
					{
						console.log(res);
						var data = $.parseJSON(res);
						if(data.status==200)
						{
							//background:url(http://localhost/test/wp-content/uploads/2021/12/2318cf758dd369e9444a181dc195d7b6_74.png) no-repeat; background-size:cover; height:400px; 
							$('#profile_cover').attr('style',`background:url(${data.url}) no-repeat; background-size:cover; height:400px; position:relative;`);
							jQuery('#exampleModal').modal('hide');
						}

					}
				});
			};
		});
	});

	
	
	//Profile image crop Ends
	//Profile Cover Crop

	//Profile Cover Crop Ends

	//Image Cropper
	var resize = $('#img_demo').croppie({

			enableExif: true,
	
			enableOrientation: true,    
	
			viewport: { 
	
				width: 200,
	
				height: 200,
	
				type: 'square'
	
			},
	
			boundary: {
	
				width: 300,
	
				height: 300
	
			}
	
		});
	function changeImageUpload(imgclass,paramAll){
		var dd = []
		jQuery(document).on('change',imgclass, function () {
		 var checkFile = jQuery(this).prop('files')[0];
		 dd.push(paramAll);
		 //console.log('checkFIle',paramAll);
		 if(checkFile.type.includes('image')){
			 var reader = new FileReader();

		 reader.onload = function (e) {
			
			 resize.croppie('bind',{
			
				 url:e.target.result
			 });

		 }

		 reader.readAsDataURL(this.files[0]);
		 jQuery('.openCropper').show('modal');
		 }
		
	 });
	 
	 //const pa = checkPara(paramAll);
	 jQuery('#crop_img').on('click',function(){
    
	 var action = 'myProfilelibrary';
     var id = $('#lastId').val();
	 var param = dd[0];  	 		 
	
	
	 resize.croppie('result',{
		   type:'canvas',
		   size:'viewport'
	   }).then(function(res){
		   console.log(res);
		   var imgurl = res;
		   jQuery.ajax({
			   url:myajaxurl,
			   type:'POST',
			   data:{"image":imgurl,action:action,param:param,id:id},
			   success:function(response){
				   console.log(response);
				 var data = $.parseJSON(response); 
				 if(data.status==200)
				 {
				   
						$('#insertId').val(data.lastid);
						$('#lastId').val(data.lastid);
					
					$('.openCropper').fadeOut('modal');
				 }
				 else if(data.status==201)
				 {
					$('#insertId12').val(data.lastid);
				    $('#lastId').val(data.lastid);
					
					$('.openCropper').fadeOut('modal');
				 }
				
				  
			   }
		   })
	   });
   });  
 }

 $('div#openCropper button.close').on('click',()=>{  $('#openCropper').fadeOut(); $('#img_upload').val(''); $('#img_upload1').val('');  });
	$('div#openCropper button.btn.btn-success + button').on('click',()=>{  $('#openCropper').fadeOut(); $('#img_upload').val(''); $('#img_upload1').val('');  });

 

 
 //var filename = $('#img_upload1').prop('files').length;
 		  function checkPara(para)
		   {
			   return para;
		   }
	changeImageUpload('#img_upload1','brandUploadImage');
	changeImageUpload('#img_upload','galleryUploadImage');
	

// 	var brSize = $('#img_demos').croppie({

// 		enableExif: true,
	
// 		enableOrientation: true,    
	
// 		viewport: { 
	
// 			width: 200,
	
// 			height: 200,
	
// 			type: 'square'
	
// 		},
	
// 		boundary: {
	
// 			width: 300,
	
// 			height: 300
	
// 		}
	
// 	});
	
// 	jQuery(document).on('change','#img_upload1', function () {
// 		var checkFile = jQuery(this).prop('files')[0];
// 		console.log(checkFile);
// 		if(checkFile.type.includes('image')){
// 			var reader = new FileReader();
	
// 		reader.onload = function (e) {
		   
// 			brSize.croppie('bind',{
		   
// 				url:e.target.result
// 			});
	
// 		}
	
// 		reader.readAsDataURL(this.files[0]);
// 		jQuery('.openCroppers').show('modal');
// 		}
	   
// 	});
	
// 	jQuery('#crop_imgs').on('click',function(){
	
// 	var action = 'myProfilelibrary';
	
// 	var param = 'brandUploadImage';  	 		 
	
	
// 	brSize.croppie('result',{
// 		  type:'canvas',
// 		  size:'viewport'
// 	  }).then(function(res){
// 		  console.log(res);
// 		  var imgurls = res;
// 		  jQuery.ajax({
// 			  url:myajaxurl,
// 			  type:'POST',
// 			  data:{"image":imgurls,action:action,param:param},
// 			  success:function(response){
// 				  //console.log(response);
// 				var data = $.parseJSON(response); 
// 				if(data.status==200)
// 				{
				  
// 					 $('#insertId12').val(data.lastid);
				 
// 				   $('.openCroppers').fadeOut('modal');
// 				}
			   
				 
// 			  }
// 		  })
// 	  });
// 	}); 


 $('#openBrands ').appendTo($('body'));
 //Brands Submit
 $('#g_ext_id3').hide();      			
 $('#g_img_id2').hide();
 $('#g_img_id4').hide();
 $('#check_ext_link1').change(function(){
  if($(this).prop('checked'))
  {
	  $('#img_upload1').val('');
	  $('#g_img_id4').hide();
	  $('#check_img1').prop('checked',false);	
	  $('#check_ex1').prop('checked',false);	
	 $('#g_ext_id3').fadeIn();
	 $('#g_img_id2').fadeIn();
  }
  else{
	  $('#g_ext_id3').hide();
	  $('#g_img_id2').hide();
	  
  }
 
 });
 $('#check_img1').change(function(){
  if($(this).prop('checked'))
  {
	  $('#ext_link1').val('');
	  $('#ext_thumbnail1').val('');
	  $('#g_ext_id3').hide();
	  $('#g_img_id2').hide();
	  $('#check_ext_link1').prop('checked',false);	
	  $('#check_ex1').prop('checked',false);	
	 $('#g_img_id4').fadeIn();
  }
  else{
	  $('#g_img_id4').hide();
	  
  }
 
 });
 $('#check_ex1').change(function(){
  if($(this).prop('checked'))
  {
	  $(this).val(1);
  }
  else{
	  $(this).val(0);
	  
  }
 
 });

 
   

 $('#pre_loader').hide();
 $('#submitBrands').on('submit',function(e){
	 e.preventDefault();

	 var b_title = $('#b_title1').val();

	 var b_url = $('#b_url1').val();
	 var param = 'addBrands';
	 var action = 'myProfilelibrary';
	 var lastid = $('#insertId12').val();
	 var check_ex = $('#check_ex1').val();
	 var uid = $(this).attr('data-uid');
	 
	  
		var ext_link = $('#ext_link1').val();
		var ext_thumbnail = $('#ext_thumbnail1').prop('files')[0];
		var formdata = new FormData();
	  if($('#img_upload1').prop('files')[0] !== undefined  && $('#img_upload1').prop('files')[0].type.includes('video'))
	  {
		  var video = $('#img_upload1').prop('files')[0];
		  formdata.append('video',video);
	  }
	  formdata.append('b_title',b_title);

	  formdata.append('b_url',b_url);
	  formdata.append('uid',uid);
	  formdata.append('ext_link',ext_link);
	  formdata.append('lastid',lastid);
	  formdata.append('thumbnail',ext_thumbnail);
	  formdata.append('check_ex',check_ex);
	  formdata.append('video',video);
	  formdata.append('param',param);
	  formdata.append('action',action);

	  $.ajax({
	  	url:myajaxurl,
	  	type:'POST',
	  	data:formdata,
	  	contentType:false,
	  	processData: false,
		beforeSend:function(){
			$('#pre_loader').fadeIn();
		},
	  	success:function(res)
	  	{
	  		//console.log(res);
	  		var data = $.parseJSON(res);
	  		if(data.status==200)
	  		{
	  			alert(data.message);
	  			setTimeout(function(){
					$('#pre_loader').hide();
	  				location.reload();
	  			},2000);
	  		}
	  		else {
	  			alert(data.message);
	  			setTimeout(function(){
	  				location.reload();
	  			},2000);
	  		}
			  
	  	}
	  });
 });

 //Brands Submit Ends
	//End Brand Cropper Ends
	
    $('#g_ext_id').hide();      			
    $('#g_img_id').hide();
    $('#g_img_id1').hide();
	$('#check_ext_link').change(function(){
		if($(this).prop('checked'))
		{
			$('#img_upload').val('');
			$('#g_img_id').hide();
			$('#check_img').prop('checked',false);	
			$('#check_ex').prop('checked',false);	
		   $('#g_ext_id').fadeIn();
		   $('#g_img_id1').fadeIn();
		}
		else{
			$('#g_ext_id').hide();
			$('#g_img_id1').hide();
			
		}
	   
	   });
	   $('#check_img').change(function(){
		if($(this).prop('checked'))
		{
			$('#ext_link').val('');
			$('#ext_thumbnail').val('');
			$('#g_ext_id').hide();
			$('#g_img_id1').hide();
			$('#check_ext_link').prop('checked',false);	
			$('#check_ex').prop('checked',false);	
		   $('#g_img_id').fadeIn();
		}
		else{
			$('#g_img_id').hide();
			
		}
	   
	   });
	   $('#check_ex').change(function(){
		if($(this).prop('checked'))
		{
			$(this).val(1);
		}
		else{
			$(this).val(0);
			
		}
	   
	   });
	  
	   $('#pre_loader').hide();
	   $('#submitGallery').on('submit',function(e){
		   e.preventDefault();
           var g_title = $('#g_title').val();
           var g_desc = $('#g_desc').val();
           var g_url = $('#g_url').val();
           var param = 'addGallery';
		   var action = 'myProfilelibrary';
		   var lastid = $('#insertId').val();
           var check_ex = $('#check_ex').val();
           var uid = $(this).attr('data-uid');
		   
		    
				var ext_link = $('#ext_link').val();
		  		var ext_thumbnail = $('#ext_thumbnail').prop('files')[0];
				  var formdata = new FormData();
			if($('#img_upload').prop('files')[0] !== undefined && $('#img_upload').prop('files')[0].type.includes('video'))
			{
				var video = $('#img_upload').prop('files')[0];
				formdata.append('video',video);
			}
			formdata.append('g_title',g_title);
			formdata.append('g_desc',g_desc);
			formdata.append('g_url',g_url);
			formdata.append('ext_link',ext_link);
			formdata.append('lastid',lastid);
			formdata.append('thumbnail',ext_thumbnail);
			formdata.append('check_ex',check_ex);
			formdata.append('param',param);
			formdata.append('action',action);

			$.ajax({
				url:myajaxurl,
				type:'POST',
				data:formdata,
				contentType:false,
				processData: false,
				beforeSend:function()
				{
					$('#pre_loader').fadeIn();
				},
				success:function(res)
				{
					//console.log(res);
					var data = $.parseJSON(res);
					if(data.status==200)
					{
						alert(data.message);
						setTimeout(function(){
							$('#pre_loader').hide();
							location.reload();
						},2000);
					}
					else {
						alert(data.message);
						setTimeout(function(){
							location.reload();
						},2000);
					}
					
				}
			});
	   });
	   function changeImageUpload1(imgclass,paramName){
		
		var resize1 = $('#img_demo1').croppie({
	
			enableExif: true,
		
			enableOrientation: true,    
		
			viewport: { 
		
				width: 200,
		
				height: 200,
		
				type: 'square'
		
			},
		
			boundary: {
		
				width: 300,
		
				height: 300
		
			}
		
		});
	jQuery(document).on('change',imgclass, function () {
	 var checkFile = jQuery(this).prop('files')[0];
	
	 if(checkFile.type.includes('image')){
		 var reader = new FileReader();

	
	 reader.onload = function (e) {
		var img = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAARMAAAC3CAMAAAAGjUrGAAAAclBMVEXMzMwAAADR0dHS0tLV1dW3t7elpaWIiIjAwMCwsLDLy8tbW1t3d3d8fHy/v7/ExMSVlZU6OjoeHh6np6dnZ2ckJCRvb29KSkpVVVWYmJiNjY0XFxcSEhJFRUUrKyuWlpYiIiIzMzNHR0dpaWk+Pj4LCwsebs21AAAE4UlEQVR4nO3Za5eiOBAGYKoSRECIFwSvjHa3//8vbgUEEnBn17M9O8w57/Ohu40YoaxUSjoIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA/nzs6UeVYP9AO8KT1/+LdxjP4k/MPHmr34wj1ylpxoI4Kr6+img5nCqHWXr9yHbq7XcIs3CYJZZZqiIK+2k4WKyqa3rK35/4l9HkaWJyuhFVn8WdKOrOlAuiQyk/KvPmR8o1LZ4v4bwiSlel/Pzsng33dP60I9GcgjJQt9KeWE5lqCWftTlQ1p4pVxTZFNcL2pq3plcSxy4mOV12Wsk8fKJNM8Yh7WN5L52UVM4oKD21atMkWXZnp6+0bJ7J6NiOqZjSd86dFxR1MVEpdYtRLehk/+Tb5Zl3uuxDNyfL9jwdHLdDCVX6OaQzCscv/AlD5bK7WKaymyXQm0pCy+shELzdzC9RVLqdjBkq2lOP+2glXpL7O8h0zk0ty6OPSdQfoQ5X+Zu/6mGnO70V7P9HSD8mF5Vs7UrxoqWqu7MbrfPhgVqPL0rWXOjGpOjzRN3txElXr6xpmv526nCbnpJpkoLrajh1ztoa00ik5Hav0scmqRx26algiElJ3cFqZwflebeGbA9zWzzxizThHR25+Tid1Di6OW7O5+d1qvWk+iaPgw6GmATJZd+Ub9Yx2WdkTebD0ZKAM4uJTml6Rrog+ytxs1ritHMeLS9tpqgjpaOYyj5j9+3Q6U9qynKl47TtT6SEeIfvv+dSvs3L1ZzTqm1Y1s5zcZM7HTaXs+ywepolEqWmMofOAtHHm+0Mr3lTWGQZuscXl/dan19NepPpCfH10QyGo5i4jyQosnyklkzalvBZQJ2Y8GLz+MqKmjbNkCq9mJSPecUkedFG6q7b+lmeNJlSn6Yh0ffn/uTERLrhXEsfK4snDeaeJ7Ky8/GY5P6qvVDz9/WkGUnkW4wOfJJ4z+1p2Hc2W/OMnG6qD0dzrifebvscGrp4f99ZjHsrCR7Vo6+GdsdqwyT9SRtD25QNPVtE8eiTUIdZ7Ts8Xg/N0Ec/dD54/YmfUlJeC6kpS28CQ1UYt450kp8mUFcv7hJnCa/bn+xn1Z+ogkYjEpKr04jfnGPT2rt625doNtuLF5QdjRyZa7el44c8Mm4CGqf1nwGmT/8jkj7zw3l67S4Xv1tV7Y4ju8/WXT5J2FvQOg9DE/DdrcNsizp/Dd/7pBeMv+t6vgEfne94lu023KJphofq5J26XThtr2HOfqb0k3f1RKVnpyo1O7oU2b5e872e1dI5+BVfCqC/M8sm8rzpyIau7qc9tGp2+Uz2LqvbdyQMWRdZDjbtvZpH94VSNv7pd4vfyPgh4E86aXujrdEMJXfZRphZh2evwiZOX8Lm8fJ2U78XS4v2aewsSoebdlC2py87pCQks6qw3u2RZmN5XDedQzuYVFSvsuxKdeh9mrn7yCSvph96NrlwqrIoWtW0feadFC46ZFH5oGJOWRLwj9Jr1hcrR9SPFnvapscXN47+wbLsCzSbU7p90L04Jn0ZMdHH5XEv4zllSWD/wzJ6+Po/PvYu9n/9/04ziz9NMzSrJAEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAPgWfwFLyzCJlWZyEQAAAABJRU5ErkJggg==";
		resize1.croppie('bind',{
		
			 url:e.target.result	
		 });
		 
		
	 }
	
	 reader.readAsDataURL(checkFile);
	 jQuery('.openCropper1').show('modal');
	 }
	
	});
	
	jQuery('.crop_img1').on('click',function(){
	
	var action = 'myProfilelibrary';
	var param = paramName;  	 
	var postid = $(this).attr('data-post');
	resize1.croppie('result',{
	   type:'canvas',
	   size:'viewport'
	}).then(function(res){
	
	   var imgurl = res;
	   jQuery.ajax({
		   url:myajaxurl,
		   type:'POST',
		   data:{"image":imgurl,postid:postid,action:action,param:param},
		   success:function(response){
			   //console.log(response);
			 var data = $.parseJSON(response); 
			 if(data.status==200)
			 {
				 $('.openCropper1').fadeOut('modal');
				 $('#insertId3').val(data.lastid);
				 $('#latest_gal_img').attr('src',data.img_url);
			 }
			
			  
		   }
	   })
	});
	});  
	}
	   
	  function galleryModalForm(className,type,render)
	  {
		$(document).on('click',className,function(e){
			e.preventDefault();
			var id = $(this).attr('data-id');
			var img = type;
			var param = 'get_gal_images';
			var action = 'myProfilelibrary';
	
			$.ajax({
				url:myajaxurl,
				type:'GET',
				data:{id:id,param:param,action:action,img:img},
				success:function(res)
				{
					
					var data = $.parseJSON(res);
					if(data.status==200)
					{
	
					
						$(render).html(data.data);
	  					editGalleryCheckbox(data.type,'#g_ext_id201','#g_img_id201','#g_img_id1201','#check_ext_link201','#check_img201','#check_ex201','#update_img_upload','#update_ext_thumbnail','#check_ext_link201');  
						$('#crops').html(data.modal);
						changeImageUpload1('#update_img_upload','editGalleryImage'); 
						$('div#openCropper1 button.close').on('click',()=>{  $('#openCropper1').fadeOut();   $('#g_img_id201 > #update_img_upload').val(''); });
	  					$('div#openCropper1 button.btn-success + button').on('click',()=>{  $('#openCropper1').fadeOut(); $('#g_img_id201 > #update_img_upload').val(''); });
					}
					
	
				}
			});		
	
		
		});
	  }

	  function brandsModalForm(className,type,render)
	  {
		$(document).on('click',className,function(e){
			e.preventDefault();
			var id = $(this).attr('data-id');
			var img = type;
			var param = 'get_all_brands';
			var action = 'myProfilelibrary';
	
			$.ajax({
				url:myajaxurl,
				type:'GET',
				data:{id:id,param:param,action:action,img:img},
				success:function(res)
				{

					//console.log(res);
					
					var data = $.parseJSON(res);
					if(data.status==200)
					{
						
					
						$(render).html(data.data);
	  					editGalleryCheckbox(data.type,'#g_ext_idbr','#g_img_idbr1','#g_img_id1br','#check_ext_linkbr','#check_imgbr','#check_exbr','#update_img_upload','#update_ext_thumbnail','#ext_linkbr');  
						$('#crops1').html(data.modal);
						changeImageUpload1('#update_img_upload','editBrandImage');
						$('div#openCropper1 button.close').on('click',()=>{  $('#openCropper1').fadeOut();   $('#g_img_idbr1 > #update_img_upload').val(''); });
	  					$('div#openCropper1 button.btn-success + button').on('click',()=>{  $('#openCropper1').fadeOut(); $('#g_img_idbr1 > #update_img_upload').val(''); });
						
					}
					
	
				}
			});		
	
		
		});
	  }
	  
	  function editGalleryCheckbox(img,secExt,secImg,secThumb,chlink,chimg,chex,fdimg,fdthmnail,fdlink){
		// $(secExt).hide();      			
		if(img=='img')
		{
			$(secThumb).hide();
			$(secExt).hide();
			$(secImg).show();
		}
		else if(img=='thumb')
		{
			$(secImg).hide();
			$(secThumb).show();
			$(secExt).show();
		}
		else{
			$(secThumb).hide();
			$(secImg).hide();
			$(secExt).hide();
		}
		
		$(chlink).change(function(){
			if($(this).prop('checked'))
			{
				$(fdimg).val('');
				$(secImg).hide();
				$(chimg).prop('checked',false);	
				$(chex).prop('checked',false);	
			   $(secExt).fadeIn();
			   $(secThumb).fadeIn();
			}
			else{
				$(secExt).hide();
				$(secThumb).hide();
				
			}
		   
		   });
		   $(chimg).change(function(){
			if($(this).prop('checked'))
			{
				$(fdlink).val('');
				$(fdthmnail).val('');
				$(secExt).hide();
				$(secThumb).hide();
				$(chlink).prop('checked',false);	
				$(chex).prop('checked',false);	
			   $(secImg).fadeIn();
			}
			else{
				$(secImg).hide();
				
			}
		   
		   });
		   $(chex).change(function(){
			if($(this).prop('checked'))
			{
				$(this).val(1);
			}
			else{
				$(this).val(0);
				
			}
		   
		   });
	  }
	  galleryModalForm('.editGalImg','images','#editGalleryform');
	  galleryModalForm('.editGalImg','ext','#editGalleryform');
	  galleryModalForm('.editGalImg','video','#editGalleryform');
	  brandsModalForm('.editBrImg','images','#editBrandsform');


	  
	  $('.pre_loader').hide();
	 function updateGalleryfn(id,title,desc,url,img)
	  {
	   $(document).on('submit',id,function(e){
		   e.preventDefault();
			
		   var g_title = $(title).val();
		   var g_desc = $(desc).val();
		   var g_url = $(url).val();
		   var param = 'updateGallery';
		   var action = 'myProfilelibrary';
		   var lastid = $(this).attr('data-form-id');
		   var imgId = $('#insertId3').val();
		   var check_ex = $('#check_ex201').val();
		   $(img).prop('files').length > 0 && $(img).prop('files')[0].type.includes('video')
		 
			
				var ext_link = $('#ext_link201').val();
			
				
				  var formdata = new FormData();
			if($(img).prop('files').length > 0 && $(img).prop('files')[0].type.includes('video'))
			 {
				var video = $(img).prop('files')[0];
				formdata.append('video',video);
			}
			else if($('#update_ext_thumbnail').prop('files').length > 0 && $('#update_ext_thumbnail').prop('files')[0].type.includes('image')){
				var ext_thumbnail = $('#update_ext_thumbnail').prop('files')[0];
				formdata.append('thumbnail',ext_thumbnail);
			}
			formdata.append('g_title',g_title);
			formdata.append('g_desc',g_desc);
			formdata.append('g_url',g_url);
			formdata.append('ext_link',ext_link);
			formdata.append('lastid',lastid);
			if(imgId) formdata.append('imgId',imgId);
			
			formdata.append('check_ex',check_ex);
			formdata.append('param',param);
			formdata.append('action',action);
 
			$.ajax({
				url:myajaxurl,
				type:'POST',
				data:formdata,
				contentType: false,
				cache: false,
				processData: false,
				beforeSend:function()
				{
					$('.pre_loader').fadeIn();
				},
				success:function(res)
				{
					console.log(res);
					var data = $.parseJSON(res);
					if(data.status==200)
					{
						alert(data.message);
						setTimeout(function(){
							$('.pre_loader').hide();
							location.reload();
						},2000);
					}
					else {
						alert(data.message);
						setTimeout(function(){
							location.reload();
						},2000);
					}
					
				}
			});
	   });
	  }
	  
	  function updateBrandsfn(id,title,url,img)
	  {
		
	   $(document).on('submit',id,function(e){
		   e.preventDefault();
		   var g_title = $(title).val();
		   var g_url = $(url).val();
		   var param = 'updateBrands';
		   var action = 'myProfilelibrary';
		   var lastid = $(this).attr('data-form-id');
		   var imgId = $('#insertId3').val();
		   var check_ex = $('#check_exbr').val();
		   
		 
			
				var ext_link = $('#ext_linkbr').val();
				  var ext_thumbnail = $('#update_ext_thumbnail').prop('files')[0];
				  var formdata = new FormData();
				  if($(img).prop('files').length > 0 && $(img).prop('files')[0].type.includes('video'))
			 {
				var video = $(img).prop('files')[0];
				formdata.append('video',video);
			}
			else if($('#update_ext_thumbnail').prop('files').length > 0 && $('#update_ext_thumbnail').prop('files')[0].type.includes('image')){
				var ext_thumbnail = $('#update_ext_thumbnail').prop('files')[0];
				formdata.append('thumbnail',ext_thumbnail);
			}
			formdata.append('g_title',g_title);
			
			formdata.append('g_url',g_url);
			formdata.append('ext_link',ext_link);
			formdata.append('lastid',lastid);
			if(imgId){
				formdata.append('imgId',imgId);
			} 
			//formdata.append('thumbnail',ext_thumbnail);
			formdata.append('check_ex',check_ex);
			formdata.append('param',param);
			formdata.append('action',action);
 
			$.ajax({
				url:myajaxurl,
				type:'POST',
				data:formdata,
				contentType: false,
				cache: false,
				processData: false,
				beforeSend:function(){
					$('.pre_loader').fadeIn();
				},
				success:function(res)
				{
					console.log(res);
					var data = $.parseJSON(res);
					if(data.status==200)
					{
						alert(data.message);
						setTimeout(function(){
							$('.pre_loader').hide();
							location.reload();
						},2000);
					}
					else {
						alert(data.message);
						setTimeout(function(){
							location.reload();
						},2000);
					}
					
				}
			});
	   });
	  }
	   
        function deleteBrandAndGallery(idName,para,type)
		{
			$(document).on('click',idName,function(){
				conf = confirm(`Are you sure you want to delete ${type}`);
				var id = $(this).attr('data-attr');
				console.log('id',id);
				var param = para;
				var action = 'myProfilelibrary';
				if(conf)
				{
					$.ajax({
						url:myajaxurl,
						type:'POST',
						data:{'id':id,param:param,action:action},
						success:function(res){
							//console.log(res);
							var data = $.parseJSON(res);
							if(data.status==200)
							{
								alert(`${type} has been deleted successfully`);
							}
							setTimeout(function(){
								location.reload();
							},2000);
						}

					});
				}
			})
		}
		
	  updateBrandsfn('#updateBrands','#update_b_title','#update_b_url','#update_img_upload');
	    
	  updateGalleryfn('#updateGallery','#update_g_title','#update_g_desc','#update_g_url','#update_img_upload');
	   deleteBrandAndGallery('#delGal','deleteGal','Gallery');
	   deleteBrandAndGallery('#delBr','deleteBrand','Brand');

	  
		   //Profile image crop
//Profile image crop




		
	   //update Gallery Ends  
	  
   
	 
});
