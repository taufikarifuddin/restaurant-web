var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var port = 3000;

const SUBMIT_ORDER = "submit-order";
const SEND_BACK_TO_USER = "send-back-to-user";
const SUBMIT_TO_CHEF = "submit-to-chef";
const NOTIFY_PROGRESS ="notify-progress";
var count = 0;

io.on('connection', function(socket){


    socket.on(SUBMIT_ORDER, function(data) { 
      console.log('called');
      io.emit(SUBMIT_ORDER, "say hai");  
    });

    socket.on('broadcast',function(){
      console.log('called');
    })
    
    socket.on(SEND_BACK_TO_USER, function(data) { 

    });
    
    socket.on(SUBMIT_TO_CHEF, function(data) { 

    });

    socket.on(NOTIFY_PROGRESS,function(data){

    });

});

http.listen(port, function(){
  console.log('listening on *:'+port);
});
