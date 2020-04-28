<?php

if(!isset($_SESSION))
{
    session_start();
}

if(isset($_SESSION['logged']) && $_SESSION['logged']) {

    $json = file_get_contents('php://input');

    // Converts it into a PHP object
    $data = json_decode($json);

    if( $data->login && $data->password ) {
        $password = $data->password;
        $confirm = $data->confirm;
        $user = $data->login;
        if($password === $confirm) {

            try {


                $conn = new mysqli('mysql', 'mysql', 'mysql', 'db');

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $stmt = $conn->prepare("UPDATE user set pass = ? WHERE login = ?");
                $stmt->bind_param("ss", $new_password, $new_user);
                $new_password = $password;
                $new_user = $user;

                $stmt->execute();

                $stmt->close();
                $conn->close();

                header('Content-Type: application/json');
                echo json_encode(array("success" => true));

            }
            catch (Exception $e) {
                header('Content-Type: application/json');
                echo json_encode(array("success" => false, "stackstrace" => $e));
            }
        }
    }



}
else {
    header('HTTP/1.0 403 Forbidden');

    echo 'You are forbidden!';
}


?>