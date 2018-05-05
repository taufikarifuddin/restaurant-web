const SUBMIT_ORDER = "submit-order";
const SEND_BACK_TO_USER = "send-back-to-user";
const SUBMIT_TO_CHEF = "submit-to-chef";
const NOTIFY_PROGRESS ="notify-progress";

function noty(){
    new Noty({
        type: 'info',
        layout: 'topRight',
        text: "Testing 2",
        timeout: 5000,
        modal: true,
        progressBar : true,
        
      }).show();
}

$(function(){
    
    var server = $('meta[name="node-server"]').attr('content');
    var port = $('meta[name="node-port"]').attr('content');

    var socket = io(server + ':' +port);
    socket.emit(SUBMIT_ORDER,{ data : 'hehe'});
    
    socket.on(SUBMIT_ORDER, function(data) { 
        noty();
    });

    socket.on(SEND_BACK_TO_USER, function(data) { 

    });
    
    socket.on(SUBMIT_TO_CHEF, function(data) { 

    });

    socket.on(NOTIFY_PROGRESS,function(data){

    });
})