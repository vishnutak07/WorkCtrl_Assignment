<?php

    // for generating UUID
    function gen_uuid() {
        $uuid = array(
        'time_low'  => 0,
        'time_mid'  => 0,
        'time_hi'  => 0,
        'clock_seq_hi' => 0,
        'clock_seq_low' => 0,
        'node'   => array()
        );
        
        $uuid['time_low'] = mt_rand(0, 0xffff) + (mt_rand(0, 0xffff) << 16);
        $uuid['time_mid'] = mt_rand(0, 0xffff);
        $uuid['time_hi'] = (4 << 12) | (mt_rand(0, 0x1000));
        $uuid['clock_seq_hi'] = (1 << 7) | (mt_rand(0, 128));
        $uuid['clock_seq_low'] = mt_rand(0, 255);
        
        for ($i = 0; $i < 6; $i++) {
        $uuid['node'][$i] = mt_rand(0, 255);
        }
        
        $uuid = sprintf('%08x-%04x-%04x-%02x%02x-%02x%02x%02x%02x%02x%02x',
            $uuid['time_low'],
            $uuid['time_mid'],
            $uuid['time_hi'],
            $uuid['clock_seq_hi'],
            $uuid['clock_seq_low'],
            $uuid['node'][0],
            $uuid['node'][1],
            $uuid['node'][2],
            $uuid['node'][3],
            $uuid['node'][4],
            $uuid['node'][5]
        );
        
        return $uuid;
    }

    // Get data submitted by user
    $user_Name = $_POST["user_name"];
    $user_MobileNumber = $_POST['user_mno'];
    $user_City = $_POST['user_city'];

    // RE for User Information
    $re_Name = "/[a-zA-Z]{3,20}/";
    $re_Number = "/[0-9]{10}/";
    $re_City = "/[a-zA-Z]{3,20}/";

    // Check whether User Name, MobNumber,City are Correct or not
    if(!preg_match($re_Name,$user_Name)){
        echo "<br><h3><i>Invalid User Name, User Name length is more then 3, less then 20 and Only containing characters.</i></h3>";
    }

    elseif(!preg_match($re_Number,$user_MobileNumber)){
        echo "<br><h3><i>Mobile Number Should Contain 10 Digits.</i></h3>";
    }
    

    elseif(!preg_match($re_City,$user_City)){
        echo "<br><h3><i>Invalid City Name, City Name length is more then 3, less then 20 and Only containing characters.</i></h3>";
    }

    // If User name , city and MobN are correct then connect with Database
    else{
        $dbname = 'userForm'; 
        $servername = "localhost";
        $username = "root";
        $password = "";

        // for connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Server Connection Error.");
        }

        else{
            $UUID = gen_uuid();
            $sql = "INSERT INTO user (UUID,name,mobnumber,city) VALUES ('$UUID','$user_Name','$user_MobileNumber','$user_City')"; 

            if(mysqli_query($conn,$sql)){
                echo "<br><h3><i>The form has been submitted successfully</i></h3>";
                echo "<h3><a href='http://localhost:81/assignment/gen.php?name=$user_Name&mob=$user_MobileNumber&city=$user_City' style='font-size:20px;
                border-radius: 10px;
                border: 2px solid black;
                padding: 5px 10px; 
              cursor:pointer;
              text-decoration-line: none;'>Generate Pdf</a></h3>";

            }
            else{ 
            echo "Server Connection Error."; 
            }
        }

    }
?>