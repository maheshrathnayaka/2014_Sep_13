<!DOCTYPE html>
<html lang="en">
    <head>
        
        <title>Category view</title>

        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>
        
        <script>
            <?php
            require_once(APPPATH . 'assets/js/jquery.easyModal.js');
            require_once(APPPATH . 'assets/js/newUpload.js');   
            ?>
        </script>
    

    <script>
                  
         $(document).ready(function() {
        
        
        document.getElementById("errortitle").style.display="none";
        document.getElementById("errordescription").style.display="none";
        document.getElementById("errorqty").style.display="none";
        document.getElementById("errorprice").style.display="none";
        document.getElementById("errorqtynotnumber").style.display="none";
        document.getElementById("errorpricenotnumber").style.display="none";
        
        
        
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
             
    
});
            

            
            
            
            
            
    </script>
    
 
    
    </head>
    <body>
        
        
         
             <div class="form-group">
                <label class="col-sm-2 control-label">Title</label> 
             <div class="input-group">
                 <input type="text" id="title" class="form-control input-sm" >
                 
                  <label id="errortitle" style="color: red">
                  Please fill the title !
                  </label>
             </div>
                
                
                
            </div>
        
        <?php            
            if (isset($catFields)) {
                
                $count1=0;
              foreach ($catFields as $row)
              {
                  
                $attributeid = $row->attributeid;
                $attributename = $row->attributename;
                $htmlcomponent = $row->htmlcomponent;
                $count1=$count1+1;
                
                if($htmlcomponent == "Text Field")
                {
                 
        ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $attributename ?></label> 
                                <div class="input-group"><input type="text" id="<?php echo $count1 ?>"   class="form-control input-sm" > </div>
                                
                            </div>
        
        
        <?php
                }
                else if($htmlcomponent=="Drop Down")
                {
                     
                    ?>
                        
                    <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $attributename ?></label>
                                    <select class="input-group" id="<?php echo $count1 ?>">
                                     <?php  
                                     
                                    if (isset($catselect)) {                          
                                    foreach ($catselect as $row2)
                                    { 
                                        
                                        $attributeid2 = $row2->attributeid;
                                        $dropdownvalues2 = $row2->dropdownvalues;
                                        $valueid2 = $row2->valueid;
                                        
                                        if($attributeid==$attributeid2)
                                        {
                                            
                                      ?>   
                                    <option value="<?php echo $valueid2 ?>"><?php echo $dropdownvalues2 ?></option>
                                    
                                    <?php
                                        }
                                    }
                                   }
                                    ?>
                                    </select>
                     </div>      
                    <?php
                }
                   
              }
              
            }
                          
            ?>
        
         <div class="form-group">
                                    <label class="col-sm-2 control-label">Description</label> 
                                    <div class="input-group"><textarea class="form-control" rows="4" id="description" name="description" style="width:400px" ></textarea> 
                                        
          <label id="errordescription" style="color: red" >
                 Please fill the description !
            </label> 
                                    </div>
         </div>
        
        <div class="form-group">
             <label class="col-sm-2 control-label">Quantity</label> 
             <div class="input-group"><input type="text" id="qty"   class="form-control input-sm" data-validation-required-message="Please enter a Value ." required>
             
            <label id="errorqty" style="color: red">
                 Please fill the Quantity !
            </label> 
                 
             <label id="errorqtynotnumber" style="color: red">
                 Please fill the Quantity with numerical value !
            </label>
             </div>
              
          
        </div>
        
        
         <div class="form-group">
             <label class="col-sm-2 control-label">Price</label> 
             <div class="input-group"><input type="text" id="price"   class="form-control input-sm" data-validation-required-message="Please enter a Value ." required>
             
            <label id="errorprice" style="color: red">
                 Please fill the price !
            </label>
                 
             <label id="errorpricenotnumber" style="color: red">
                 Please fill the price with numerical value !
            </label>
                 
             </div>        
        </div>
        
         <div class="form-group">
             <label class="col-sm-2 control-label">Location</label> 
             <div class="input-group">
                <select id="location">
                    <option value="">Select a location...</option>
                    <option value="Colombo">Colombo</option>
                    <option value="Kandy">Kandy</option>
                    <option value="Galle">Galle</option>
                    <option value="Ampara">Ampara</option>
                    <option value="Anuradhapura">Anuradhapura</option>
                    <option value="Badulla">Badulla</option>
                    <option value="Batticaloa">Batticaloa</option>
                    <option value="Gampaha">Gampaha</option>
                    <option value="Hambantota">Hambantota</option>
                    <option value="Jaffna">Jaffna</option>
                    <option value="Kalutara">Kalutara</option>
                    <option value="Kegalle">Kegalle</option>
                    <option value="Kilinochchi">Kilinochchi</option>
                    <option value="Kurunegala">Kurunegala</option>
                    <option value="Mannar">Mannar</option>
                    <option value="Matale">Matale</option>
                    <option value="Matara">Matara</option>
                    <option value="Moneragala">Moneragala</option>
                    <option value="Mullativu">Mullativu</option>
                    <option value="Nuwara Eliya">Nuwara Eliya</option>
                    <option value="Polonnaruwa">Polonnaruwa</option>
                    <option value="Puttalam">Puttalam</option>
                    <option value="Ratnapura">Ratnapura</option>
                    <option value="Trincomalee">Trincomalee</option>
                    <option value="Vavuniya">Vavuniya</option>
                </select>
             </div>        
        </div>
        
       <div class="form-group">
             <label class="col-sm-2 control-label">is negotiable</label> 
             <div class="input-group"><input type="checkbox" value="1" id="isnegotiable" style="margin-left: 2px" > </div>
             
          
        </div>
        <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>
    </body>
    
    
</html>