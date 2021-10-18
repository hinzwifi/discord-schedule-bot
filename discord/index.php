<?php
$today = date("m.d.y"); 
$celebrant = "Neneward";
$favcolor = "3366ff";
$randomtime = rand();



if($today == $today){
  
//=======================================================================================================
// Create new webhook in your Discord channel settings and copy&paste URL
//=======================================================================================================

$webhookurl = "https://discord.com/api/webhooks/872435327493627985/c6Nsg8zBrzb3yOgoLnc3xJX_JD-TN4fkSFVRAMXCIgPftm6FwEGaoWvaEEcWJFA1w4ip";

//=======================================================================================================
// Compose message. You can use Markdown
// Message Formatting -- https://discordapp.com/developers/docs/reference#message-formatting
//========================================================================================================

$timestamp = date("c", strtotime("now"));

$json_data = json_encode([
    // Message
    "content" => "Hello Guys! It's ".$celebrant."'s birthday @everyone",
    
    // Username
    "username" => "Birthday bot",

    // Avatar URL.
    // Uncoment to replace image set in webhook
    //"avatar_url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=512",

    // Text-to-speech
    "tts" => false,

    // File upload
    // "file" => "",

    // Embeds Array
    "embeds" => [
        [
            // Embed Title
            "title" => "PHP",

            // Embed Type
            "type" => "rich",

            // Embed Description
            "description" => "@everyone wishes you a very happy birthday",

            // URL of title link
            "url" => "https://idasacommunity.tech",

            // Timestamp of embed must be formatted as ISO8601
            "timestamp" => $timestamp,

            // Embed left border color in HEX
            "color" => hexdec($favcolor),

            // Footer
            "footer" => [
                "text" => "idasacommunity.tech",
                "icon_url" => "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.kym-cdn.com%2Fentries%2Ficons%2Foriginal%2F000%2F000%2F091%2FTrollFace.jpg&f=1&nofb=1"
                
            ],

            // Image to send
            "image" => [
                "url" => "https://source.unsplash.com/1600x900/?birthday?sig=".$randomtime.""
            ],

            // Thumbnail
            "thumbnail" => [
                "url" => "https://media.giphy.com/media/26FPIV12CYbDSVIR2/giphy.gif"
            ],

            // Author
            "author" => [
                "name" => "PHP bot",
                "url" => "https://idasacommunity.tech/"
            ],

            // Additional Fields array
            // "fields" => [
            //     // Field 1
            //     [
            //         "name" => "Field #1 Name",
            //         "value" => "Field #1 Value",
            //         "inline" => false
            //     ]
            //     // ,
            //     // // Field 2
            //     // [
            //     //     "name" => "Field #2 Name",
            //     //     "value" => "Field #2 Value",
            //     //     "inline" => true
            //     // ]
            //     // Etc..
            // ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


$ch = curl_init( $webhookurl );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
// If you need to debug, or find out why you can't send message uncomment line below, and execute script.
echo $response;
curl_close( $ch );
$message = "Check your discord notification!";

}
else {
$message = "not jagabork birthday";
}


?>

<!DOCTYPE html>
<html lagn="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nothing to see here, move along.</title>

        <style>
            body {
                margin: 0;
                background-color: #e3e3e4;
            }
            header {
                background-color: LightSteelBlue;
                margin: 0;
                padding-top: 3%;
                padding-bottom: 3%;
                text-align: center;
                font-size: 200%;
            }
            .greeting {
                margin: 5%;
                min-height: 10%;
            }
            footer {
                position: fixed;
                bottom: 0;
                font-size: 65%;
                width: 95%;
                text-align: right;
                padding-bottom: 2em;
            }
        </style>
        <link rel="stylesheet" type="text/css" href="../hostinger-free.css" media="screen" />
    </head>

    <body>
        <header><?php echo $message ?></header>
        <center><img src="https://www.fullertonsfuture.org/wp-content/uploads/2018/08/nothingtoseehere.jpg" max-width="100%" max-height="100%"></center>
        <footer>Site: <span id="domain"></span></footer>
    </body>

    <script>
        var theDomain = document.domain;
if (theDomain === "")
    theDomain = "local";

document.getElementById("domain").textContent = theDomain;
</script>
</html>
