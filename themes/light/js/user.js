const SUBMIT_ORDER = "submit-order";
const SEND_BACK_TO_USER = "send-back-to-user";
const SUBMIT_TO_CHEF = "submit-to-chef";
const NOTIFY_PROGRESS ="notify-progress";

function noty(message){
    new Noty({
        type: 'info',
        layout: 'topRight',
        text: message,
        timeout: 2000,
        modal: true,
        progressBar : true,        
      }).show();
}

function sendToServer(url,order,fn){
    $.ajax({
        url : url,
        data : { order : order,_csrf : $('meta[name="csrf-token"]').attr("content") },
        type : 'post',
        success :fn
    })
}

$(function(){
    
    var server = $('meta[name="node-server"]').attr('content');
    var port = $('meta[name="node-port"]').attr('content');
    var baseUrl = $('meta[name="base-url"]').attr('content');

    var socket = io(server + ':' +port);
//    socket.emit(SUBMIT_ORDER,{ data : 'hehe'});
    

    socket.on(SUBMIT_ORDER, function(data) { 
        noty("coba lagi gan");
    });

    socket.on(SEND_BACK_TO_USER, function(data) { 

    });
    
    socket.on(SUBMIT_TO_CHEF, function(data) { 
        sendToServer(baseUrl+"/order/get-order-chef",data.orderId,function(response){            
            noty("NEW ORDER");
            $('#chef-table-body').append(response);
        })
    });

    socket.on(NOTIFY_PROGRESS,function(data){

    });
})