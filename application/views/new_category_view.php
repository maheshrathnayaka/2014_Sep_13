    <script>
                  
         $(document).ready(function() {
                
        document.getElementById("errortitle").style.display="none";
        document.getElementById("errordescription").style.display="none";
        document.getElementById("errorqty").style.display="none";
        document.getElementById("errorprice").style.display="none";
        document.getElementById("errorqtynotnumber").style.display="none";
        document.getElementById("errorpricenotnumber").style.display="none";
        
   
});

    function submitAd()
    {
        
        
        var $fieldsValues=[];
        
        <?php
     if(isset($catFields)) {
        $countnew=0;
        foreach ($catFields as $row){                 
           $attributeid = $row->attributeid; ?>

          $fieldsValues[<?php echo $countnew;?>] = $('#'+ <?php echo $attributeid;?> ).val();     

       <?php $countnew++;
        }
        if($countnew==0)
        {
       ?>
            
         $fieldsValues[0] = 0;   
            
        <?php
        }    
       }?>
            
    var $isnegotiable=0;
    if(document.getElementById("isnegotiable").checked)
    {
        $isnegotiable=1;
    }
        
       var $loc=$('#location').val();
       var $title=$('input#title').val();
       var $description=$('#description').val();
       var $price=$('input#price').val();
       var $categoryid=$cat;    
       var $qty=$('input#qty').val();
       
       document.getElementById("noOfCoupen").innerHTML = "(max is "+$qty+")";
       
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
       
  
            $.post('http://kstoretesting.net16.net/new_ad_post/adPost/', {title: $title,location: $loc, description: $description, price: $price, categoryid: $categoryid, isnegotiable:$isnegotiable, qty:$qty ,values:$fieldsValues},
            function(data)
            {
               		 	
            });
            confirmm();
    }
    }
            
            
            
            
    </script>
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
              foreach ($catFields as $row)
              {
                  
                $attributeid = $row->attributeid;
                $attributename = $row->attributename;
                $htmlcomponent = $row->htmlcomponent;
                
                if($htmlcomponent == "Text Field")
                {
                 
        ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $attributename ?></label> 
                                <div class="input-group"><input type="text" id="<?php echo $attributeid ?>"   class="form-control input-sm" > </div>
                                
                            </div>
        
        
        <?php
                }
                else if($htmlcomponent=="Drop Down")
                {
                     
                    ?>
                        
                    <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $attributename ?></label>
                                    <select class="input-group" id="<?php echo $attributeid ?>">
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