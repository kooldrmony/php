<?php

$first = $_POST["first"];
$last = $_POST["last"];
$email = $_POST["email"];
$date = $_POST["date"];
$sat = $_POST["sat"];
$rec = $_POST["rec"];
$service = $_POST["service"];

if (!empty($first) || !empty($last) || !empty($email) || !empty($date) || !empty($sat) || !empty($rec) || !empty($service)) {

	$host = "localhost";
	$dbUsername = "root";
	$dbPassword = "Derrick#21";
	$dbname = "customersurvey";

	//connection
	$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

	if (mysqli_connect_error()) {

		die("Connect Error(". mysqli_connect_errno().")". mysqli_connect_error());
	} else{

		$SELECT = "SELECT email From survey Where email = ? Limit 1";
		$INSERT = "INSERT Into survey (first, last, email, date, sat, rec, service) values(?, ?, ?, ?, ?, ?, ?)";

		//statement
		$stmt = $conn->prepare($SELECT);
		$stmt ->bind_param("s", $email);
		$stmt->execute();
		$stmt->bind_result($email);
		$stmt->store_result();
		$rnum = $stmt->num_rows;

		if ($rnum == 0) {

			$stmt->close();

			$stmt = $conn->prepare($INSERT);
			$stmt->bind_param("sssssss", $first, $last, $email, $date, $sat, $rec, $service);
			$stmt->execute();
			echo "New survey entered successfully";
			} else {

				echo "Email already registered";
			}
			$stmt->close();
			$conn->close();

	}

} else {

	echo "All fields are required";
	die();
}



?>