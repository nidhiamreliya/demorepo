<?php
// Connect with database
$mysql_username = 'root';
$mysql_password = '';
$mysql_connection = new PDO("mysql:host=localhost;dbname=ps_system", $mysql_username, $mysql_password);

/*	*Function of execute query
	*@param: query to execute
	*@param: query parameters
	*@return: true or false   
*/
	
function execute_query($query, $parameters = array())
{
	global $mysql_connection;
	$statement = $mysql_connection->prepare($query);
	return $statement->execute($parameters);
}

/*	*Function for retrive one row from database
	*@param: query to execute
	*@param: query parameters
	*@return: array of resulted row   
*/
function get_row($query, $parameters = array())
{
	global $mysql_connection;
	$statement = $mysql_connection->prepare($query);
	$statement->execute($parameters);
	$result = $statement->fetch();
	return $result;
}

/*	*Function for retrive more than one row from database
	*@param: query to execute
	*@param: query parameters
	*@return: array of resulted rows
*/
function get_rows($query, $parameters = array())
{
	global $mysql_connection;
	$statement = $mysql_connection->prepare($query);
	$statement->execute($parameters);
	$result = $statement->fetchAll();
	return $result;
}


?>