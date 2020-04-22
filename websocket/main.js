//サーバ処理
var express = require('express');
var app = express();
app.use('/static', express.static(__dirname + '/public'));
var http = require('http').Server(app);
const io = require('socket.io')(http);
const PORT = 3000;

//ルート
app.get('/' , function(req, res){
    res.sendFile(__dirname+'/view/index.html');
});

//サーバ監視
http.listen(PORT, function(){
    console.log('server listening. Port:' + PORT);
});

//socket
io.on('connection',function(socket){
    console.log('join!');

    socket.join();

       socket.on('chat_from_front', (message) => {
        console.log(message);
        io.emit('chat_from_server', message);
    });

    socket.on('disconnect', () => {
        console.log('disconnect');
    });
});