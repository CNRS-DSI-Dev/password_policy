<?php

class OC_Password_Policy {
	
	public static function testPassword($password){
		//admin can set any password
		if(OC_User::isAdminUser(OC_User::getUser()))
		{
			return true;
		}
		
		//test length
		if(strlen($password)< OC_Password_Policy::getMinLength())
		{
			return false;
		}
		
		//test special characters
		if(OC_Password_Policy::getSpecialChars())
		{
			$special_chars = OC_Password_Policy::getSpecialCharsList();
			
			if(!checkSpecialChars($special_chars,$password))
			{
				return false;
			}
		}
		
		//test Mixed case
		if(OC_Password_Policy::getMixedCase())
		{
			if(!checkMixedCase($password))
				return false;
		}
		
		//test Numbers
		if(OC_Password_Policy::getNumbers())
		{
			if(preg_match("/[0-9]/",$password)!=1)
				return false;
		}
		
		return true;
	}
	
	public static function setMinLength($limit){
		
		//check if record already exists
		$sql = "select * from `*PREFIX*password_policy_items` where id=1";
		$query = OCP\DB::prepare($sql);
		$result = $query->execute();
		
		if ($row = $result->fetchRow()){
			//update
			$sql = "update `*PREFIX*password_policy_items` set min_length=? where id=1";
		}
		else
		{//insert new
			$sql = "insert into `*PREFIX*password_policy_items` (min_length) values (?)";
		}
		
		$query = OCP\DB::prepare($sql);
		$query->bindParam(1, $limit, \PDO::PARAM_INT);
		$result = $query->execute();	
	}
	
	public static function setSpecialCharsList($list){
		//check if record already exists
		$sql = "select * from `*PREFIX*password_policy_items` where id=1";
		$query = OCP\DB::prepare($sql);
		$result = $query->execute();
		
		if ($row = $result->fetchRow()){
			//update
			$sql = 'update `*PREFIX*password_policy_items` set specialcharslist=? where id=1';
		}
		else
		{//insert new
			
			$sql = 'insert into `*PREFIX*password_policy_items` (specialcharslist) values (?)';
		}
		
		$query = OCP\DB::prepare($sql);
		$query->bindParam(1, $list, \PDO::PARAM_STR);
		$result = $query->execute();	
	}
	
	public static function setSpecialChars($specialcharsrequired)
	{
		$sql = "select * from `*PREFIX*password_policy_items` where id=1";
		$query = OCP\DB::prepare($sql);
		$result = $query->execute();
		
		if ($row = $result->fetchRow()){
			//update
			$sql = "update `*PREFIX*password_policy_items` set specialcharacters=? where id=1";
		}
		else
		{//insert new
			$sql = "insert into `*PREFIX*password_policy_items` (specialcharacters) values (?)";
		}
		
		$query = OCP\DB::prepare($sql);
		$query->bindParam(1, $specialcharsrequired, \PDO::PARAM_INT);
		$result = $query->execute();	
	}
	
	public static function setMixedCase($mixedcase)
	{
		$sql = "select * from `*PREFIX*password_policy_items` where id=1";
		$query = OCP\DB::prepare($sql);
		$result = $query->execute();
		
		if ($row = $result->fetchRow()){
			//update
			$sql = "update `*PREFIX*password_policy_items` set mixedcase=? where id=1";
		}
		else
		{//insert new
			$sql = "insert into `*PREFIX*password_policy_items` (mixedcase) values (?)";
		}
		
		$query = OCP\DB::prepare($sql);
		$query->bindParam(1, $mixedcase, \PDO::PARAM_INT);
		$result = $query->execute();	
	}

	public static function setNumbers($numbers)
	{
		$sql = "select * from `*PREFIX*password_policy_items` where id=1";
		$query = OCP\DB::prepare($sql);
		$result = $query->execute();
		
		if ($row = $result->fetchRow()){
			//update
			$sql = "update `*PREFIX*password_policy_items` set numbers=? where id=1";
		}
		else
		{//insert new
			$sql = "insert into `*PREFIX*password_policy_items` (numbers) values (?)";
		}
		
		$query = OCP\DB::prepare($sql);
		$query->bindParam(1, $numbers, \PDO::PARAM_INT);
		$result = $query->execute();	
	}
	
	public static function getMinLength(){
		$sql = 'SELECT * FROM `*PREFIX*password_policy_items` WHERE id =1';

		$query = \OCP\DB::prepare($sql);
		$result = $query->execute();
		
		//default to 15
		$min_length = 15;
		
		while($row = $result->fetchRow()) {
			$min_length = $row['min_length'];
		}
		
		return $min_length;
	}
	
	public static function getSpecialCharsList(){
		$sql = 'SELECT * FROM `*PREFIX*password_policy_items` WHERE id =1';

		$query = \OCP\DB::prepare($sql);
		$result = $query->execute();
		
		//default special chars list
		$specialcharslist = "";
		
		while($row = $result->fetchRow()) {
			$specialcharslist = $row['specialcharslist'];
		}
		
		return $specialcharslist;
	}
	
	public static function getSpecialChars(){
		$sql = 'SELECT * FROM `*PREFIX*password_policy_items` WHERE id =1';

		$query = \OCP\DB::prepare($sql);
		$result = $query->execute();
		
		//default special chars list
		$specialcharslist = true;
		
		while($row = $result->fetchRow()) {
			$specialcharacters = $row['specialcharacters'];
		}
		
		return $specialcharacters;
	}
	
	public static function getMixedCase(){
		$sql = 'SELECT * FROM `*PREFIX*password_policy_items` WHERE id =1';

		$query = \OCP\DB::prepare($sql);
		$result = $query->execute();
		
		//default special chars list
		$mixedcase = true;
		
		while($row = $result->fetchRow()) {
			$mixedcase = $row['mixedcase'];
		}
		
		return $mixedcase;
	}
	
	public static function getNumbers(){
		$sql = 'SELECT * FROM `*PREFIX*password_policy_items` WHERE id =1';

		$query = \OCP\DB::prepare($sql);
		$result = $query->execute();
		
		//default special chars list
		$numbers = true;
		
		while($row = $result->fetchRow()) {
			$numbers = $row['numbers'];
		}
		
		return $numbers;
	}
}

function checkSpecialChars($special, $input)
{

        for($i=0;$i<strlen($special);$i++)
        {
                $x=substr ($special, $i, 1);

                if(strstr($input,$x))
                {
                        return true;
                }
        }

        return false;
}

function checkMixedCase($input)
{
        if(strtoupper($input) == $input || strtolower($input) == $input)
                return false;
        else
                return true;
}