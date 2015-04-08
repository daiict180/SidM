// This is an example message that uses two merge tags

var params = {
    "message": {
        "from_email":"malayshah@gmail.com",
        "to":[{"email":"malayshah94@gmail.com"}],
        "subject": "Sending a text email from the Mandrill API",
        "html": "<p>Hey *|COOLFRIEND|*, we've been friends for *|YEARS|*.</p>",
        "autotext": true,
        "track_opens": true,
        "track_clicks": true,
        "merge_vars": [
            {
                "rcpt": "malayshah94@gmail.com",
                "vars": [
                    {
                        "name": "COOLFRIEND",
                        "content": "Your friend's name"
                    },
                    {
                        "name": "YEARS",
                        "content": "5 awesome years"
                    }
                ]
            }
        ]
    }
};