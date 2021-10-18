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
    $sched = date("H:i");
    $todayDate = date("D");
if ($todayDate == "Mon" ){
$todayDate2 = "mwf";
}
elseif ($todayDate == "Tues" ){
$todayDate2 = "tths";
}
elseif ($todayDate == "Wed" ){
$todayDate2 = "mwf";
}
elseif ($todayDate == "Thurs" ){
$todayDate2 = "tths";
}
elseif ($todayDate == "Friday" ){
$todayDate2 = "mwf";
}
elseif ($todayDate == "Sat" ){
$todayDate2 = "tths";
}
elseif ($todayDate == "Sunday" ){
$todayDate2 = "sat";
}
    $result = mysqli_query($conn,"SELECT subject , subjectT , meetLink, meetDay  FROM `sched` WHERE meetSched = '$sched'");
    if (mysqli_num_rows($result) > 0) {
        
        $i=0;
        while($row = mysqli_fetch_array($result)) {
      if ($row["meetDay"] == $todayDate2) {
            
    //         =======================================================================================================
    // // Create new webhook in your Discord channel settings and copy&paste URL
    $webhookurl = "https://discord.com/api/webhooks/898084558048731176/kBpgh8Q0U37n6bavBy2NnVggsv48vMz14J_RzxKMvQKUp9GC1A59X5CVDD6OTi6bfPsa";

    
    $ageThisYear = $yearNow - $birthYear;
    //=======================================================================================================
    // Compose message. You can use Markdown
    // Message Formatting -- https://discordapp.com/developers/docs/reference#message-formatting
    //========================================================================================================

    $timestamp = date("c", strtotime("now"));

    $json_data = json_encode([
        // Message      
        "content" => "Magklase nata og **".$row["subject"]."**  \n @everyone",
        
        // Username
        "username" => "BSAE - 1B sched bot",

        // Avatar URL.
        // Uncoment to replace image set in webhook
        "avatar_url" => "https://cats.edu.ph/images/logo.png",

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
                "description" => "Click the link : ".$row["meetLink"]."",

                // URL of title link
                "url" => "https://idasacommunity.tech",

                // Timestamp of embed must be formatted as ISO8601
                "timestamp" => $timestamp,

                // Embed left border color in HEX
                "color" => hexdec($favcolor),

                // Footer
                "footer" => [
                    "text" => "made by hinzwifi",
                    "icon_url" => "https://avatars.githubusercontent.com/u/69793444?v=4"
                    
                ],

                // Image to send
                "image" => [
                    "url" => ""
                ],

                // Thumbnail
                "thumbnail" => [
                    "url" => "https://i.imgur.com/3Ci2XCx.png"
                ],

                // Author
                "author" => [
                    "name" => "",
                    "url" => ""
                ],

                // Additional Fields array
                "fields" => [
                    // Field 1
                    [
                        "name" => "Teacher:",
                        "value" => "".$row["subjectT"]."",
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
