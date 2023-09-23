<?php 
    
    {   require_once('conn_db.php');
        // Read the JSON file 
        $ch_json_data = json_decode(file_get_contents('channel.json'), true);
        $channelId = $ch_json_data['items'][0]['id'];
        $title = mysqli_real_escape_string($connection,$ch_json_data['items'][0]['snippet']['title']);
        $desc = mysqli_real_escape_string($connection,$ch_json_data['items'][0]['snippet']['description']);
        $profile_pic = $ch_json_data['items'][0]['snippet']['thumbnails']['high']['url']  ;
        $sel_query = "SELECT 1 FROM youtube_channel_videos WHERE channelID = ".$channelId;
        
        if (mysqli_query($connection, $sel_query)){
            $del_query = "DELETE * FROM youtube_channel_videos WHERE channelID = ".$channelId;
            if (mysqli_query($connection, $del_query))
            {
              echo "File updated";
            }
        }
        
        $query = "INSERT INTO youtube_channels(channelID,channel_name, ch_desc, profile_pic)
        VALUES('{$channelId}', '{$title}', '{$desc}', '{$profile_pic}');";
        if (mysqli_query($connection, $query))
        {
            echo "A new channel was just added.";   
        }
        else
        {
           echo "Failed to add channel";
        }

        for($x=0; $x < 5; $x++)
        {   
            if ($x==0){
                $video_json = file_get_contents('v0.json');
            }
            elseif ($x==1){
                $video_json = file_get_contents('v1.json');
            }
            elseif ($x==2){
                $video_json = file_get_contents('v2.json');
            }
            elseif ($x==3){
                $video_json = file_get_contents('v3.json');
            }
            else{
                $video_json = file_get_contents('v4.json');
            }

            $vid_json_data = json_decode($video_json,true);

            
            $ins_val = "";
            for($i = 0; $i < count($vid_json_data['items']); $i++)
            {
                if ($vid_json_data['items'][$i]['id']['kind'] == "youtube#video" )
                {     
                    $channel = $vid_json_data['items'][$i]['snippet']['channelId'];
                    $videoId = $vid_json_data['items'][$i]['id']['videoId'];
                    $v_title = mysqli_real_escape_string($connection,$vid_json_data['items'][$i]['snippet']['title']);  
                    $vid_desc =  mysqli_real_escape_string($connection,$vid_json_data['items'][$i]['snippet']['description']);   
                    $thumbnail = $vid_json_data['items'][$i]['snippet']['thumbnails']['default']['url'];
          
                    $query1 = "INSERT INTO youtube_channel_videos(videoLink, channelId,title, video_desc, thumbnail) 
                    VALUES ('{$videoId}', '{$channel}', '{$v_title}', '{$vid_desc}', '{$thumbnail}')";
                        
                    if (mysqli_query($connection, $query1))
                    {
                       echo "Success! channel videos were just added.";
                    }
                    else
                    {
                       echo "Failed to add videos";  
                    }
                }
            }
            header("location: option.php");
        } 
    }
?>
