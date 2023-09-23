<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">
        <title>Select Channel</title>
        <meta name = "description" content = "Channel and Videos">
        <link rel = "stylesheet" href = "./style.css">
    </head>
    <body>
        <form class="main" action = "youtube_channel_json.php" method = "post">
            <label for="channels">Choose Youtube Channel:</label>
            <select id="channels" name="channelID" >
                <option value="">Select a Channel</option>
                <option value="UCr_RedQch0OK-fSKy80C3iQ">Anna Olson's Oh Yum</option>
                <option value="UC6d0RMVcoXNCkTpG8PW2dBA">Chopra Well</option>
                <option value="UCqYw-CTd1dU2yGI71sEyqNw">GMA News</option>
                <option value="UCxhygwqQ1ZMoBGQM2yEcNug">Tulfo in Action</option>
            </select>
            <input type = "submit" name = "Submit" value = "Go">
        </form>
    </body>
</html>

