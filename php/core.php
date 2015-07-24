<?php

function sanitizeString($var)
{
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return $connection->real_escape_string($var);
}

function SavePostToDB($_db, $_user, $_password, $_filename)
{
	if (!($stmt = $_db->prepare("INSERT INTO users(USERNAME, PASSWORD, FILENAME) VALUES (?, ?, ?)")))
	{
		echo "Prepare failed: (" . $_db->errno . ") " . $_db->error;
	}
	if (!$stmt->bind_param('sss', $_user, $_password, $_filename))
	{
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	if (!$stmt->execute())
	{
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
}

function editProfile($connection, $firstname, $lastname, $gender, $UserName, $quote)
{
    if (!($stmt = $connection->prepare("INSERT INTO profile(FIRSTNAME, LASTNAME,
    GENDER, username, QUOTES) VALUES (?, ?, ?, ?, ?)")))
	{
        echo "Prepare failed: (" . $connection->errno . ") " . $connection->error;
	}
	if (!$stmt->bind_param('sssss', $firstname, $lastname, $gender, $UserName, $quote))
	{
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	if (!$stmt->execute())
	{
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
}

function SaveStatusToDB($connection, $UserName, $status, $file_name, $time, $filter)
{
    if (!($stmt = $connection->prepare("INSERT INTO userposts(USERNAME, STATUS, IMAGE_NAME, 
    TIME_STAMP, FILTER) VALUES (?, ?, ?, ?, ?)")))
	{
        echo "Prepare failed: (" . $connection->errno . ") " . $connection->error;
	}
	if (!$stmt->bind_param('sssss', $UserName, $status, $file_name, $time, $filter))
	{
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	if (!$stmt->execute())
	{
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
}

function queryMysql($query)
{
    global $connection;
    $result = $connection->query($query);
    if (!$result) die($connection->error);
    return $result;
}

?>