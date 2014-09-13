         
function add_to_wishlist(loggedin,user_id){
    if(loggedin==true){
        var adid="<?php echo $ad_info['adid']; ?>";
        var userid=user_id;
        var data={
            ad:adid,
            user:userid
        }
        $.ajax({
            url: "<?php echo base_url(); ?>/my_wishlist/add_to_wishlist",
            type: 'POST',
            data: {
                adsArray : data
            },
            success: function(data) 
            {
                //alert("Item added to your wishlist");
                if (data) 
                {
                alert(data);
                }
            }
        }
        );  
    }else if(loggedin==false){
       alert("Please login before adding items to wishlist");
    }    
}


