<?php
// $today = date("m.d.y"); 
// $celebrant = "Neneward";
 $favcolor = "3366ff";
 $randomtime = rand();


// Try and connect using the info above.



$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'id17388657_account';
$DATABASE_PASS = 'MJhaynes10MARKh3inz?';
$DATABASE_NAME = 'id17388657_accounts';
// // Try and connect using the info above.
$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// // if ($projectsname){
//     $today = date("m-d");
//     $result =  "SELECT userbday , username, surname  FROM `discord-birthday` WHERE userbday = '$today'"; 
//     $user = $con->query($result);
//     foreach ($user as $row) {   
//         $name = $row['username'];
//         $surename = $row['surname'];
//         echo  'Todays is'.$name.' '.$surename.' birthday';                 
//     }



    date_default_timezone_set("Asia/Manila");
    $yearNow = (int)date("Y");
    $today = date("n-d");
    $result = mysqli_query($conn,"SELECT userbday , username, surname, useryear  FROM `celebrants` WHERE userbday = '$today'");
    if (mysqli_num_rows($result) > 0) {
        
        $i=0;
        while($row = mysqli_fetch_array($result)) {
        
    //         =======================================================================================================
    // // Create new webhook in your Discord channel settings and copy&paste URL
    $webhookurl = "https://discord.com/api/webhooks/875880688690294885/eGo47Vpx_uNaOy66gWq1GJ4r-GClR00FKutKlcwe3R9QTc1-UXU2lFcuGKN34HgohM4_";

    $birthYear=(int) $row['useryear'];
    $ageThisYear = $yearNow - $birthYear;
    //=======================================================================================================
    // Compose message. You can use Markdown
    // Message Formatting -- https://discordapp.com/developers/docs/reference#message-formatting
    //========================================================================================================

    $timestamp = date("c", strtotime("now"));

    $json_data = json_encode([
        // Message
        "content" => "Hello Guys and Gals! It's ".$row["username"]." ".$row["surname"]."'s birthday @everyone",
        
        // Username
        "username" => "Birthday bot",

        // Avatar URL.
        // Uncoment to replace image set in webhook
        "avatar_url" => "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.kym-cdn.com%2Fentries%2Ficons%2Foriginal%2F000%2F000%2F091%2FTrollFace.jpg&f=1&nofb=1",

        // Text-to-speech
        "tts" => false,

        // File upload
        // "file" => "",

        // Embeds Array
        "embeds" => [
            [
                // Embed Title
                "title" => "",

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
                    "text" => "made by hinzwifi",
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
                    "name" => "Birthday Bot",
                    "url" => "https://idasacommunity.tech/"
                ],

                // Additional Fields array
                "fields" => [
                    // Field 1
                    [
                        "name" => "Age:",
                        "value" => "- ".$ageThisYear,
                        "inline" => false
                    ]
                //     // ,
                //     // // Field 2
                //     // [
                //     //     "name" => "Field #2 Name",
                //     //     "value" => "Field #2 Value",
                //     //     "inline" => true
                //     // ]
                //     // Etc..
                ]
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
            //  echo $row["userbday"]; 
            //  echo $row["username"]; 
            //  echo $row["surname"]; 
            
        
        $i++;
        
        }
    }
        else{
            
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
        <header><?php  ?></header>
        <?php

?>
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
