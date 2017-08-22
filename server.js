/*
  server.js
*/
var express = require('express');
var app = express();
var port = process.env.PORT || 8080;
var bodyParser = require('body-parser');
var request = require('request');
var routes = require('./routes');
var path = require('path');

/*
  database setting
*/
var sqlite3 = require('sqlite3').verbose();
var db = new sqlite3.Database('./hospital.db');


var member = require('./routes/member');

app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'ejs');
//app.use(express.favicon());
// app.use(express.logger('dev'));
app.use(express.json());
app.use(express.urlencoded());
app.use(express.methodOverride());

app.use(express.static(path.join(__dirname, 'public')));

// // development only
// if ('development' == app.get('env')) {
//   app.use(express.errorHandler());
// }


app.get('/', routes.index);

app.get('/member', member.search);
app.post('/member', member.result);

app.get('/scan', routes.scan);

app.get('/doctor', routes.doctor);

app.get('/add', member.add);
app.post('/add', member.save);



app.get('/delete/:identificationid', member.delete);
app.get('/edit/:identificationid', member.edit);
app.post('/edit/:identificationid', member.save_edit);

app.get('/list', member.list);
app.get('/listcard', member.listcard);
app.get('/view/:uuid', member.view);
app.get('/delete/view/:uuid', member.delete_view);

// app.get('/input/:uuid', member.input);
app.get('/input/:uuid', (req, res) => {
  var uuid = req.params.uuid;
  console.log("insert card : " + uuid);
  res.send('request receive');
})

/*
  line webhook

*/
app.post('/webhook', (req, res) => {
  var data = req.body;
  var text = data.events[0].message.text
  var sender = data.events[0].source.userId
  var replyToken = data.events[0].replyToken
  console.log(typeof sender, typeof text)
  console.log(data);
  console.log(data.events[0]);
 
  console.log("receive data");
  //เงื่อนไขของ bot
  if (text === 'สวัสดี' || text === 'Hello' || text === 'hello') {
    pushMsg(sender, text)
  } else {
    //  pushMsg(sender, name);
    //  pushMsg(sender, identificationid);
    //  pushMsg(sender, symtoms);

  }


  res.sendStatus(200)
})
var access_token = 'qLip9omRdSnsaKFlsWmCCx9pdvAcRd1CGb6XfH/K3aKVgmHS4Eh/a35I8S1q8XVCZQVJUVIPa2B/c1ZJHfEyA8vUgqlUeIfqTkw607IKQ7yCasUHW34wj+CGzB6bOafYNDSGkh87GIr+Tns7fqFqVAdB04t89/1O/w1cDnyilFU=';

function pushMsg(sender, text) {
  let data = {
    to: sender,
    messages: [{
      type: 'text',
      text: text
    }]
  }
  request({
    headers: {
      'Content-Type': 'application/json',
      'Authorization': 'Bearer ' + access_token
    },
    url: 'https://api.line.me/v2/bot/message/push',
    method: 'POST',
    body: data,
    json: true
  }, function(err, res, body) {
    if (err) console.log('error')
    if (res) console.log('success')
    if (body) console.log(body)
  })

}
app.use("/", express.static(__dirname + "/"));
app.listen(port, function() {
  console.log('server on port 8080');
});
