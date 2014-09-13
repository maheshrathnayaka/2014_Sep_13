function move_to_trash_inbox() {
//    var count = document.getElementById('allRowCountInbox').value;
//    for (i = 0; i < count; i++) {
//        var id = "msg"+i;
//        if(document.getElementById(id).value == 0){
//            alert('hi');
//        }
//    }
    var msgCount = document.getElementById('row_count_inbox').value;
    for (i = 0; i < msgCount; i++) {
        if (document.getElementsByName('msg_checkbox').checked) {
            alert('h');
        }
    }
}

function move_to_trash_sent() {
    var msgCount = document.getElementById('row_count_sent').value;
    for (i = 0; i < msgCount; i++) {
        var ch=document.getElementsByName('msg_checkbox_sent[i]').checked; 
//        if () 
//            alert('h');
//        }
    }
}
