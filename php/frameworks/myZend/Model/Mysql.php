<?php

class myZend_Model_Mysql
{
	/*
	* A static mysqli object
	* This is appropriate as only one msqli instance is required 
	* throughout the run time of this process.
	*/
	protected static $mysqli = null;

	/*
	* Constructor Where the default connection information resides
	* A handle to the database is opened in this function,
	* If there is an error, Note this will fail
	*/
	public function __construct()
	{
		if (self::$mysqli === null)
		{
			$config = new Zend_Config_Ini('../application/configs/database.ini', 'production');

			$mysql_host             = $config->database->param->host;
			$mysql_username         = $config->database->param->username;
			$mysql_password         = $config->database->param->password;
			$mysql_database         = $config->database->param->database;

			self::$mysqli = @new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);

			//If there is a connection error
			//Insert the 500-db Error Page and exit all the below scripts
			if (self::$mysqli->connect_error)
			{
				throw new Exception("Cannot Connect to the Database");
				//exit();
			}
		}

	}

	/*
	* This function is a shorthad for running queries
	*
	* @param string $query - The query String
	*
	* @returns [array(), null] - If there are results then return array otherwise null
	*/
	public function getQuery($query)
	{

		//Perform the Query
		if ($result = self::$mysqli->query($query))
		{
			//This is when nothing is returned
			if ($result === true) { return true; }

			//There are no records, Therefore exit
			if (@$result->num_rows == 0) { return null; }

			//Add to the array variable
			while ($row = $result->fetch_object()){ $ar[] = $row; }

			return $ar;

			//Close the result
			$result->close();
		}

		//Some thing went wrong throw an exception
		else { throw new Exception(self::$mysqli->error . "Query: $query"); }
	}

        public function escape($string)
        {
            return self::$mysqli->real_escape_string($string);
        }   

	public function info()
	{
		return self::$mysqli->info;
	}

	/*
	 * Free up resources
	 *  - Close mysqli
	 */
	public function __destruct()
	{
		//self::$mysqli->close();
	}
}

?>
