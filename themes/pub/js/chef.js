var baseUrl = $('meta[name="base-url"]').attr('content');    

function sendDataToServer(id,fn){
    $.ajax({
        url : baseUrl+"/operation/done",
        data : { id : id ,_csrf : $('meta[name="csrf-token"]').attr("content") },
        method : "post",
        success : fn
    });
}

$(function(){

    $(document).on("click",".btn-approve",function(){
        var id = $(this).data("id");          
        sendDataToServer(id,function(response){
            if( response ) {
                $("#container-"+id).remove();
            } 
        });  
        
    })

    $(document).on("click",".btn-reject",function(){
        var id = $(this).data("id");              
    })    

})

//notification
const SUBMIT_TO_CHEF = "submit-to-chef";

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
    var socket = io(server + ':' +port);
    
    socket.on(SUBMIT_TO_CHEF, function(data) { 
        sendToServer(baseUrl+"/order/get-order-chef",data.orderId,function(response){            
            noty("NEW ORDER");
            $('#chef-table-body').append(response);
        })
    });
})