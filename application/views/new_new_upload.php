<html>
    
<head>

  <style type="text/css">
<?php
require_once(APPPATH . 'assets/css/bootstrap.css');
require_once(APPPATH . 'assets/css/bootstrap.min.css');
require_once(APPPATH . 'assets/css/bootstrap-theme.min.css');
require_once(APPPATH . 'assets/css/customTh.css');
?>          
 </style>
 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

        <script>
            
<?php

require_once(APPPATH . 'assets/js/jquery.min.js');
require_once(APPPATH . 'assets/js/bootstrap.min.js');
require_once(APPPATH . 'assets/js/jquery.easyModal.js');
require_once(APPPATH . 'assets/js/jquery.form.min.js');
?>
    
    $(document).ready(function() { 


            $('#mmmm').easyModal({
		
		top : 50,
		overlayColor: "#333",
		overlayClose: false,
		closeOnEscape: false
        });
        
         
         
        $('#submit-btn4').on('click', function(e){
	$('#mmmm').trigger('openModal');
           
        
        $.ajax({
        url: "http://kstoretesting.net16.net/new_new_upload/index",
        type: 'POST',
        dataType: "HTML",
        success: function(data) 
        {
            if (data) 
            {
                alert("Rocklee");
                $('#upupupup').html(data);

            }
        }

    });
        
	
        });

////////////////////////////////////////////
var navListItems = $('ul.setup-panel li a'),
        allWells = $('.setup-content');

    allWells.hide();

    navListItems.click(function(e)
    {
       e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this).closest('li');
        
        if (!$item.hasClass('disabled')) 
        {
            navListItems.closest('li').removeClass('active');
            $item.addClass('active');
            allWells.hide();
            $target.show(); 
        }
  
    });
    
    $('ul.setup-panel li.active a').trigger('click');
    
    // next ONLY //
    $('#activate-step-2').on('click', function(e) {
        $('ul.setup-panel li:eq(1)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-2"]').trigger('click');
       // $(this).remove();
    });
    
    
    $('#activate-step-3').on('click', function(e) {
        $('ul.setup-panel li:eq(2)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-3"]').trigger('click');
        //$(this).remove();
    });
    
    $('#activate-step-4').on('click', function(e) {
        $('ul.setup-panel li:eq(2)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-3"]').trigger('click');
        //$(this).remove();
    });
    
    
    // back //
    
        $('#back-step-1').on('click', function(e) {
        $('ul.setup-panel li:eq(2)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-1"]').trigger('click');
       // $(this).remove();
        });
    
        $('#back-step-2').on('click', function(e) {
        $('ul.setup-panel li:eq(3)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-2"]').trigger('click');
       // $(this).remove();
        });
        
//////////////////////////////////////////////




	var progressbox     = $('#progressbox');
	var progressbar     = $('#progressbar');
	var statustxt       = $('#statustxt');
	var completed       = '0%';
	
	var options = { 
			target:   '#output',   // target element(s) to be updated with server response 
			beforeSubmit:  beforeSubmit,  // pre-submit callback 
			uploadProgress: OnProgress,
			success:       afterSuccess,  // post-submit callback 
			resetForm: true        // reset the form after successful submit 
		}; 
		
	 $('#MyUploadForm').submit(function() { 
			$(this).ajaxSubmit(options);  			
			// return false to prevent standard browser submit and page navigation 
			return false; 
		});
	
//when upload progresses	
function OnProgress(event, position, total, percentComplete)
{
	//Progress bar
	progressbar.width(percentComplete + '%') //update progressbar percent complete
	statustxt.html(percentComplete + '%'); //update status text
	if(percentComplete>50)
		{
			statustxt.css('color','#fff'); //change status text to white after 50%
		}
}

//after succesful upload
function afterSuccess()
{
	$('#submit-btn').show(); //hide submit button
	$('#loading-img').hide(); //hide submit button

}

//function to check file size before uploading.
function beforeSubmit(){
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{

		if( !$('#imageInput').val()) //check empty input filed
		{
			$("#output").html("Are you kidding me?");
			return false
		}
		
		var fsize = $('#imageInput')[0].files[0].size; //get file size
		var ftype = $('#imageInput')[0].files[0].type; // get file type
		
		//allow only valid image file types 
		switch(ftype)
        {
            case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
                break;
            default:
                $("#output").html("<b>"+ftype+"</b> Unsupported file type!");
				return false
        }
		
		//Allowed file size is less than 1 MB (1048576)
		if(fsize>1048576) 
		{
			$("#output").html("<b>"+bytesToSize(fsize) +"</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
			return false
		}
		
		//Progress bar
		progressbox.show(); //show progressbar
		progressbar.width(completed); //initial value 0% of progressbar
		statustxt.html(completed); //set status text
		statustxt.css('color','#000'); //initial color of status text

				
		$('#submit-btn').hide(); //hide submit button
		$('#loading-img').show(); //hide submit button
		$("#output").html("");  
	}
	else
	{
		//Output error to older unsupported browsers that doesn't support HTML5 File API
		$("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
		return false;
	}
}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

}); 

</script>
</head>
<body>
 <div>
     <h2  style="padding-left: 65px; margin-bottom: 30px;color: #99A5BE" >Please Upload your image</h2>
     
     <span style="margin-left: 40px;">Image Type allowed: Jpeg, Jpg, Png and Gif. | Maximum Size 1 MB</span>
<form action="<?php echo base_url(); ?>new_new_upload/newupup" onSubmit="return false" method="post" enctype="multipart/form-data" id="MyUploadForm">
 
    <table>
        <tr>
            <td>
               <input name="ImageFile" id="imageInput" type="file" style="color: #7B86D8; background-color: #D6DDD6 ; margin-left: 40px;"/>              
            </td>
            <td>
             <input type="submit"  id="submit-btn" value="Upload" style="background-color: #6FA7D1; margin-left: 5px "/>                       
            </td>
        </tr>              
    </table>


<img src="<?php echo APPPATH.'../images/ajax-loader.gif'?>" id="loading-img" style="display:none;" alt="Please Wait"/>
</form>
<div id="progressbox" style="display:none;"><div id="progressbar"></div ><div id="statustxt">0%</div></div>
<div id="output"></div>
</div>
</body>
</html>