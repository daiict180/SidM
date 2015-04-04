// Create a function to log the response from the Mandrill API
function log(obj) {
    $('#response').text(JSON.stringify(obj));
}

// create a new instance of the Mandrill class with your API key
var m = new mandrill.Mandrill('A4BIyWYWdHCKZna8ew75FA');

// create a variable for the API call parameters
var params = {
    "message": {
        "from_email":"malayshah94@gmail.com",
        "to":[{"email":"201201154@daiict.ac.in"}],
        "subject": "Sending a text email from the Mandrill API",
        "text": "I'm learning the Mandrill API at Codecademy."
    }
};

function sendthemailforme() {
// Send the email!

     m.messages.send(params, function(res) {
        log(res);
    }, function(err) {
        log(err);
    });
};