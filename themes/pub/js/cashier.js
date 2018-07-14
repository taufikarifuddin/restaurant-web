var baseUrl = $('meta[name="base-url"]').attr('content');

function checkIsApproved(parentId){
    var listOfCheckbox = $(".checkbox-"+parentId);
    console.log(".checkbox-"+parentId);
    console.log(listOfCheckbox);
    var isApproved = true;
    $.each(listOfCheckbox,function(index,elem){
        var isChecked = $(this).prop("checked");
        if( !isChecked ){
            isApproved = false;                
            return;
        }
    })
    return isApproved;
}

function setActionBtn(id,parentId){
    var isValid = checkIsApproved(parentId);
    console.log(isValid);
    var button = getBtnDOM(parentId);

    button.approve.attr("disabled","true");
    button.reject.attr("disabled","true");
    
    if( isValid ){
        button.approve.removeAttr("disabled");
    }else{
        button.reject.removeAttr("disabled");                        
    }
}

function getBtnDOM(parentId){
    var approveBtn = $("#btn-approve-"+parentId);        
    var rejectBtn = $("#btn-reject-"+parentId);                
    return {
        approve : approveBtn,
        reject : rejectBtn
    }
}

function collectData(parentId){
    var listCheckbox = $("#table-"+parentId+" input[type=\"checkbox\"]");
    var value = [];
    console.log(listCheckbox);
    $.each(listCheckbox,function(index,data){
        var id = $(this).data("id");
        var isApproved = $(this).prop("checked");
        var note = $("#textarea-"+id).val();
        if( !isApproved && note.trim() == "" ) {
            value = false;
            return;
        }
        value.push({
            approved : isApproved,
            note : note,
            id : id
        });
    })

    return value;
}        

function sendDataToServer(data,fn){

    $.ajax({
        url : baseUrl+"/operation/confirm",
        data : data,
        method : "post",
        success : fn
    });
}


function isUndefined(data){
    return typeof data == "undefined";
}

function pushDataToObject(data,key,val){
    if( isUndefined(data) ){
        data = {};
    } 
    data[key] = val;

    return data;
}

$(function(){

    var csrf = $('meta[name="csrf-token"]').attr("content");

    $(document).on("change",".checkbox",function(){
        var isSelected = $(this).prop("checked");        
        var id = $(this).data("id");
        var parentId = $(this).data("parent");        
        if(!isSelected){               
            $("#textarea-"+id).removeAttr("style");
        }else{
            $("#textarea-"+id).css("display","none");        
        }

        setActionBtn(id,parentId);

    });


    $(document).on("click",".btn-approve",function(){
        var id = $(this).data("id");
        var data = collectData(id);

        data = pushDataToObject(data,"_csrf",csrf);
        var request = {
            data : data,
            order : id
        };
        sendDataToServer(request,function(response){
            if( response ) {
                $("#container-"+id).remove();
            }else{
                console.log("bcd");                    
            } 

            console.log(response);                    
        });
    })

    $(document).on("click",".btn-reject",function(){
        var id = $(this).data("id");   
        var data = collectData(id);
        
        data = pushDataToObject(data,"_csrf",csrf);
        var request = {
            data : data,
            order : id
        };

        if(!data){
            alert("Note harus diisi ketika permintaan direject");
        }else{
            sendDataToServer(request,function(response){
                if( response ) {
                    $("#container-"+id).remove();
                }           
            });
        }
    })  

    $(document).on("click",".btn-pay",function(){
        var id = $(this).data("id");    
        $.ajax({
            url : baseUrl+"/operation/notify-pay",
            data : {order : id},
            method : "post",
            success : function(response){
                if( response ){
                    alert('Send Notification to User');
                }
            }
        });       
    })  
    

})


// notification
const SUBMIT_ORDER = "submit-order";

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
    
    socket.on(SUBMIT_ORDER, function(data) { 
        sendToServer(baseUrl+"/order/get-order-cashier",data.orderId,function(response){            
            noty("NEW ORDER");
            $('#chasier-table-body').append(response);
        })
    });

})