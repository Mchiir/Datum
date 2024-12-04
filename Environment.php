    <?php
    $server = "localhost";
    $username = "root"; // adjust well
    $password = ''; // adjust well
    $db = "students"; // adjust database_name as well

    $conn = new mysqli($server, $username, $password, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    header("Content-Type: application/json");
    $method = $_SERVER['REQUEST_METHOD'];

    switch ($method) {
        case 'GET':
            if(isset($_GET['id'] ) ){
                $id = $_GET['id'];
                $user = $conn->query("SELECT * FROM students WHERE Id=$id ");
                $result = $user->fetch_assoc();
                echo json_encode($result);
            }
            else{
                $result = $conn->query("SELECT * FROM students ORDER BY Id DESC");
                $userdata = array();
                while($row = $result -> fetch_assoc()){ 
                   $userdata[] = $row;
                }
                echo json_encode($userdata);
        }
            break;

        case 'POST':
            $firstName = $_POST['fName'];
            $secondName = $_POST['sName'];
            $email = $_POST['Email']; //here we post keys from add() in js; eg email;
            
            $sql = "INSERT INTO students (firstName, secondName, Email) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $firstName, $secondName, $email);
            
            try {
                if ($stmt->execute()) {
                    http_response_code(200);
                    echo json_encode(array('status' => 'success'));
                }
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() === 1062) { // Duplicate entry
                    http_response_code(409); // Conflict
                    echo json_encode(array('error' => 'Email already exists.'));
                } else {
                    http_response_code(500); // Internal Server Error
                    echo json_encode(array('error' => 'Failed to record userdata.'));
                }
            }
            break;

        case 'PUT':
            parse_str(file_get_contents("php://input"), $_PUT);
            $id = $_PUT['Id'];
            $firstName = $_PUT['newfname'];
            $secondName = $_PUT['newsname'];
            $email = $_PUT['newemail']; //here we PUT keys from update() in js last sending();
            
            $sql = "UPDATE students SET firstName=?, secondName=?, Email=? WHERE Id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $firstName, $secondName, $email, $id);
            
            if ($stmt->execute()) {
                echo json_encode(array('status' => 'success'));
            } else {
                http_response_code(500);
                echo json_encode(array('error' => 'Failed to update userdata.'));
            }
            break;

        case 'DELETE':
            parse_str(file_get_contents("php://input"), $_DELETE);            
            $id = $_DELETE['id'];
            $sql = "DELETE FROM students WHERE Id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            
            if ($stmt->execute()) {
                echo json_encode(array('status' => 'success'));
            } else {
                http_response_code(500);
                echo json_encode(array('error' => 'Failed to delete userdata.'));
            }
            break;

        default:
            http_response_code(400);
            echo json_encode(array('error' => 'Invalid request method'));
    }

    $conn->close();
    ?>
