<?php

	include("session.php");
	date_default_timezone_set('America/Chicago'); 
	
	//*******************User Functions********************
	//redirects a user if not logged in back to index.php
	function loginRedirect($session)
	{
		if(!$session->logged_in)
			header("Location: index.php");
	}
	
	//redirects a user if not an admin back to index.php
	function adminRedirect($session)
	{
		if(!$session->isAdmin())
			header("Location: index.php");
	}
	
	//adds a new user
	function addNewUser($username, $password, $email, $userLevel,$rate)
	{
		$time = time();
		$rand = rand(0,1000);
			$sql = "INSERT INTO ".TBL_USERS." VALUES (NULL,'$username', '$password', '$rand', $userLevel, '$email', '$time', '$rate')";
			dbQuery($sql);
	   }
	   
	   //returns an array of all users
	   function getUsers()
	   {
			$query = "select id,username from users";
			$result = dbQuery($query);
			
			while($rows[] = mysql_fetch_assoc($result));
			array_pop($rows); // pop the last row off, which is an empty row
			
			return $rows;
	   }
	   
	   //returns a lookup table of id,names for the users
	   function userLookupTable()
	   {
			$query = "select id, username from users";
			$result = dbQuery($query);
			
			$lookupTable = array();
			while($row=mysql_fetch_array($result))
			{
				$lookupTable[(int)$row['id']]=$row['username'];;
			}
			
			return $lookupTable;
	   }
	   
	   //returns the cost of a tech as a number value
	   //takes a tech's id as an argument
	   function techCostLookup($id)
	   {
			$query = "select rate from users where id=$id";
			$result = dbQuery($query);
			
			return mysql_result($result,0,'rate');
	   
	   }
	   
	   //returns a tech's ID from their id
	   function techIDtoName($id)
	   {
			$query = "select username from users where id=$id";
			$result=dbQuery($query);
			
			return mysql_result($result,0,'username');
	   
	   }
	   
	   //returns a tech's ID from their username
	   function techNametoID($name)
	   {
			$query = "select id from users where username=$name";
			$result = dbQuery($result);
			
			return mysql_result($result,0,'id');
	   }
	   

		//*******************Generic Functions********************	
		//returns the number of pages a table would require to display
		function countPages($tableName)
		{
			$query = "Select count(*) from $tableName";
			$result = dbQuery($query);
			$count = mysql_result($result,0,'count(*)');
			$pageCount = ceil($count/ROWS_PER_PAGE);
			
			return $pageCount;
			
		}
		
		
		//*******************Reporting Functions********************	
		//Returns # of incidents in a month, total time spent, teh total
		//income, and the approximate profit
		//takes a monthlyIncidents array as an argument
		function monthlyOverviewReport($monthlyIncidents)
		{
			
			$return = array ('totalIncidents' => 0, 'totalTime' =>0, 'estimatedIncome' => 0, 'estimatedCost' => 0);
			$totalIncidents = 0;
			$estimatedCost =0;
			$totalTime = 0;
			
			for($i=0; $i<count($monthlyIncidents); $i++)
			{
				$thisTech = $monthlyIncidents[$i];
				$thisTechCost = techCostLookup($thisTech['tech']);
				
				$totalTime += round($thisTech['sum(timeSpent)'],2);
				$totalIncidents += $thisTech['COUNT(id)'];	
				$estimatedCost += (round($thisTech['sum(timeSpent)'],2) * $thisTechCost);
			}
			
			$return['totalIncidents'] = $totalIncidents;
			$return['totalTime'] = $totalTime;
			$return['estimatedIncome'] = $totalIncidents * INCIDENT_BILLABLE_RATE;
			$return['estimatedCost'] = $estimatedCost;
			
			return $return;
			
		}
		
		
		//*******************Plan Functions********************	
		//creates a lookup table array of the plans
		function planLookupTable()
		{
			$query = "select id, name, numberOfIncidents from plans";
			$result = dbQuery($query);
			
			$lookupTable = array();
			while($row=mysql_fetch_array($result))
			{
				$rowArray['name'] = $row['name'];
				$rowArray['numberOfIncidents'] = $row['numberOfIncidents'];
				$lookupTable[(int)$row['id']]=$rowArray;
			}
			
			return $lookupTable;
		}
		
		//returns an array of all the plan id and names
		function getPlans()
		{
			$query = "select id,name from plans";
			$result = dbQuery($query);
			
			while($rows[] = mysql_fetch_assoc($result));
			array_pop($rows); // pop the last row off, which is an empty row
			
			return $rows;
		}
		
		//*******************Client Functions********************	
		//adds new client
		function addClient($companyName, $clientName, $email, $reportsID, $plan)
		{
			$query = "INSERT INTO clients (
				id, companyName, clientName, email, reportsID, plan) 
				VALUES 
				(NULL, 
				'$companyName', 
				'$clientName', 
				'$email', 
				'$reportsID', 
				'$plan')";
				
			$result = dbQuery($query);
		
		}
			
		//returns an array of all the client id and names
		function getClients()
		{
			$query = "select id,companyName from clients order by companyName";
			$result = dbQuery($query);
			
			while($rows[] = mysql_fetch_assoc($result));
			array_pop($rows); // pop the last row off, which is an empty row
			
			return $rows;
		}
		
		//returns the name of a company from its ID
		function idToCompanyName($id)
		{
			$id = inputCleaner($id);
			$query = "Select companyName from clients where id=$id";
			$result = dbQuery($query);
			return mysql_result($result,0,'companyName');
		}
		
		//returns a lookup table of the companies in the db
		function companyLookupTable()
		{
			$query = "select id, companyName from clients";
			$result = dbQuery($query);
			
			$lookupTable = array();
			while($row=mysql_fetch_array($result))
			{
				$lookupTable[(int)$row['id']]=$row['companyName'];;
			}
			
			return $lookupTable;
		}

		//returns an array of the client that match the search terms
		//or all clients
		function searchClients($searchType,$companySearchNeedle,$clientSearchNeedle)
		{
			$companySearchNeedle = inputCleaner($companySearchNeedle);
			$clientSearchNeedle = inputCleaner($clientSearchNeedle);
			switch($searchType)
			{
				case 'all':
				default:
					$query = "select * from clients order by id";
					break;
				
				case 'both':
					$query = "Select * from clients where companyName like \"%$companySearchNeedle%\" and 
					clientName like \"%$clientSearchNeedle%\"";
					break;
				
				case 'company':
					$query = "Select * from clients where companyName like \"%$companySearchNeedle%\"";
					break;
				
				case 'client':
					$query = "Select * from clients where clientName like \"%$clientSearchNeedle%\"";
					break;		
			}
			$queryResult = dbQuery($query);
			while($rows[] = mysql_fetch_assoc($queryResult));
			array_pop($rows); // pop the last row off, which is an empty row
			return $rows;
		}
		
		//Returns the number of remaining incidents a client has. May return negative if customer has
		//used over their plan amount
		function remainingIncidents($companyID,$planIncidents)
		{
			# Get Month in words
			$month = date("M");

			# Get Year
			$year = date("Y");
			
			$thisMonthIncidents = monthlyIncidents($companyID, $month, $year);
			
			$thisMonthRemaining = $planIncidents - $thisMonthIncidents;
			
			return $thisMonthRemaining;

		}
		
		//returns total used incidents for a company
		//send it month in text - i.e. March, April, May
		//year should be a 4 digit int - i.e. 2012, 2013
		//If companyID = =, returns an array of months incidents
		function monthlyIncidents($companyID,$month,$year)
		{

			# Get Epoch of first day of above month and year
			$firstOfMonth = strtotime("01 $month $year");
			$now = strtotime("now");

			if($companyID == 0)
			{
				switch($month)
				{
					case "September":
					case "April":
					case "June":
					case "November":
						$endOfMonth = strtotime("30 $month $year");
						break;
					
					case "February":
						if((date('L',strtotime("$year-01-01"))) == 1)
							$endOfMonth = strtotime("29 $month $year");
						else
							$endOfMonth = strtotime("28 $month $year");
						break;
					
					default:
						$endOfMonth = strtotime("31 $month $year");
				}
				
				$query = "
					SELECT 
						COUNT(id), sum(timeSpent), tech
					FROM 
						incidents 
					WHERE 
						timestamp BETWEEN $firstOfMonth AND $endOfMonth
					GROUP BY
						tech";
							
				$queryResult = dbQuery($query);
				while($rows[] = mysql_fetch_assoc($queryResult));
				array_pop($rows); // pop the last row off, which is an empty row
				return $rows;
			}
			else
			{
				$query = "
						SELECT 
							COUNT(id) 
						FROM 
							incidents 
						WHERE 
							timestamp BETWEEN $firstOfMonth AND $now
						AND
							clientID=$companyID
					";
					
				$result = dbQuery($query);
				$row=mysql_fetch_array($result);
				return $row['COUNT(id)'];
			}
		}
		
		//records an incident
		function addIncident($timestamp,$requestor,$reportsProject,$reportsID,$timeSpent,
			$description,$techID,$clientID)
		{
			$query = "INSERT INTO 
				incidents 
					(id, timestamp, requestor, reportsProject, reportsID, 
					timeSpent, description, tech, clientID) 
				VALUES (NULL, 
				'$timestamp', 
				'$requestor', 
				'$reportsProject', 
				'$reportsID', 
				'$timeSpent', 
				'$description', 
				'$techID', 
				'$clientID')";
				
			return dbQuery($query);
				
				
		}
		
		
		//edits a preexisting incident
		//takes the incident ID and all the incident info as an argument
		function editIncident($id,$timestamp,$requestor,$reportsProject,$reportsID,$timeSpent,$description,
				$techID,$clientID)
		{
			$query = "UPDATE incidents SET 
				timestamp = '$timestamp',
				requestor = '$requestor',
				reportsProject = '$reportsProject',
				reportsID = '$reportsID',
				timeSpent = $timeSpent,
				tech = '$techID',
				clientID = '$clientID',
				description = '$description' 
				WHERE id =$id";
				
				return dbQuery($query);
		}
		
		//returns an array of incidents based on search terms entered
		//returns paginated results, 200 per page
		function searchIncidents($typeOfSearch,$clientID,$startDate,$stopDate,$techID,$page)
		{
			$min = ($page - 1) * ROWS_PER_PAGE;
			$max = $page * ROWS_PER_PAGE;
			
			switch($typeOfSearch)
			{
				case 'all':
				default:
					$query = "select * from incidents order by timestamp limit $min,$max";
					break;
				case 'client':
					$query = "select * from incidents where clientID=$clientID order by timestamp limit $min,$max";
					break;
				case 'date':
					$query = "select * from incidents where timestamp between $startDate AND $stopDate order by timestamp
						limit $min,$max";
					break;
				case 'tech':
					$query = "select * from incidents where tech=$techID order by timestamp limit $min,$max";
					break;
				case 'clientdatetech':
					$query = "select * from incidents where clientID=$clientID and tech=$techID and timestamp between 
						$startDate AND $stopDate order by timestamp limit $min,$max";
					break;
				case 'clientdate':
					$query = "select * from incidents where clientID=$clientID and timestamp between 
						$startDate AND $stopDate order by timestamp limit $min,$max";
						break;
				case 'clienttech':
					$query = "select * from incidents where clientID=$clientID and tech=$techID order by timestamp limit $min,$max";
					break;
				case 'datetech':
					$query = "select * from incidents where tech=$techID and timestamp between $startDate and $stopDate order by timestamp
						limit $min,$max";
					break;
			}
		
			$queryResult = dbQuery($query);
			while($rows[] = mysql_fetch_assoc($queryResult));
			array_pop($rows); // pop the last row off, which is an empty row
			return $rows;
		}
		
		//returns an array of the data for a specific incident
		//requires an incident ID as an argument
		function getIncident($id)
		{
			$query = "Select * from incidents where id=$id";
			$result = dbQuery($query);
			return mysql_fetch_assoc($result);
		}
		

		//******************Computer Functions********************
		//Functions related to the inventory functions of SAC portal
		
		//Returns an array of the clients computers in inventory
		function getClientWorkstations($id)
		{
			$query = "select id,computerName from computers where clientID=$id order by id";
			$result = dbQuery($query);
			
			while($rows[] = mysql_fetch_assoc($result));
			array_pop($rows); // pop the last row off, which is an empty row
			
			return $rows;
		}

		//Returns an array of the data about a workstation for the given ID
		function getWorkstation($id)
		{
			$query = "select * from computers where id=$id";
			$result = dbquery($query);
			
			while($rows[] = mysql_fetch_assoc($result));
			array_pop($rows); // pop the last row off, which is an empty row
			
			return $rows[0];

		}

		//Returns the computer name for an ID
		function computerIDToName($id)
		{
			$query="select computerName from computers where id=$id";
			$result = dbquery($query);
			return mysql_result($result,0,'computerName');
			

		}
		
		//Returns an array of the stats  about a workstation for the given ID
		function getWorkstationStats($id,$dateDiff)
		{

			if($dateDiff > 0)
				$query = "
					SELECT *
					FROM computerStats
					WHERE computerID =$id
					AND DATEDIFF( CURDATE( ) , date ) <60
				";
			else
				$query = "select * from computerStats WHERE
					computerID=$id";

			$result = dbquery($query);
			
			while($rows[] = mysql_fetch_assoc($result));
			array_pop($rows); // pop the last row off, which is an empty row
			
			return $rows;

		}

		//Prcoesses the InitialINventory files generated by the inventory batch
		//and adds them to the database.
		function initialInventoryProcessor($filePath,$id)
		{
			$data = split("\n",file_get_contents($filePath));


			for($i=0; $i<count($data); $i++)
			{
				$array = split(": ", $data[$i]);
				$data[$i] = trim($array[1]);
			}
			
			$data[2] = substr($data[2],0,8);
			$data[16] = $data[18];
			array_pop($data);
			array_pop($data);
			array_pop($data);
			
			if(stripos($data[1],"XP") > 0)
			{
				$data2 = $data;
				$data[8] = "32-bit";
				for($i=8;$i<count($data2);$i++)
				{
					$data[$i+1] = $data2[$i];
				}
			}
			print_r($data);
			addWorkstation($data,$id);			

		}
		
	//Adds a workstation to the inventory 
	function addWorkstation($workstationData,$companyID)
	{
		
		$query = "INSERT INTO computers
		 (id, clientID, computerName, os, installDate, mfg, 
		serial, systemDrive, osDirectory, numOfUsers, osArch, 
		moboMfg, moboModel, biosMFG, biosVer, memory, cpu, 
		cpuSpeed, totalDisk) 
		VALUES (NULL,
		$companyID,
		";
		for($i=0; $i<count($workstationData); $i++)
		{
			if($i==count($workstationData)-1)
				$query .= "'" . $workstationData[$i]. "'";
			else
				$query .= "'" . $workstationData[$i] ."',";
		}
		$query .= ")";
		dbQuery($query);

	}

	function editWorkstation($workstationData, $workstationID)
	{

		$query = "UPDATE computers set
			computerName='".$workstationData['computerName']."',
			os='".$workstationData['OS']."',
			osArch='".$workstationData['arch']."',
			installDate='".$workstationData['installYear']
				."-".$workstationData['installMonth']
				."-".$workstationData['installDay']."',
			mfg='".$workstationData['mfg']."',
			serial='".$workstationData['serial']."',
			systemDrive='".$workstationData['systemDrive']."',
			osDirectory='".$workstationData['osDirectory']."',
			numOfUsers=".$workstationData['numberOfUsers'].",
			moboMfg='".$workstationData['moboMFG']."',
			moboModel='".$workstationData['moboModel']."',
			biosMFG='".$workstationData['biosMFG']."',
			biosVer='".$workstationData['biosVer']."',
			memory=".$workstationData['memory'].",
			cpu='".$workstationData['cpu']."',
			cpuSpeed=".$workstationData['cpuSpeed'].",
			totalDisk=".$workstationData['diskSize']."
			where id=$workstationID";
			dbQuery($query);
	}	

		//Processes the Montly Stat files generated by the stats scripts
		//and adds that data to the database
		function monthlyStatProcessor($filePath,$id)
		{
			$file = split("\n",file_get_contents($filePath));
			$data = array_slice($file,1,-1);	

			for($i=0; $i<count($data); $i++)
			{			
				$data[$i] = split(",",$data[$i]);
				$lastReboot = split("\.", $data[$i][5]);
				$lastReboot = $lastReboot[0];
				$lastRebootDate = date_create($lastReboot);
				$data[$i][5] = date_format($lastRebootDate,'U');
			}
			if($data[count($data)-1][0] == null)
				array_pop($data);	
			addMonthlyStats($data, $id);
		}

		//adds monthly stat data to the database
		function addMonthlyStats($statData, $computerID)
		{
			for($i=0; $i<count($statData); $i++)
			{
				$statRow=$statData[$i];
		
				$query="INSERT INTO computerStats (id,
					computerID,date,time,diskUse,
					memoryUse,numberOfProcesses,lastReboot)
					VALUES (NULL, $computerID, ";
				for($x=0; $x<count($statRow); $x++)
				{
					if($x==count($statRow)-1)
						$query.="'".$statRow[$x]."')";
					else
						$query.="'".$statRow[$x]."',";
				}
				dbQuery($query);
			}

		}

	//generates a file output of a workstations info and stats 
	function generateStatsCSV($filePath, $computerID)
	{
		$workstationData = getWorkstation($computerID);
		$workstationStats = getWorkstationStats($computerID,0);

		if(file_exists($filePath))
			unlink($filePath);

		$file = fopen($filePath,"w");

		$dataString= "OS,".$workstationData['os']."\r\n";
		$dataString.="Architecture,".$workstationData['osArch']."\r\n";
		$dataString.="Install Date,".$workstationData['installDate']."\r\n";
		$dataString.="Workstation Manufacturer,".$workstationData['mfg']."\r\n";
		$dataString.="Serial,".$workstationData['serial']."\r\n";
		$dataString.="System Drive,".$workstationData['systemDrive']."\r\n";
		$dataString.="OS Directory,". $workstationData['osDirectory']."\r\n";
		$dataString.="Number of Users,". $workstationData['numOfUsers']."\r\n";
		$dataString.="Motherboard MFG,". $workstationData['moboMfg']."\r\n";
		$dataString.="Motherboard Model,".$workstationData['moboModel']."\r\n";
		$dataString.="Bios MFG,". $workstationData['biosMFG']."\r\n";
		$dataString.="Bios Version,". $workstationData['biosVer']."\r\n";
		$dataString.="Memory,".$workstationData['memory']."\r\n";
		$dataString.="CPU,".$workstationData['cpu']."\r\n";
		$dataString.="CPU Speed,".$workstationData['cpuSpeed']."\r\n";
		$dataString.="Disk Size,".$workstationData['totalDisk']."\r\n";
	
		$statsString="\r\n\r\ndate,time,Disk Use(%),Memory Use(%)".
			"Number of Processes,Last Reboot Time\r\n";	
		for($i=0; $i<count($workstationStats);$i++)
		{
			$thisRow=$workstationStats[$i];
			$date = $thisRow['date'];
			$time = $thisRow['time'];
			$mem = $thisRow['memoryUse'];
			$disk = $thisRow['diskUse'];
			$proc = $thisRow['numberOfProcesses'];
			$lastReboot = epochToHuman($thisRow['lastReboot']);

			$statsString.=$date.",".$time.",".$mem.",".$disk
				.",".$proc.",".$lastReboot."\r\n";
		}	
		
		fwrite($file,$dataString);
		fwrite($file,$statsString);
	
		fclose($file);
	}

	function getAverageStats($id,$time)
	{
		$query = "Select AVG(diskUse), AVG(memoryUse), 
			AVG(numberOfProcesses) from computerStats WHERE
			computerID=$id and time='$time'";
	
		$result = dbQuery($query);
		
		while($rows[] = mysql_fetch_assoc($result));
		array_pop($rows); // pop the last row off, which is an empty row
		
		return $rows[0];
	}
	
			
	//*******************Database Functions********************
	//connects to the database and performs a database query
	function dbQuery($query)
	{		
		mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysql_error());
		mysql_select_db(DB_NAME) or die(mysql_error());
		
		$result = mysql_query($query);
			if (!$result) {
				die('Could not query:' . mysql_error());
			}
		mysql_close();
		return $result;
	}
	
	//Check if magic qoutes is on then stripslashes if needed
	function inputCleaner($var)
	{
		mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysql_error());
		mysql_select_db(DB_NAME) or die(mysql_error());
		if (is_array($var)) {
			foreach($var as $key => $val) {
				$output[$key] = inputCleaner($val);
			}
		} else {
			$var = strip_tags(trim($var));
			if (function_exists("get_magic_quotes_gpc")) {
				$output = mysql_real_escape_string((get_magic_quotes_gpc())? stripslashes($var): $var);
			} else {
			$output = mysql_real_escape_string($var);
			}
		}
		if (!empty($output))
			return $output;
		mysql_close();
	}
	
	//*******************Time Functions********************
	//turns epoch time into human readable time
	function epochToHuman($epoch)
	{
		return date("m/d/Y h:i:s A", ($epoch));
	}
	
	//takes two epoch time inputs and returns the total time
	//between the two points in decimal formate
	//i.e 1hr 15min = 1.25hrs
	function totalTime($in,$out)
	{
		$seconds = ($out - $in);
		
		$minutes = $seconds / 60;
		
		$hours = $minutes % 60;
		
		$minutesRemain = $minutes - ($hours * 60);
		
		$minutesRemainDecimal = round(($minutesRemain / 60),2);
		
		return $hours + $minutesRemainDecimal;
		
	}

	//Misc functions
	function inputBoxSize($string)
	{
		$toReturn = 75;
		if(strlen($string) <= 70)
			$toReturn = strlen($string) + 5;

		echo $toReturn;
	}	
	

?>
