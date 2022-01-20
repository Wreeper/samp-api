var express = require("express");
var query = require('samp-query')
var app = express();

app.listen(19231, () => {
 console.log("Server running on port 19231");
});

app.get('/', function(req, res){
var requestedserver = req.query.server;
var falsemessage = "{\"status\": \"failed\"}";

var options = {
    host: requestedserver
}

res.setHeader('Content-Type', 'application/json');

query(options, function (error, response) {
    if(error) {
        return res.status(404).send(response);
       // The following piece of code would have been recommended but it didn't work because of some random error that no one could fix: return res.status(404).send(falsemessage);
   } else {
        return res.status(200).send(response);
   }
})
});
