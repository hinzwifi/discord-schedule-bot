<?php
   
       
    // // Create new webhook in your Discord channel settings and copy&paste URL
    $webhookurl = "https://discord.com/api/webhooks/898084558048731176/kBpgh8Q0U37n6bavBy2NnVggsv48vMz14J_RzxKMvQKUp9GC1A59X5CVDD6OTi6bfPsa";

    $birthYear=(int) $row['useryear'];
    $ageThisYear = $yearNow - $birthYear;
    //=======================================================================================================
    // Compose message. You can use Markdown
    // Message Formatting -- https://discordapp.com/developers/docs/reference#message-formatting
    //========================================================================================================

    $timestamp = date("c", strtotime("now"));

    $json_data = json_encode([
        // Message
        "content" => "Magklase natag ".$row["subject"]." ",
        
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
                "description" => "Click the link : ",

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
                        "name" => "Teacher:",
                        "value" => "".$row["subject"]."",
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
        
        