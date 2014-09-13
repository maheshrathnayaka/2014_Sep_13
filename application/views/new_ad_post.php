<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="Add to Cartport" content="width=device-width, initial-scale=1.0">
        <title>Sell Products</title>
        

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
require_once(APPPATH . 'assets/js/newUpload.js');





?>

    

        $(document).ready(function() {

        document.getElementById("loading-img1").style.display="none";
        document.getElementById("loading-img11").style.display="none";
        
        document.getElementById("errorcouponcode").style.display="none";
        document.getElementById("errordiscountinput").style.display="none";
        document.getElementById("errorvaliduntil").style.display="none";
        document.getElementById("errornumberofcouponinput").style.display="none";
        
        document.getElementById("errordiscountinput2").style.display="none";
        document.getElementById("errornumberofcouponinput2").style.display="none";
        $('#Coupen :input').attr('disabled', true);
         
     
        
        
        
        //////////////////////////////
         $('#uploadModel').easyModal({
		
		top : 50,
		overlayColor: "#333",
		overlayClose: false,
		closeOnEscape: false
                
        });
      
         
         $('#closemodal1').on('click', function(e)
         {
         $('#uploadModel').trigger('closeModal');
          });
         
            
        
        $('#submit-btn1').on('click', function(e)
        {
       
	$('#uploadModel').trigger('openModal');

        });
        
        $('#submit-btn2').on('click', function(e)
        {
       
	$('#uploadModel').trigger('openModal');

        });
               
        $('#submit-btn3').on('click', function(e)
        {
       
	$('#uploadModel').trigger('openModal');

        });
        
        $('#submit-btn4').on('click', function(e)
        {
       
	$('#uploadModel').trigger('openModal');

        });
        ///////////////////////////////
        
        
        
        var navListItems = $('ul.setup-panel li a'),
        allWells = $('.setup-content');

    allWells.hide();

    navListItems.click(function(e)
    {
       e.preventDefault();
        var $target1 = $($(this).attr('href')),
            $item = $(this).closest('li');
        
        if (!$item.hasClass('disabled')) 
        {
            navListItems.closest('li').removeClass('active');
            $item.addClass('active');
            allWells.hide();
            $target1.show(); 
        }
  
    });
    
    $('ul.setup-panel li.active a').trigger('click');
    
    // next ONLY //

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
        
        
        //////////////////////////////////////////
        

    
});

    
    function checkSubSubCat(value)
    {
       
        
        var split = value.split(" "); 
        var $oldcategory = split[0];
        var $oldendnode = split[1];
        
        var $category = $oldcategory.trim();
        var $endnode = $oldendnode.trim();
        
       if($endnode != 0)
       {
           generateDiv($category);
       }
       else
       {
        $.ajax({
        url: "http://kstoretesting.net16.net/new_ad_post/getSubSubCat/" + $category,
        type: 'POST',
        dataType: "HTML",
        success: function(data) 
        {
            if (data) 
            {
                
                $('#subsubcategorydiv').html(data);

            }
        }

    });
    }
    }


    function checkSubCat(value) 
    {
        document.getElementById("loading-img1").style.display="block";
        
        var split = value.split(" "); 
        var $oldcategory = split[0];
        var $oldendnode = split[1];
        
        var $category = $oldcategory.trim();
        var $endnode = $oldendnode.trim();
        
       if($endnode != 0)
       {
           generateDiv($category);
       }
       else
       {
       
        $.ajax({
        url: "http://kstoretesting.net16.net/new_ad_post/getSubCat/" + $category,
        type: 'POST',
        dataType: "HTML",
        success: function(data) 
        {
            if (data) 
            {
                
                $('#subcategorydiv').html(data);

            }
        }

    });
    }
    }

    var cat;
    function generateDiv(value)
    {

        
        cat=value;
        var $category = value;
        $.ajax({
        url: "http://kstoretesting.net16.net/new_ad_post/getfields/" + $category,
        type: 'POST',
        dataType: "HTML",
        success: function(data) 
        {
            if (data) 
            {
                
                $('#CategoryField').html(data);
                

            }
        }

    });
        
    }
    

    
    
    function submitCoupon()
    {
     
        var $coupenCode=$('input#couponcodeinput').val();
        var $expdate=$('input#expdateinput').val();
        var $addeddate=$('input#docName').val();
        var $percentage=$('input#discountinput').val();
        var $noofcoupons=$('input#numberofcouponinput').val();
     
   if(document.getElementById("toggleElement").checked)
   {


     if($coupenCode =="" )
       {
           document.getElementById("errorcouponcode").style.display="block";
       }
       
        else if($percentage =="" )
       {
           document.getElementById("errordiscountinput").style.display="block";
       }
       else if($expdate =="" )
       {
           document.getElementById("errorvaliduntil").style.display="block";
       }
       else if($noofcoupons =="" )
       {
           document.getElementById("errornumberofcouponinput").style.display="block";
       }
         else if(isNaN($percentage))
       {
           document.getElementById("errordiscountinput2").style.display="block";
       }
        else if(isNaN($noofcoupons))
       {
           document.getElementById("errornumberofcouponinput2").style.display="block";
       }
       else
       {
     
             $('ul.setup-panel li:eq(2)').removeClass('disabled');
             $('ul.setup-panel li a[href="#step-3"]').trigger('click');
     
            $.post('http://kstoretesting.net16.net/new_ad_post/adCoupon/', {coupencode: $coupenCode,expdate: $expdate, addeddate:$addeddate ,percentage :$percentage , noofcoupons: $noofcoupons},
            function(data)
            {
                
	    });
            
        }
    }
    else
    {
        $('ul.setup-panel li:eq(2)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-3"]').trigger('click');
    }

    }
    
    
    function submitAd(value)
    {
    var $aaa=[];
    if(value != 0)
    {
        alert(value);
        for(i=1 ; i<=value ; i++)
        {
            $aaa[i] = $('#'+i).val();
            
        }
    }
    else
    {
        $aaa[1]=0;
        
    }
    
    var $isnegotiable=0;
    if(document.getElementById("isnegotiable").checked)
    {
        $isnegotiable=1;
    }
    
       var $loc=$('#location').val();
       var $title=$('input#title').val();
       var $description=$('#description').val();
       var $price=$('input#price').val();
       var $categoryid=cat;
       
       var $qty=$('input#qty').val();
       
       
       if($title =="" )
       {
           document.getElementById("errortitle").style.display="block";
       }
       
        else if( $description =="" )
       {
           document.getElementById("errordescription").style.display="block";
       }
       else if($price =="" )
       {
           document.getElementById("errorqty").style.display="block";
       }
       else if( $qty =="" )
       {
           document.getElementById("errorprice").style.display="block";
       }
       else if(isNaN($price))
       {
           document.getElementById("errorpricenotnumber").style.display="block";
       }
       else if(isNaN($qty))
       {
           document.getElementById("errorqtynotnumber").style.display="block";
       }
       else
       {
           
       
       $('ul.setup-panel li:eq(1)').removeClass('disabled');
       $('ul.setup-panel li a[href="#step-2"]').trigger('click');
       
  
            $.post('http://kstoretesting.net16.net/new_ad_post/adPost/', {title: $title,location: $loc, description: $description, price: $price, categoryid: $categoryid, isnegotiable:$isnegotiable, qty:$qty ,values:$aaa },
            function(data)
            {
               
			
            });
            confirmm();
    }
    }
    
    function toggleStatus()
    {
          if (! document.getElementById("toggleElement").checked) 
          {
             $('#Coupen :input').attr('disabled', true);
          }
          else 
          {
            $('#Coupen :input').removeAttr('disabled');
          }  
    }
    
    function confirmm()
    {
        $.ajax({
        url: "http://kstoretesting.net16.net/new_ad_post/genarateLink",
        type: 'POST',
        dataType: "HTML",
        success: function(data) 
        {
            if (data) 
            {
                
                $('#finalad').html(data);
                

            }
        }

    });
    }

    
    


        </script>
    </head>
    <body class="body-custom">
            

        
        <div class="container cont-gal-cust">
            
       
        
        <!--<div class="container">-->
	<div class="row form-group">
        <div class="col-xs-12">
            <ul class="nav nav-pills nav-justified thumbnail setup-panel">
            
                <li class="active"><a href="#step-1">
                    <h4 class="list-group-item-heading">Step 1</h4>
                    <p class="list-group-item-text">Fill In Details</p>
                </a></li>
                
                <li class="disabled"><a href="#step-2">
                    <h4 class="list-group-item-heading">Step 2</h4>
                    <p class="list-group-item-text">Advance Details</p>
                </a></li>
                
                <li class="disabled"><a href="#step-3">
                    <h4 class="list-group-item-heading">Step 3</h4>
                    <p class="list-group-item-text">Confirmation</p>
                </a></li>
                
            </ul>
        </div>
	</div>
    
    <div class="row setup-content" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12 well text-center">
                <div>
                    
                    
                 
                    
                    <img src="<?php echo base_url("/images/adcat.png"); ?>" hight="60px" width="1000px"/>
                    <div style="border-bottom: 1px #dbd1d1 solid ;border-right:1px #dbd1d1 solid ;border-left:1px #dbd1d1 solid ;width: 969px; margin-left: 56px;margin-top: -50px; padding-bottom: 40px;">
                        <div class="form-group">
                            <select  class="input-group" id="ChoosemainCategory" onchange="checkSubCat(this.value)"  name="category" style="margin-left: 68px;width: 500px; margin-top: 10px; margin-bottom: 20px; padding-top: 4px; border-top-width: 1px; top: 20px;" >
                         <option value="select">Select a Category...</option>
			<?php
                        if (isset($cat)) {                         
                            foreach ($cat as $row){
                                
                                
                                $catid = $row->categoryid;
                                $catname = $row->categoryname;
                                $cattype=$row->parentcategory;
                               
                                 
                                if($cattype==0)
                                {
                               ?>
                                 <optgroup label="<?php echo $catname ?>">
                                     
                               <?php
                                    foreach ($cat as $row2)
                                    {
                                        $catid2 = $row2->categoryid;
                                        $catname2 = $row2->categoryname;
                                        $cattype2 = $row2->parentcategory;
                                        $isendnode=$row2->isendnode;
                                        if($catid==$cattype2)
                                        {
                                      ?>
                                     <option  value="<?php echo $catid2." ".$isendnode ?>"><?php echo $catname2 ?></option>
                                     
                                     <?php
                                        }
                                    }
                                }
                            }
                        }
                        
                       
                        ?>
                                 </optgroup>	

			</select>
                        </div>
                        <div class="form-group" id="subcategorydiv">
                            <img src="<?php echo APPPATH.'../images/ajax-loader.gif'?>" id="loading-img1" style="margin-left: 5px; position: absolute; left: 400px; margin-top: 10px;" alt="Please Wait"/>
                        </div>
                        
                        <div class="form-group" id="subsubcategorydiv">
                            <img src="<?php echo APPPATH.'../images/ajax-loader.gif'?>" id="loading-img11" style="margin-left: 5px; position: absolute; left: 400px; margin-top: 10px;" alt="Please Wait"/>
                        </div>
                    </div>
                    
                    <img src="<?php echo base_url("/images/newAD2.png"); ?>" hight="155px" width="1000px"/>
                    <div style="border-bottom: 1px #dbd1d1 solid ;border-right:1px #dbd1d1 solid ;border-left:1px #dbd1d1 solid ;width: 969px; margin-left: 56px;margin-top: -50px; ">
           
                        
                        
                        <div id="CategoryField" style="padding-top: 40px;text-align: right;">
                           
                        </div>
                        
             
                    </div>
                    
                    <img src="<?php echo base_url("/images/newAD3.png"); ?>" hight="155px" width="1000px"/>
                    <div style="border-bottom: 1px #dbd1d1 solid ;border-right:1px #dbd1d1 solid ;border-left:1px #dbd1d1 solid ;width: 969px; margin-left: 56px;margin-top: -50px; padding-bottom: 40px; margin-bottom: 30px; padding-top: 40px">
                        

                        
                        <div class="row">
                         <div id="outputimg">
                                            
                                    
                         </div>    
                       <div id="img11" class="col-md-3" style="width: 150px; height: 150px; border: 1px #dbd1d1 solid; margin-left: 68px; ">
                            
                            <img style="margin-top: 20px;" src="<?php echo base_url("/images/upload.png"); ?>" hight="97px" width="155px"/>
                            <input type="button"  id="submit-btn1" value="upload image" class="btn" style="border-color: #dbd1d1; margin-top: 8px;color: #B19195;" />
                        </div>
         
                        <div id="img12" class="col-md-3" style="width: 150px; height: 150px; border: 1px #dbd1d1 solid; margin-left: 40px; ">
                            
                            <img style="margin-top: 20px;" src="<?php echo base_url("/images/upload.png"); ?>" hight="97px" width="155px"/>
                            <input type="button"  id="submit-btn2" value="upload image" class="btn" style="border-color: #dbd1d1; margin-top: 8px;color: #B19195;" />
                        </div>
                            
                        <div id="img13" class="col-md-3" style="width: 150px; height: 150px; border: 1px #dbd1d1 solid; margin-left: 40px; ">
                            
                            <img style="margin-top: 20px;" src="<?php echo base_url("/images/upload.png"); ?>" hight="97px" width="155px"/>
                            <input type="button"  id="submit-btn3" value="upload image" class="btn" style="border-color: #dbd1d1; margin-top: 8px;color: #B19195;" />
                        </div>
                            
                            
                                 <div id="img14" class="col-md-3" style="width: 150px; height: 150px; border: 1px #dbd1d1 solid; margin-left: 40px; ">
                            
                            <img style="margin-top: 20px;" src="<?php echo base_url("/images/upload.png"); ?>" hight="97px" width="155px"/>
                            <input type="button"  id="submit-btn4" value="upload image" class="btn" style="border-color: #dbd1d1; margin-top: 8px;color: #B19195;" />
                        </div>
                             
                               

                            
                        </div>
                         
                    </div>
                    
                      
                    
                </div>
                <?php 
               
                  $this->load->library('session');
                  
                  if($this->session->userdata['newcount']!=0)
                  {
                    $newcount = $this->session->userdata['newcount'];
                  }
                  else
                  {
                      $newcount=0;
                  }
                   
                ?>
               
                <button  id="activate-step-2" class="btn btn-primary btn-lg" onclick="submitAd(<?php echo $newcount;?> )">Next</button>
                
            </div>
        </div>
    </div>
    
    
    <div class="row setup-content" id="step-2">
        <div class="col-xs-12">
            <div class="col-md-12 well text-center">
                <div>
                    <img src="<?php echo base_url("/images/newAD4.png"); ?>" hight="60px" width="1000px"/>
                    <div style="border-bottom: 1px #dbd1d1 solid ;border-right:1px #dbd1d1 solid ;border-left:1px #dbd1d1 solid ;width: 969px; margin-left: 56px;margin-top: -50px; margin-bottom: 20px">
                        
                        <div class="form-group"  style="padding-top: 30px;">
                            <label>Check this to add Coupons</label> 
                            
                             <input id="toggleElement" type="checkbox" name="toggle" onchange="toggleStatus()" style="margin-left: 10px;" />
                                   
                            
                        </div>
                      
                       
                       
                        <div id="Coupen" style="text-align: right;">
                           <div class="form-group">
                            <label class="col-sm-2 control-label">Coupon Code</label> 
                            <div   class="input-group">
                                <input  style="width: 400px;" type="text" id="couponcodeinput"   class="form-control input-sm" > 
                                   <label id="errorcouponcode" style="color: red">
                                    Please fill the Coupon Code !
                                    </label>
                            </div>
                        </div>
                      
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Discount</label> 
                            <div class="input-group"  style="width: 10px;">
                               
                                <input type="text" id="discountinput"   class="form-control input-sm"  style="width: 50px;">
                                <span class="input-group-addon"> % </span>
                                   <label id="errordiscountinput" style="color: red">
                                    Please fill the Discount !
                                    </label>
                                
                                <label id="errordiscountinput2" style="color: red">
                                Please fill the Discount !
                                </label>
                            </div>
                            <p style="color: #BB8080; width: 400px; margin-left: 148px; ">How many discount Percent for this item. example : 20% Discount</p>
                        </div>
                            
                            
                            <div class="form-group">
                            <label class="col-sm-2 control-label">Valid Until</label> 
                            <div class="input-group">
                                  <input type="date" class="form-control" id="expdateinput" >
                                     <label id="errorvaliduntil" style="color: red">
                  Please fill the valid days !
                  </label>
                            </div>
                        </div>
                        
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Number of Coupon</label> 
                            <div class="input-group"><input type="text" id="numberofcouponinput"   class="form-control input-sm"> 
                               <label id="errornumberofcouponinput" style="color: red">
                                Please fill the Number of Coupon !
                                </label>
                                
                                 <label id="errornumberofcouponinput2" style="color: red">
                                Please fill the Number of Coupon !
                                </label>
                            </div>
                        </div>
   
                        </div>
                    
                        
                        
                        
                    </div>
                    
                     
                    
                    
                    
                    
                </div>              
                <button id="back-step-1" class="btn btn-primary btn-lg">Back</button>
                <button id="activate-step-3" onclick="submitCoupon()" class="btn btn-primary btn-lg">Next</button>
            </div>
        </div>
    </div>
    
    
    <div class="row setup-content" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12 well text-center">
                
                <img src="<?php echo base_url("/images/newAD5.png"); ?>" hight="60px" width="1000px"/>
                <div style="border-bottom: 1px #dbd1d1 solid ;border-right:1px #dbd1d1 solid ;border-left:1px #dbd1d1 solid ;width: 969px; margin-left: 56px;margin-top: -50px; padding-bottom: 40px; margin-bottom: 10px;">
                    <div id="finalad" style="padding-top: 40px; padding-bottom: 10px;">
                        
                    </div>
                    
                    
                    
                </div>
            
                <button id="back-step-2" class="btn btn-primary btn-lg">Back</button>
                <a id="activate-step-4" class="btn btn-primary btn-lg" href="<?php echo base_url(); ?>">Confirm</a>
            </div>
        </div>
    </div>

     
    
</div>
        <!--</div>-->
        
     <div id="uploadModel" >
         <div id="upupupup1" style="width: 500px;height: 300px;background-color: #f7f7f7;border: solid #BB8080 5px">
             
         <h2  style="padding-left: 65px; margin-bottom: 30px;color: #99A5BE" >Please Upload your image</h2>
     
<span style="margin-left: 40px;">Image Type allowed: Jpeg, Jpg, Png and Gif. | Maximum Size 1 MB</span>
<form action="<?php echo base_url(); ?>new_upload/newupup" onSubmit="return false" method="post" enctype="multipart/form-data" id="MyUploadForm1">
    
        
    <table>
        <tr>
            <td>
               <input name="ImageFile" id="imageInput1" type="file" style="color: #7B86D8; background-color: #D6DDD6 ; margin-left: 40px;"/>              
            </td>
            <td>
             <input type="submit"  id="submit-btn11" value="Upload" style="background-color: #6FA7D1; margin-left: 5px "/>                       
            </td>
            <td>
              <img src="<?php echo APPPATH.'../images/ajax-loader.gif'?>" id="loading-img1" style="display:none; margin-left:5px  " alt="Please Wait"/>              
            </td>
        </tr>              
    </table>


    
</form>
<div id="progressbox" style="display:none; margin-left: 45px;"><div id="progressbar"></div ><div id="statustxt">0%</div></div>
<div id="output">
                
</div>
             
         </div>
         <button style="margin-left: 420px;" id="closemodal1" class="btn btn-primary btn-lg">close</button>         
    </div>
        

    </body>
</html> 