<?php
class DB
{
	//glabal $DB;
/*
	protected $link;
	protected $dbtype    = 'mysqli';
	protected $dblibrary = 'native';
	protected $dbhost    = 'fdb4.freehostingeu.com';
	protected $dbname    = '1261695_base01';
	protected $dbuser    = '1261695_base01';
	protected $dbpass    = 'base01@AZERTY';*/
	
protected $link;
	protected $dbtype    = 'mysqli';
	protected $dblibrary = 'native';
	protected $dbhost    = 'localhost';
	protected $dbname    = 'LocalDB';
	protected $dbuser    = 'root';
	protected $dbpass    = '';

	function __construct(){
	// Establish the connection with DB.
		$this->link = mysql_connect($this->dbhost,$this->dbuser,$this->dbpass);
		if(!$this->link) die('Not connected : '.mysql_error());
		$this->select_db($this->dbname);
    }
    
    // verification if the database exist .
	public function db_exist($name)
	{
		if(!empty($name))
		{
		$db_selected = mysql_select_db($name,$this->link);
		if(!$db_selected) die('can t use '.$name.' : '.mysql_error());
		}
	}

	public function select_db($name)
	{
		if(!empty($name))
		{
			if(!mysql_select_db($name,$this->link)) die('can t use '.$name.' : '.mysql_error());
		}
	}

	//creation of the database if not exists.
	public function create_db($name)
	{   
		if(!empty($name))
		{
			$sql = 'CREATE DATABASE IF NOT EXISTS '.$name;
			if (mysql_query($sql,$this->link)) {
			    echo "Database ".$name." created successfully. \n";
			} else {
			    die('Error creating database: ' . mysql_error() . "\n"); 
			}
		}
		else echo 'give the new db a name';
    }
    
	//verification if table exist.
	public function table_exist($tableName)
	{

	}

	public function create_table($name,$obj)
	{
		// Object 
	}

	public function drop_table($name)
	{

	}

	public function get_records($table)
	{
		
	}
	

	public function get_recordById($table,$id)
	{
		if(!empty($table) && !empty($id))
		{
			$sql="SELECT * FROM ".$table." WHERE id=".$id;
			if($resource_sql=mysql_query($sql,$this->link)) //echo get_resource_type($data);
			{
				$array = mysql_fetch_array($resource_sql, MYSQL_ASSOC);
				$obj = new stdClass();
				$obj=(object)$array;
				return $obj;
			}
			else die('Fialed to get All Records in table '.$table.'  '.mysql_error());
		}
		else echo 'table name needed.';
	}

	protected function construct_sql_select($obj,$lgc=NULL)
	{
		if(!is_array($obj)) $obj=(array)$obj;
		$keys = array_keys($obj);       // list of the keys.
        $values = array_values($obj);   // list of the values.
        
        $K_length = count($keys); 
        $sql="";
        for($i=0; $i< $K_length; $i++) 
		{
			if(is_bool($values[$i]) || is_numeric($values[$i]) || is_null($values[$i]))
			{
				if($i == $K_length-1) $sql.="`".$keys[$i]."`=".$values[$i]."";
			    else $sql.="`".$keys[$i]."`=".$values[$i]." ".$lgc." ";
			}
			else
			{
			if($i == $K_length-1) $sql.="`".$keys[$i]."`='".$values[$i]."'";
			else $sql.="`".$keys[$i]."`='".$values[$i]."' ".$lgc." ";
			}
		}
		return $sql;
	}

	public function get_record_where($table,$where,$lgc=NULL)
	{
		if(!empty($table) && !empty($where))
		{
		$sql="SELECT * FROM ".$table." WHERE ".$this->construct_sql_select($where,$lgc);
	//		echo '<br>'.$sql;
		if($resource_sql=mysql_query($sql,$this->link)) //echo get_resource_type($data);
			{
				if(!$array = mysql_fetch_array($resource_sql, MYSQL_ASSOC)) return NULL;
				else
				{
				$obj = new stdClass();
				$obj=(object)$array;
				return $obj;
				}
			}
			else die('Fialed to get All Records in table '.$table.'  '.mysql_error());
		}
	}

	public function get_max_id($table)
	{
		if(!empty($table))
		{
		$sql="SELECT max(id) as id FROM ".$table;
	//		echo '<br>'.$sql;
		if($resource_sql=mysql_query($sql,$this->link)) //echo get_resource_type($data);
			{
				if(!$array = mysql_fetch_array($resource_sql, MYSQL_ASSOC)) return NULL;
				else
				{
				$obj = new stdClass();
				$obj=(object)$array;
				return $obj;
				}
			}
			else die('Fialed to get All Records in table '.$table.'  '.mysql_error());
		}
	}

	public function get_array_id_where($table,$where)
	{
		$i=0;
		$arrayOfIDs = array();
		if(!empty($table)  && !empty($where))
		{
			
			$sql="SELECT id FROM ".$table." WHERE id_club=".$where;
	//		echo '<br>'.$sql;
		if($resource_sql=mysql_query($sql,$this->link)) //echo get_resource_type($data);
			{
				while ($row = mysql_fetch_array($resource_sql, MYSQL_ASSOC))
				{
					$arrayOfIDs[$i] = $row['id'];
					$i++;
				}
					$obj = new stdClass();
					$obj=(object)$arrayOfIDs;
					return $obj;
			}
			else die('Fialed to get All Records in table '.$table.'  '.mysql_error());
		}
	}

	public function get_array_id($table)
	{
		$i=0;
		$arrayOfIDs = array();
		if(!empty($table))
		{
			
			$sql="SELECT id FROM ".$table;
	//		echo '<br>'.$sql;
		if($resource_sql=mysql_query($sql,$this->link)) //echo get_resource_type($data);
			{
				while ($row = mysql_fetch_array($resource_sql, MYSQL_ASSOC))
				{
					$arrayOfIDs[$i] = $row['id'];
					$i++;
				}
					$obj = new stdClass();
					$obj=(object)$arrayOfIDs;
					return $obj;
			}
			else die('Fialed to get All Records in table '.$table.'  '.mysql_error());
		}
	}

	public function get_club_id($table)
	{
		$i=0;
		$arrayOfIDs = array();
		if(!empty($table))
		{
			
			$sql="SELECT nom_club FROM ".$table;
	//		echo '<br>'.$sql;
		if($resource_sql=mysql_query($sql,$this->link)) //echo get_resource_type($data);
			{
				while ($row = mysql_fetch_array($resource_sql, MYSQL_ASSOC))
				{
					$arrayOfIDs[$i] = $row['nom_club'];
					$i++;
				}
					$obj = new stdClass();
					$obj=(object)$arrayOfIDs;
					return $obj;
			}
			else die('Fialed to get All Records in table '.$table.'  '.mysql_error());
		}
	}
	protected function construct_sql_insert($obj)
	{
		if(!is_array($obj)) $obj=(array)$obj;
		$keys = array_keys($obj);       // list of the keys.
        $values = array_values($obj);   // list of the values.
        
        $K_length = count($keys);       // length of the array $obj.
        //constructing the sql query.
		$sql="(";

		for($i=0; $i< $K_length; $i++)
		{
			if($i == $K_length-1) $sql.="`".$keys[$i]."`";
			else $sql.="`".$keys[$i]."`,";
		} 
		$sql.=") VALUES (";
		//In Values we decide to test the type ?? to correct the conflect of miss-match in database.
		// problem still exist 50% solved only.

		for($i=0; $i< $K_length; $i++) 
		{
			if(is_bool($values[$i]) || is_numeric($values[$i]) || is_null($values[$i]))
			{
				if($i == $K_length-1) $sql.="".$values[$i]."";
				else $sql.="".$values[$i].",";
			}
			else
			{
				if($i == $K_length-1) $sql.="'".$values[$i]."'";
				else $sql.="'".$values[$i]."',";
			}
		}
		$sql.=")";
		
		return $sql;
	}

	public function insert_record($table,$data)
	{
		if(!empty($table))
		{
			$sql = "INSERT INTO ".$table." ".$this->construct_sql_insert($data);
			if (mysql_query($sql,$this->link)) {
			    //echo "record saved successfully in table : ".$table."\n";
			    return true;
			} else {
			    die('Error inserting record : ' . mysql_error() . "\n"); 
			    return false;
			}
		}
		else echo 'give the table name.';
	}

	public function delete_recordByID($table,$id)
	{
		if(!empty($table) && !empty($id))
		{
		$sql="DELETE FROM ".$table." WHERE id=".$id;
		if(mysql_query($sql)) echo 'record with id : '.$id.' deleted.';
		else die('fialed to delete record id : < '.$id.' >'.mysql_error());
			}
	    else echo 'table or id needed.';
	}

	public function delete_record_where($table,$where)
	{

	}

	public function delete_all_records($table)
	{
		if(!empty($table))
		{
			$sql="DELETE FROM ".$table." WHERE id>=0";
			if(mysql_query($sql)) echo 'table '.$table.' is Empty.';
			else die('fialed to delete All Record in table '.$table.'  '.mysql_error());
		}
		else echo 'table name needed.';
	}

	public function drop_db($name)
	{  
		if(!empty($name))
		{
		$sql='DROP DATABASE IF EXISTS '.$name;
			if(mysql_query($sql,$this->link)) echo $name.' deleted.';
			else echo 'nothing';
		}
		else echo 'name the DB want to delete';
	}

	public function disconnect()
	{
		mysql_close($this->link);
	}

	public function test($obj)
	{
		echo $obj;
	}

	protected function construct_sql_update($obj,$where,$lgc=NULL)
	{
		if(!is_array($obj)) $obj=(array)$obj;
		if(!is_array($where)) $where=(array)$where;
		//$lgc two values : OR/AND  ==> after where x=x (OR/AND) y=y ...***** ???
		// if($lgc=='AND') 
		// $obj (data going to be in the database sooner.... )
		$keys = array_keys($obj);       // list of the keys.
        $values = array_values($obj);   // list of the values.
        
        // $where (locating the record that we want to modifie...)
        $w_keys = array_keys($where);       // list of the keys.
        $w_values = array_values($where);   // list of the values.

        $K_length = count($keys);           // length of the array $obj.
        $w_length = count($w_keys);
        // Constructing the SQL query.
		$sql="";

		for($i=0; $i< $K_length; $i++)
		{
			if(is_bool($values[$i]) || is_numeric($values[$i]) || is_null($values[$i]))
			{
				if($i == $K_length-1) $sql.="`".$keys[$i]."`=".$values[$i]."";
			    else $sql.="`".$keys[$i]."`=".$values[$i].",";
			}
			else
			{
			if($i == $K_length-1) $sql.="`".$keys[$i]."`='".$values[$i]."'";
			else $sql.="`".$keys[$i]."`='".$values[$i]."',";
			}
		}
		$sql.=" WHERE ";
		for($i=0; $i< $w_length; $i++) 
		{
			if(is_bool($w_values[$i]) || is_numeric($w_values[$i]) || is_null($w_values[$i]))
			{
				if($i == $w_length-1) $sql.="`".$w_keys[$i]."`=".$w_values[$i]."";
			    else $sql.="`".$w_keys[$i]."`=".$w_values[$i]." ".$lgc." ";
			}
			else
			{
			if($i == $w_length-1) $sql.="`".$w_keys[$i]."`='".$w_values[$i]."'";
			else $sql.="`".$w_keys[$i]."`='".$w_values[$i]."' ".$lgc." ";
			}
		}
		
		return $sql;
	}
	// $lgc is the (and - or) logical connector used after where when $where brought more then one value.
	public function update_record($table,$data,$where,$lgc=NULL)
	{
		if(!empty($table) && !empty($where))
		{
			$sql="UPDATE ".$table." SET ".$this->construct_sql_update($data,$where,$lgc);
			//echo '<br>'.$sql.'<br>';
			if (mysql_query($sql,$this->link))
			{
				//echo "record updated successfully in table : ".$table."\n";
				return true;
			}
			else
			{
			    die('Error updating record : ' . mysql_error() . "\n"); 
				return false;
			}
		}
		else echo 'give the table name.';
	}
}

?>
