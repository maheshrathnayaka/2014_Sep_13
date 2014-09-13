function login_admin() {
    var email = document.getElementById('inputEmail').value;
    var password = document.getElementById('inputPassword').value;
    var log_data = {
        un: email,
        pw: password
    };
    if (email != "" || password != "") {
//        var request = 
                $.ajax({
            url: "<?php echo base_url(); ?>admin/verify_user",
            type: 'POST',
            data: {
                logArray: log_data
            }
//            ,
//            success: function()
//            {
////                $.ajax({
////                    url: "<?php echo base_url(); ?>admin/home",
////                    type: 'POST'
////                }
////                );
//                window.location = "<?php echo base_url(); ?>admin/home";
//            },
//            error: function() {
//                $('#loginAdminAlert').show();
//            }
        });
//        alert(request);
    } else {
        $('#loginAdminAlert').show();
    }

//    $.ajax( {
//        url : plugin.ajaxURl,
//        data : {
//            // other data
//        },
//    } )
//        .done( function( data ) {
//            // Handles successful responses only
//        } )
//        .fail( function( reason ) {
//            // Handles errors only
//            console.debug( reason );
//        } )
//        .always( function( data, textStatus, response ) {
//            // If you want to manually separate stuff
//            // response becomes errorThrown/reason OR jqXHR in case of success
//        } )
//        .then( function( data, textStatus, response ) {
//            // In case your working with a deferred.promise, use this method
//            // Again, you'll have to manually separates success/error
//        } );










}