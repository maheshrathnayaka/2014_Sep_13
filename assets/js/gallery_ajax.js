function refresh_page()
{
    //price
    var priceFrom = document.getElementById('pricefrom').value;
    var priceTo = document.getElementById('priceto').value;
    
    if (priceFrom) {
        if(isNaN(priceFrom)){
            document.getElementById("label_price_f").style.display="block";//none
        }else if(0>priceFrom){ 
            document.getElementById("label_price_f").style.display="block";//none
        }else{
            document.getElementById("label_price_f").style.display="none";
        }
    }else{
        document.getElementById("label_price_f").style.display="none";
    }
    
    if (priceTo) {
        if(isNaN(priceTo)){
            document.getElementById("label_price_t").style.display="block";//none
        }else if(0>priceFrom){ 
            document.getElementById("label_price_t").style.display="block";//none
        }else{
            document.getElementById("label_price_t").style.display="none";
        }
    }else{
        document.getElementById("label_price_t").style.display="none";
    }
    
    var price={
        from:priceFrom, 
        to:priceTo
    };
    //seller
    var allSellers=document.getElementById("asellers").checked;
    var verifiedSellers=document.getElementById("vsellers").checked;          
    var sellers={
        all:allSellers, 
        verified:verifiedSellers 
    };
    
    //location   
    var dropdownLocCity = document.getElementById("locname");
    var dropdownLocType = document.getElementById("loctype");
    
    var locCity='';
    var locType='';
    
    if(dropdownLocCity.options[dropdownLocCity.selectedIndex].value!=0){
        locCity= dropdownLocCity.options[dropdownLocCity.selectedIndex].text;
    }
    if(dropdownLocType.options[dropdownLocType.selectedIndex].value!='locany'){
        locType= dropdownLocType.options[dropdownLocType.selectedIndex].value;
    }
    var location={
        city:locCity,
        type:locType
    };
    
    var category="<?php echo $_GET['catid']; ?>";
    
    //    var keyword=document.getElementById('search1').value;  
    //    var keywd={
    //        key:keyword
    //    };
    
    var key='';
    "<?php if (isset($_GET['keyword']) && !empty($_GET['keyword'])) { ?>"
    var key="<?php echo $_GET['keyword']; ?>";
    "<?php } ?>"
    
    //attribute values
    var value_list="";
    "<?php if (isset($multi_attr) && !empty($multi_attr)) { ?>"
    "<?php foreach ($multi_attr as $attr) { ?>" 
    "<?php if (isset(${'attr_' . $attr['attributeid']}) && !empty(${'attr_' . $attr['attributeid']})) { ?>" 
    var att_selected=false;
    "<?php foreach (${'attr_' . $attr['attributeid']} as $value) { ?>" 
    var radio_id="<?php echo $value['valueid']; ?>";
    var radio_ischecked= document.getElementById(radio_id).checked;
    if(radio_ischecked==true){
        if(att_selected==false){
            value_list+="<?php echo $attr['attributeid'].'-'.$value['valueid']; ?>";
            att_selected=true;
        }else{
            value_list+="<?php echo ','.$value['valueid']; ?>";
        }
    }
    "<?php } ?>"
    value_list+=" ";
    "<?php } ?>"
    "<?php } ?>"
    "<?php } ?>"    
    value_list=value_list.trim();
    //alert("'"+"<?php echo $_GET['catid']; ?>"+"'");
    
    refresh_locations(locType);
    $.ajax({
        url: "<?php echo base_url(); ?>/browse_gallery/filter_by_values",
        type: 'POST',
        data: {
            priceArray: price,
            sellerArray: sellers,
            locationArray: location,
            attributesArray: value_list,
            keyword: key,
            cat_id:category
        },
        success: function(data) 
        {
            if (data) 
            {
                $('#div_gallery').html(data);
            }
        }
    }
    );    
}

function refresh_locations(locType)
{
    //alert(locType);
    
    $.ajax({
        url: "<?php echo base_url(); ?>/browse_gallery/load_locations",
        type: 'POST',
        data: {
            location: locType
        },
        success: function(data) 
        {
            if (data) 
            {
                $('#div_city').html(data);
            }
        }
    }
    );
}

function refresh_wo_location()
{
    //price
    var priceFrom = document.getElementById('pricefrom').value;
    var priceTo = document.getElementById('priceto').value;
    
    if (priceFrom) {
        if(isNaN(priceFrom)){
            document.getElementById("label_price_f").style.display="block";//none
        }else if(0>priceFrom){ 
            document.getElementById("label_price_f").style.display="block";//none
        }else{
            document.getElementById("label_price_f").style.display="none";
        }
    }else{
        document.getElementById("label_price_f").style.display="none";
    }
    
    if (priceTo) {
        if(isNaN(priceTo)){
            document.getElementById("label_price_t").style.display="block";//none
        }else if(0>priceFrom){ 
            document.getElementById("label_price_t").style.display="block";//none
        }else{
            document.getElementById("label_price_t").style.display="none";
        }
    }else{
        document.getElementById("label_price_t").style.display="none";
    }
    
    var price={
        from:priceFrom, 
        to:priceTo
    };
    //seller
    var allSellers=document.getElementById("asellers").checked;
    var verifiedSellers=document.getElementById("vsellers").checked;          
    var sellers={
        all:allSellers, 
        verified:verifiedSellers 
    };
    
    //location   
    var dropdownLocCity = document.getElementById("locname");
    var dropdownLocType = document.getElementById("loctype");
    
    var locCity='';
    var locType='';
    
    if(dropdownLocCity.options[dropdownLocCity.selectedIndex].value!=0){
        locCity= dropdownLocCity.options[dropdownLocCity.selectedIndex].text;
    }
    if(dropdownLocType.options[dropdownLocType.selectedIndex].value!='locany'){
        locType= dropdownLocType.options[dropdownLocType.selectedIndex].value;
    }
    var location={
        city:locCity,
        type:locType
    };
    
    var category="<?php echo $_GET['catid']; ?>";
    
    var key='';
    "<?php if (isset($_GET['keyword']) && !empty($_GET['keyword'])) { ?>"
    var key="<?php echo $_GET['keyword']; ?>";
    "<?php } ?>"

    //    var keyword=document.getElementById('search1').value;
    //    var keywd={
    //        key:keyword
    //    };
    
    //attribute values
    var value_list="";
    "<?php if (isset($multi_attr) && !empty($multi_attr)) { ?>"
    "<?php foreach ($multi_attr as $attr) { ?>" 
    "<?php if (isset(${'attr_' . $attr['attributeid']}) && !empty(${'attr_' . $attr['attributeid']})) { ?>" 
    var att_selected=false;
    "<?php foreach (${'attr_' . $attr['attributeid']} as $value) { ?>" 
    var radio_id="<?php echo $value['valueid']; ?>";
    var radio_ischecked= document.getElementById(radio_id).checked;
    if(radio_ischecked==true){
        if(att_selected==false){
            value_list+="<?php echo $attr['attributeid'].'-'.$value['valueid']; ?>";
            att_selected=true;
        }else{
            value_list+="<?php echo ','.$value['valueid']; ?>";
        }
    }
    "<?php } ?>"
    value_list+=" ";
    "<?php } ?>"
    "<?php } ?>"
    "<?php } ?>"    
    value_list=value_list.trim();
    //alert("'"+"<?php echo $_GET['catid']; ?>"+"'");
    
    $.ajax({
        url: "<?php echo base_url(); ?>/browse_gallery/filter_by_values",
        type: 'POST',
        data: {
            priceArray: price,
            sellerArray: sellers,
            locationArray: location,
            attributesArray: value_list,
            keyword: key,
            cat_id:category
        },
        success: function(data) 
        {
            if (data) 
            {
                $('#div_gallery').html(data);
            }
        }
    }
    );    
}

function refresh_page_with_all_locs()
{
    document.getElementById("locname").selectedIndex = "0";
    
    //price
    var priceFrom = document.getElementById('pricefrom').value;
    var priceTo = document.getElementById('priceto').value;
    
    if (priceFrom) {
        if(isNaN(priceFrom)){
            document.getElementById("label_price_f").style.display="block";//none
        }else if(0>priceFrom){ 
            document.getElementById("label_price_f").style.display="block";//none
        }else{
            document.getElementById("label_price_f").style.display="none";
        }
    }else{
        document.getElementById("label_price_f").style.display="none";
    }
    
    if (priceTo) {
        if(isNaN(priceTo)){
            document.getElementById("label_price_t").style.display="block";//none
        }else if(0>priceFrom){ 
            document.getElementById("label_price_t").style.display="block";//none
        }else{
            document.getElementById("label_price_t").style.display="none";
        }
    }else{
        document.getElementById("label_price_t").style.display="none";
    }
    
    var price={
        from:priceFrom, 
        to:priceTo
    };
    //seller
    var allSellers=document.getElementById("asellers").checked;
    var verifiedSellers=document.getElementById("vsellers").checked;          
    var sellers={
        all:allSellers, 
        verified:verifiedSellers 
    };
    
    //location   
    var dropdownLocCity = document.getElementById("locname");
    var dropdownLocType = document.getElementById("loctype");
    
    var locCity='';
    var locType='';
    
    if(dropdownLocCity.options[dropdownLocCity.selectedIndex].value!=0){
        locCity= dropdownLocCity.options[dropdownLocCity.selectedIndex].text;
    }
    if(dropdownLocType.options[dropdownLocType.selectedIndex].value!='locany'){
        locType= dropdownLocType.options[dropdownLocType.selectedIndex].value;
    }
    
    var location={
        city:locCity,
        type:locType
    };
    
    var category="<?php echo $_GET['catid']; ?>";
 
    var key='';
    "<?php if (isset($_GET['keyword']) && !empty($_GET['keyword'])) { ?>"
    var key="<?php echo $_GET['keyword']; ?>";
    "<?php } ?>"
    
    //    var keyword=document.getElementById('search1').value;
    //    var keywd={
    //        key:keyword
    //    };
    
    //attribute values
    var value_list="";
    "<?php if (isset($multi_attr) && !empty($multi_attr)) { ?>"
    "<?php foreach ($multi_attr as $attr) { ?>" 
    "<?php if (isset(${'attr_' . $attr['attributeid']}) && !empty(${'attr_' . $attr['attributeid']})) { ?>" 
    var att_selected=false;
    "<?php foreach (${'attr_' . $attr['attributeid']} as $value) { ?>" 
    var radio_id="<?php echo $value['valueid']; ?>";
    var radio_ischecked= document.getElementById(radio_id).checked;
    if(radio_ischecked==true){
        if(att_selected==false){
            value_list+="<?php echo $attr['attributeid'].'-'.$value['valueid']; ?>";
            att_selected=true;
        }else{
            value_list+="<?php echo ','.$value['valueid']; ?>";
        }
    }
    "<?php } ?>"
    value_list+=" ";
    "<?php } ?>"
    "<?php } ?>"
    "<?php } ?>"    
    value_list=value_list.trim();
    //alert("'"+"<?php echo $_GET['catid']; ?>"+"'");
    
    refresh_locations(locType);
    $.ajax({
        url: "<?php echo base_url(); ?>/browse_gallery/filter_by_values",
        type: 'POST',
        data: {
            priceArray: price,
            sellerArray: sellers,
            locationArray: location,
            attributesArray: value_list,
            keyword: key,
            cat_id: category
        },
        success: function(data) 
        {
            if (data) 
            {
                $('#div_gallery').html(data);
            }
        }
    }
    );    
}