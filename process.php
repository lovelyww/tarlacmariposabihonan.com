<?php

if (empty($_POST["FirstName"])) {
   die("First Name is required");
}

if (empty($_POST["LastName"])) {
   die("Last Name is required");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
   die("Valid email is required");
}
if ($_POST["password"] !== $_POST["password_confirmation"]) {
   die("Password do not match");

}
require __DIR__ . "/database.php";

$sql = "INSERT INTO user (FirstName, LastName, email, password, Age, ContactNo, Address, position)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $mysqli->stmt_init();
if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error); 
}
$stmt->bind_param("ssssssss",
                  $_POST["FirstName"],
                  $_POST["LastName"],
                  $_POST["email"],
                  $_POST["password"],
                  $_POST["Age"],
                  $_POST["ContactNo"],
                  $_POST["Address"],
                  $_POST["position"]);

$stmt->execute(); 

header("Location: Message.html");
exit;