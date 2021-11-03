<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Add User PHP</title>
    <?php
        $pass = $_POST['pass'];
        $user = $_POST['user'];
        $message = "";

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbase = "userdata";

        // Create connection
        $conn = new mysqli($servername, $username, $password,$dbase);

        // Check connection
        if ($conn->connect_error) {
               $message = $conn->connect_error; //die("Connection failed: " . $conn->connect_error);
        }
        // "Connected successfully";
        else
        {
            $sql = "select * from users where userName = '" . $user . "'";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $message = "Username already exists. Try a different one ";
            }
            else
            {
                $encrypted = sha1($pass);
                $sql = "insert into users (userName, userPassword ) values ('" .$user. "','" .$encrypted. "')"; 
                if($conn->query($sql) === TRUE){
                    $message = "Username added";
                }
                else
                {
                    $message = "Could not add user - no idea why!";
                }
            }


            $conn->close();
        }

    ?>

</head>
<body>
    <table>
        <tr>
            <td>
                <?php
                    echo "User entry result: " . $message;                 
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <a href = "AddUserForm.html">Back to Data Entry</a>
            </td>
        </tr>
    </table>
</body>
</html>