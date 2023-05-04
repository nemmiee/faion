<?php
session_start();

if (!empty($_POST['username']) && !empty($_POST['password'])) {
    include('../../faion/connection/Database.php');
    $db = new Database();

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $result = mysqli_query($db->getConnection(), "SELECT ac.id, ct.name, ac.role, ac.status 
    FROM account ac, customer ct WHERE ac.id = ct.id and ac.username = '" . $username
        . "' and ac.password = '" . $_POST['password'] . "'");
    $row = mysqli_fetch_assoc($result);
    if (is_array($row)) {
        if ($row['status'] == 1) {
            $_SESSION["id"] = $row['id'];
            $_SESSION["name"] = $row['name'];
            $_SESSION["role"] = $row['role'];
            $_SESSION["firstLogin"] = "true";
            echo "success";
            exit();
        } else {
            echo "lock";
            exit();
        }
    } else {
        echo "fail";
        exit();
    }
    $db->disconnect();
} else {
    echo "No data received";
}
