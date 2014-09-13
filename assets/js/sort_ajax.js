
function sort_low(){
    
    var ads=new Array();
    var count=0;
    "<?php if(isset($ads)){ ?>"
    "<?php foreach($ads as $ad) { ?>"           
    ads[count]="<?php echo $ad['adid']; ?>";
    count++;
    "<?php } ?>"
    "<?php } ?>"
    
    $.ajax({
        url: "<?php echo base_url(); ?>/browse_gallery/sort_low",
        type: 'POST',
        data: {
            adsArray : ads
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
//alert(orderby);
}

function sort_high(){
    
    var ads=new Array();
    var count=0;
    "<?php if(isset($ads)){ ?>"
    "<?php foreach($ads as $ad) { ?>"           
    ads[count]="<?php echo $ad['adid']; ?>";
    count++;
    "<?php } ?>"
    "<?php } ?>"
    
    $.ajax({
        url: "<?php echo base_url(); ?>/browse_gallery/sort_high",
        type: 'POST',
        data: {
            adsArray : ads
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
//alert(orderby);
}

function sort_recent(){
    
    var ads=new Array();
    var count=0;
    "<?php if(isset($ads)){ ?>"
    "<?php foreach($ads as $ad) { ?>"           
    ads[count]="<?php echo $ad['adid']; ?>";
    count++;
    "<?php } ?>"
    "<?php } ?>"
    
    $.ajax({
        url: "<?php echo base_url(); ?>/browse_gallery/sort_recent",
        type: 'POST',
        data: {
            adsArray : ads
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
//alert(orderby);
}