<?php 
    //anna olson = UCr_RedQch0OK-fSKy80C3iQ; deepak = UC6d0RMVcoXNCkTpG8PW2dBA; GMA News = UCqYw-CTd1dU2yGI71sEyqNw; Tulfo = UCxhygwqQ1ZMoBGQM2yEcNug
    $API_KEY = 'AIzaSyBPzy2J0qGqHTEav1gTE3D4ZcGadhu6jQI';
    $pg_token = '';
    $URL_channel1= 'https://youtube.googleapis.com/youtube/v3/channels?part=snippet&id='; //
    $URL_channel2= '&key='.$API_KEY; 
    $URL_videos1 = 'https://youtube.googleapis.com/youtube/v3/search?part=snippet&channelId=';
    $URL_videos2 = '&maxResults=20&order=date&type=video&key='.$API_KEY; //[YOUR_API_KEY]
    $URL_videos3 = '&maxResults=20&order=date&type=video&key='.$API_KEY.'&pageToken=';
    $channel_id = '';
    
    $URL_videos = [];
    $errors = array();
    if (isset($_POST['Submit'])  && ($_POST['Submit']=="Go"))
    {
       
       if (empty($_POST['channelID']))
       {
            $errors[] = "Channel ID should not be empty!";
       }

        if (count($errors) > 0)
        {
            header("location: index.php");
        }
        else
        {             
            $channel_id = $_POST['channelID'];
            $files = glob('./v*.json');
            
            if (!empty($files)) {
                foreach ($files as $file) 
                {
                    unlink($file);
                }
            }
            
            $channel_data = file_get_contents($URL_channel1.$channel_id.$URL_channel2);
            echo "<pre>".$channel_data."</pre>";
            file_put_contents("channel.json", $channel_data);

            $URL_videos[0] = json_decode(file_get_contents($URL_videos1.$channel_id.$URL_videos2),true);
            file_put_contents("v0.json", json_encode($URL_videos[0]));
            
            $pg_token = $URL_videos[0]['nextPageToken'];
            
            for($i = 0; $i < 4; $i++)
            {
                if($pg_token<>'')
                {
                    $URL_videos[$i+1] = json_decode(file_get_contents($URL_videos1.$channel_id.$URL_videos3.$pg_token),true);
                    $pg_token = $URL_videos[$i+1]['nextPageToken'];
                    
                    if ($i==0)
                        file_put_contents("v1.json", json_encode($URL_videos[$i+1]));
                    elseif ($i==1)
                        file_put_contents("v2.json", json_encode($URL_videos[$i+1]));
                    elseif ($i==2)
                        file_put_contents("v3.json", json_encode($URL_videos[$i+1]));
                    else 
                        file_put_contents("v4.json", json_encode($URL_videos[$i+1]));
                }
                else
                {
                    break;
                }    
            }
            header("location: option.php");
        }   
    }    
?>
