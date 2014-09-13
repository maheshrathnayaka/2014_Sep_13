 $(document).ready(function() {
//upload
//////////////////////////////////////////////////////////
        
        var outdiv;
        
        
        
        $('#submit-btn1').on('click', function(e)
        {        
	outdiv = '#img11';
        
        });
        
        $('#submit-btn2').on('click', function(e)
        {       
         outdiv = '#img12';
         
        });
        
        $('#submit-btn3').on('click', function(e)
        {      
	outdiv = '#img13';
        
        });
        
        $('#submit-btn4').on('click', function(e)
        {      
	outdiv = '#img14';
        
        });
        
        
        var progressbox    = $('#progressbox');
	var progressbar     = $('#progressbar');
	var statustxt       = $('#statustxt');
	var completed      = '0%';
        
        
       var options1 = { 
                        
        type: 'POST',
        beforeSubmit:beforeSubmit,  // pre-submit callback 
	uploadProgress:OnProgress,
	resetForm:true,
        dataType:"HTML",
        success:function(data) 
        {
            if (data) 
            {
                $('#submit-btn11').show(); //hide submit button
                $('#loading-img1').hide(); //hide submit button
                $(outdiv).html(data);
                $('#output').html("successfully uploaded");
               
            }
        }
          }; 
        
        $('#MyUploadForm1').submit(function() { 

         $(this).ajaxSubmit(options1);  			
            return false; 

         });
        
       
	
//when upload progresses	
function OnProgress(event, position, total, percentComplete)
{
	//Progress bar
	progressbar.width(percentComplete + '%'); //update progressbar percent complete
	statustxt.html(percentComplete + '%'); //update status text
	if(percentComplete>50)
	{
            statustxt.css('color','#fff'); //change status text to white after 50%
	}
}



//function to check file size before uploading.
function beforeSubmit()
{
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{

		if( !$('#imageInput1').val()) //check empty input filed
		{
			$("#output").html("Something wrong with uploaded file, something missing1");
			return false;
		}
		
		var fsize = $('#imageInput1')[0].files[0].size; //get file size
		var ftype = $('#imageInput1')[0].files[0].type; // get file type
		
		//allow only valid image file types 
		switch(ftype)
        {
            case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
                break;
            default:
                $("#output").html("<b>"+ftype+"</b> Unsupported file type!");
				return false;
        }
		
		//Allowed file size is less than 1 MB (1048576)
		if(fsize>1048576) 
		{
			$("#output").html("<b>"+bytesToSize(fsize) +"</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
			return false;
		}
		
		//Progress bar
		progressbox.show(); //show progressbar
		progressbar.width(completed); //initial value 0% of progressbar
		statustxt.html(completed); //set status text
		statustxt.css('color','#000'); //initial color of status text

				 
		$('#submit-btn11').hide(); //hide submit button
		$('#loading-img1').show(); //hide submit button
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
function bytesToSize(bytes) 
{
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}
        ///////////////////////////////////////////////////////////
        
});