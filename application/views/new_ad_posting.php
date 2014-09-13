<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="See Moreport" content="width=device-width, initial-scale=1.0">
        <title>AD Post</title>

        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>
        
        <style>
            <?php require_once(APPPATH . 'assets/css/style1.css'); ?>
        </style>
        
        <script>
            <?php
            require_once(APPPATH . 'assets/js/jquery.easyModal.js');
            require_once(APPPATH . 'assets/js/newUpload.js');
            require_once(APPPATH . 'assets/js/jquery.form.min.js');
            ?>
        </script>
        
        <script>
            
        var clickdiv;
        
        $(document).ready(function() {

        document.getElementById("loading-img1").style.display="none";
        document.getElementById("loading-img11").style.display="none";
        document.getElementById("loading-img12").style.display="none";
        
        var date=new Date();
        
        var day=date.getDate()+1;
        var month=date.getMonth()+1;
        var year=date.getFullYear();
        
        var today= year+"-0"+month+"-"+day;
        
        document.getElementById("expdateinput").setAttribute("min", today);
        
        
        $('#Coupen :input').attr('disabled', true);
         
     
        
        
        
        //////////////////////////////
         $('#uploadModel').easyModal({
		
		top : 50,
		overlayColor: "#333",
		overlayClose: false,
		closeOnEscape: false
                
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

    function closemodle()
    {
         document.getElementById("progressbox").style.display="none";
         document.getElementById("output").style.display="none";        
         $('#uploadModel').trigger('closeModal');        
    }

    // for open model
    function imgDiv1click()
    {
        $('#uploadModel').trigger('openModal');
    }
    function imgDiv2click()
    {
        $('#uploadModel').trigger('openModal');
    }
    function imgDiv3click()
    {
        $('#uploadModel').trigger('openModal');
    }
    function imgDiv4click()
    {
        $('#uploadModel').trigger('openModal');
    }
    //

    function checklastSubCat(value){
    
        document.getElementById("CategoryField").innerHTML = "";
        
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
                
                $('#subcategorydiv').append(data);

            }
        }

    });
    }
    }

    
    function checkSubSubCat(value){
              
         document.getElementById("CategoryField").innerHTML = "";
            
        var split = value.split(" "); 
        var $oldcategory = split[0];
        var $oldendnode = split[1];
        
        var $category = $oldcategory.trim();
        var $endnode = $oldendnode.trim();
        
       if($endnode != 0)
       {
           document.getElementById("subsubcategorydiv").innerHTML = "";
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
                
                $('#subsubcategorydiv').append(data);

            }
        }

    });
    }
    }


    function checkSubCat(value)  {
     
        document.getElementById("CategoryField").innerHTML = "";
        
        
        
        var split = value.split(" "); 
        var $oldcategory = split[0];
        var $oldendnode = split[1];
        
        var $category = $oldcategory.trim();
        var $endnode = $oldendnode.trim();
        
       if($endnode != 0)
       {
            document.getElementById("subsubcategorydiv").innerHTML = "";
             document.getElementById("subcategorydiv").innerHTML = "";
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
                
                $('#subcategorydiv').append(data);

            }
        }

    });
    }
    }

    var $cat;
    function generateDiv(value)
    {
        document.getElementById("CategoryField").innerHTML = "";
        
        $cat=value;
        var $category = value;
        $.ajax({
        url: "http://kstoretesting.net16.net/new_ad_post/getfields/" + $category,
        type: 'POST',
        dataType: "HTML",
        success: function(data) 
        {
            if (data) 
            {
                
                $('#CategoryField').append(data);
                

            }
        }

    });
        
    }
    
 
    function submitCoupon()
    {
        
        
        var $coupenCode=$('input#couponcodeinput').val();
        var $expdate=$('input#expdateinput').val();
        var $percentage=$('input#discountinput').val();
        var $noofcoupons=$('input#numberofcouponinput').val();
        var $qty=$('input#qty').val();
     
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
       else if($expdate =="")
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
       else if($noofcoupons > $qty)
       {
           document.getElementById("errorNoofCoupen").style.display="block";
       }
       else
       {
      
             $('ul.setup-panel li:eq(2)').removeClass('disabled');
             $('ul.setup-panel li a[href="#step-3"]').trigger('click');
     
            $.post('http://kstoretesting.net16.net/new_ad_post/adCoupon/', {coupencode: $coupenCode,expdate: $expdate,percentage :$percentage , noofcoupons: $noofcoupons},
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
    
    function removeImage(id)
    {   
        var clickdiv = document.getElementById(id).parentNode.id;
        all=id+"~"+clickdiv;
        alert(all);
        
        var clickdivid = "#"+clickdiv;
        
        $.ajax({
        url: "http://kstoretesting.net16.net/new_upload/removeImage/"+all,
        type: 'POST',
        dataType: "HTML",
        success: function(data) 
        {
            if (data) 
            {

                $(clickdivid).html(data);  
                
            }
        }
    });
    
    }
    
    </script>

    </head>

    <body class="body-custom">
        <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?>
        
        
        <div class="container cont-cust">
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
                    
                    <img src="<?php echo base_url("/images/adcat.png"); ?>" hight="60px" width="1000px"/>
                    <div style="border-bottom: 1px #dbd1d1 solid ;border-right:1px #dbd1d1 solid ;border-left:1px #dbd1d1 solid ;width: 969px; margin-left: 81px;margin-top: -50px; padding-bottom: 40px;">
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
                            <img src="<?php echo APPPATH.'../images/ajax-loader.gif'?>" id="loading-img11" style="margin-left: 5px; position: absolute; left: 400px; margin-top: 10px;" alt="Please Wait"/>
                        </div>
                        
                        <div class="form-group" id="subsubcategorydiv">
                            <img src="<?php echo APPPATH.'../images/ajax-loader.gif'?>" id="loading-img12" style="margin-left: 5px; position: absolute; left: 400px; margin-top: 10px;" alt="Please Wait"/>
                        </div>
                    </div>
                    
                    <img src="<?php echo base_url("/images/newAD2.png"); ?>" hight="155px" width="1000px"/>
                    <div style="border-bottom: 1px #dbd1d1 solid ;border-right:1px #dbd1d1 solid ;border-left:1px #dbd1d1 solid ;width: 969px; margin-left: 81px;margin-top: -50px; ">
           
                        
                        
                        <div id="CategoryField" style="padding-top: 40px;text-align: right;">
                           
                        </div>
                        
             
                    </div>
                    
                    <img src="<?php echo base_url("/images/newAD3.png"); ?>" hight="155px" width="1000px"/>
                    <div style="border-bottom: 1px #dbd1d1 solid ;border-right:1px #dbd1d1 solid ;border-left:1px #dbd1d1 solid ;width: 969px; margin-left: 81px;margin-top: -50px; padding-bottom: 40px; margin-bottom: 30px; padding-top: 40px">
                        

                        
                        <div class="row">
                         <div id="outputimg">
                             
                         </div>    
                       <div id="img11" class="col-md-3" style="width: 190px; height: 150px; border: 1px #dbd1d1 solid; margin-left: 68px; ">
                            
                            <img style="margin-top: 20px;" src="<?php echo base_url("/images/upload.png"); ?>" hight="97px" width="155px"/>
                            <input type="button" onclick="imgDiv1click()"  id="submit-btn1" value="upload image" class="btn" style="border-color: #dbd1d1; margin-top: 8px;color: #B19195;" />
                        </div>
                            
                        <div id="img12" class="col-md-3" style="width: 190px; height: 150px; border: 1px #dbd1d1 solid; margin-left: 40px; ">                           
                            <img style="margin-top: 20px;" src="<?php echo base_url("/images/upload.png"); ?>" hight="97px" width="155px"/>
                            <input type="button" onclick="imgDiv2click()" id="submit-btn2" value="upload image" class="btn" style="border-color: #dbd1d1; margin-top: 8px;color: #B19195;" />
                        </div>
                            
                        <div id="img13" class="col-md-3" style="width: 190px; height: 150px; border: 1px #dbd1d1 solid; margin-left: 40px; ">                            
                            <img style="margin-top: 20px;" src="<?php echo base_url("/images/upload.png"); ?>" hight="97px" width="155px"/>
                            <input type="button" onclick="imgDiv3click()" id="submit-btn3" value="upload image" class="btn" style="border-color: #dbd1d1; margin-top: 8px;color: #B19195;" />
                        </div>
                            
                            
                        <div id="img14" class="col-md-3" style="width: 190px; height: 150px; border: 1px #dbd1d1 solid; margin-left: 40px; ">                          
                            <img style="margin-top: 20px;" src="<?php echo base_url("/images/upload.png"); ?>" hight="97px" width="155px"/>
                            <input type="button" onclick="imgDiv4click()" id="submit-btn4" value="upload image" class="btn" style="border-color: #dbd1d1; margin-top: 8px;color: #B19195;" />
                        </div>
          

                             
                               

                            
                        </div>
                         
                    </div>
                                     
                  
                <button  id="activate-step-2" class="btn btn-primary btn-lg" onclick="submitAd()">Next</button>
                
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
                                   <label id="errorcouponcode" style="color: red; display: none;">
                                    Please fill the Coupon Code !
                                    </label>
                            </div>
                        </div>
                      
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Discount</label> 
                            <div class="input-group"  style="width: 10px;">
                               
                                <input type="text" id="discountinput"   class="form-control input-sm"  style="width: 50px;">
                                <span class="input-group-addon"> % </span>
                                   <label id="errordiscountinput" style="color: red;display: none;">
                                    Please fill the Discount !
                                    </label>
                                
                                <label id="errordiscountinput2" style="color: red; display: none;">
                                Please fill the Discount !
                                </label>
                            </div>
                            <p style="color: #BB8080; width: 400px; margin-left: 130px; ">How many discount Percent for this item.</P> 
                            <P style="color: #BB8080; width: 400px; margin-left: 130px; ">example : 20% Discount</p>
                        </div>
                            
                            
                            <div class="form-group">
                            <label class="col-sm-2 control-label">Valid Until</label> 
                            <div class="input-group">
                                <input type="date" class="form-control" id="expdateinput"  >
                                     <label id="errorvaliduntil" style="color: red; display: none;">
                  Please fill the valid days !
                  </label>
                            </div>
                        </div>
                        
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Number of Coupon</label> 
                            <div class="input-group"><input type="text" id="numberofcouponinput"   class="form-control input-sm">
                               <label id="noOfCoupen"> </label>
                               <label id="errornumberofcouponinput" style="color: red; display: none;">
                                Please fill the Number of Coupon !
                                </label>
                               <label id="errorNoofCoupen" style="color: red; display: none;">
                                Please fill the Number of Coupon Currently !
                                </label>
                                                       
                                 <label id="errornumberofcouponinput2" style="color: red;display: none;">
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
        
        <!--file upload -->
        <div id="uploadModel" >
            <div id="upupupup1" style="width: 500px;height: 300px;background-color: #f7f7f7;border: solid #BB8080 5px">
                <button style="margin-left: 419px;" id="closemodal1" onclick="closemodle()" class="btn btn-primary ">X close</button>
                <h2  style="padding-left: 65px; margin-bottom: 30px;color: #99A5BE" >Please Upload your image</h2>
     
                <span style="margin-left: 40px;">Image Type allowed: Jpeg, Jpg, Png and Gif. | Maximum Size 1 MB</span>
                <form action="<?php echo base_url(); ?>new_upload/uploadImage" onSubmit="return false" method="post" enctype="multipart/form-data" id="MyUploadForm1">


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
                <div id="progressbox" style="display:none; margin-left: 43px;">
                    <div id="progressbar">

                    </div >
                    <div id="statustxt">0%</div>

                </div>
                <div id="output" style="margin-left: 43px;">

                </div>
             
         </div>
            <!--<button style="margin-left: 420px;" id="closemodal1" class="btn btn-primary btn-lg">close</button>-->         
        </div>
        <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>

    </body>
</html>
