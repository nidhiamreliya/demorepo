<?php
$mysql_username = 'root';
$mysql_password = '';
$mysql_connection = new PDO("mysql:host=localhost;dbname=ps_system", $mysql_username, $mysql_password);

function execute_query($query, $parameters = array())
{
	global $mysql_connection;
	$statement = $mysql_connection->prepare($query);
	return $statement->execute($parameters);
}

function get_row($query, $parameters = array())
{
	global $mysql_connection;
	try 
	{
		$statement = $mysql_connection->prepare($query);
		$statement->execute($parameters);
		$result = $statement->fetch();
	} 
	catch (Exception $e) 
	{
		print_r($e);
	}
	
	return $result;
}

function get_rows($query, $parameters = array())
{
	//print_r($query);
	//print_r($parameters);
	global $mysql_connection;
	$statement = $mysql_connection->prepare($query);
	$statement->execute($parameters);
	$result = $statement->fetchAll();
	print_r($result);
	return $result;
}


?>