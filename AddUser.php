<?php
	$inData = getRequestInfo();
	
	$Login = $inData["Login"];
	$Password = $inData["Password"];
    $FirstName = $inData["FirstName"];
    $LastName = $inData["LastName"];

	$conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331", "COP4331");
	if ($conn->connect_error) 
	{
		returnWithError( $conn->connect_error );
	} 
	else
	{
        $stmt = $conn->prepare("INSERT into Users (FirstName,LastName,Login,Password) VALUES('".$FirstName."','".$LastName."','".$Login."','".$Password."')");
		$stmt->execute();
        $stmt->close();
        $conn->close();
        returnWithError("");
    }

	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}
	
	function returnWithError( $err )
	{
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
	
?>
