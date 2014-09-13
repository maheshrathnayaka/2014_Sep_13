//$('#btnSendMsg').click(function () {
//    var btn = $(this)
//    btn.button('loading')
//    $.ajax().always(function () {
//      btn.button('reset')
//    });
//  });

function ajax_refresh() {
    var subject = document.getElementById('inputSubject').value;
    var msg = document.getElementById('inputMessage').value;
    var sender = "<?php echo $this->session->userdata['logged_in']['email']; ?>";
    var user_id = "<?php echo $_GET['userid']; ?>"
    var msg_data = {
        sub: subject,
        msg: msg,
        sender: sender,
        user_id: user_id
    };
    if (subject != "" || msg != "") {
        $.ajax({
            url: "<?php echo base_url(); ?>my_messages/send_message",
            type: 'POST',
            data: {
                msgArray: msg_data
            },
            success: function()
            {
                $('#contactSeller').modal('hide');
            }
        }
        );
    } else {
         $('#alertBox').show();
    }
}