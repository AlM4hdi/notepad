<?php

include "db.php";

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 1000');
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
    }
    if (isset($_SERVER['HTTP_ACCESS-CONTROL_REQUEST_HEADERS'])) {
        header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
    }
    exit(0);
}

$response = array('error' => false);

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == "add") {
        if (isset($_POST['title'])) {
            $title = mysqli_real_escape_string($conn, $_POST['title']);

            $stmt = $conn->prepare("INSERT INTO `test` (`id`, `title`) VALUES (NULL, ?)");
            $stmt->bind_param("s", $title);

            if ($stmt->execute()) {
                $response['message'] = 'Added Successfully';
            } else {
                $response['error'] = true;
                $response['message'] = 'Failed to add';
            }

            $stmt->close();
        } else {
            $response['error'] = true;
            $response['message'] = 'Title is missing in the request';
        }
    }
     elseif ($action == "get") {
        $sql = "SELECT * FROM `test`";
        $list = $conn->query($sql);

        if ($list) {
            $num = mysqli_num_rows($list);
            $listdetail = array();

            if ($num > 0) {
                while ($row = $list->fetch_assoc()) {
                    $listdetail[] = $row;
                }

                $response['message'] = $listdetail;
            } else {
                $response['message'] = 'No data found';
            }
        } else {
            $response['error'] = true;
            $response['message'] = 'Failed to fetch data';
        }
    } else {
        $response['error'] = true;
        $response['message'] = 'Invalid action';
    }
} else {
    $response['error'] = true;
    $response['message'] = 'Action parameter missing';
}

mysqli_close($conn);

header("Content-type: application/json");
echo json_encode($response);
die();

?>