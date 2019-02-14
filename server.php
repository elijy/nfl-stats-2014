
<?php

$q = $_GET['q'];

if ($q == "sched") {
	Sched();
}else if ($q == "player") {
	$p = $_GET['p'];
	SearchPlayer($p);
} else if ($q == "team") {
	$t = $_GET['t'];
	SearchTeam($t);
} else if ($q == "leaders") {
	$p = $_GET['p'];
	if ($p == "passing") {
		LoadPassers();
	} else if ($p == "rushing") {
		LoadRushers();
	} else if ($p == "receiving") {
		LoadReceivers();
	} else if ($p == "defence-tck") {
		Load_D_By_Tckls();
	} else if ($p == "defence-int") {
		Load_D_By_Ints();
	} else if ($p == "defence-sck") {
		Load_D_By_Scks();
	} else if ($p == "kicking") {
		LoadKickers();
	}
} else if ($q == "addgame") {
	$hteam = $_GET['ht'];
	$ateam = $_GET['at'];
	$hscore = $_GET['hs'];
	$ascore = $_GET['as'];
	$date = $_GET['d'];
	$week = $_GET['w'];
	InsertGame($hteam, $ateam, $hscore, $ascore, $date, $week);
} else if ($q == "schedule") {
	$team = $_GET['t'];
	LoadSchedule($team);
} else if ($q == "roster") {
	$team = $_GET['t'];
	LoadRoster($team);
} else if ($q == "standings") {
	$conf = $_GET['c'];
	LoadStandings($conf);
} else if ($q == "updateplayer") {
	$pnum = $_GET['n'];
	$team = $_GET['t'];
	$pos = $_GET['p'];
	$stats = $_GET['s'];
	UpdatePlayer($pnum, $team, $pos, $stats);
} else if ($q == "compare") {
	$t1 = $_GET['t1'];
	$t2 = $_GET['t2'];
	CompareTeams($t1, $t2);
}

function Sched() {
	$servername = "localhost";
	$username = "root";
	$password = "bitnami";
	$dbname = "assignment3";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT * FROM  game WHERE weekNumber = 11 GROUP BY home,away";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    echo "<h2>Last Weeks Game</h2>";
	    echo "<table class='table table-striped'><th>Game Date</th><th>Home Team</th><th>Away Team</th><th>Home Score</th><th> Away Score</th>";
	    while($row = $result->fetch_assoc()) {
	        echo "<tr><td>" . $row["gameDay"]. "</td>";
	        echo "<td>" . $row["home"]. "</td>"; 
	        echo "<td>" . $row["away"]. "</td>";
	        echo "<td>" . $row["homeScore"]. "</td>";
	        echo "<td>" . $row["awayScore"]. "</td></tr>"; 
	    }
		echo "</table>";
	} else {
	    echo "0 results";
	}	
	
	$conn->close();
}

function SearchPlayer($playerName) {
	
	$servername = "localhost";
	$username = "root";
	$password = "bitnami";
	$dbname = "assignment3";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT * FROM player WHERE fname LIKE '%".$playerName."%' OR lname LIKE '%".$playerName."%' OR playerNo LIKE '%".$playerName."%'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    echo "<h2>Search Results</h2>";
	    echo "<table class='table table-striped'><th>First Name</th><th>Last Name</th><th>Position</th><th>Team</th><th>Player Number</th>";
	    while($row = $result->fetch_assoc()) {
	        echo "<tr><td>" . $row["fname"]. "</td>";
	        echo "<td>" . $row["lname"]. "</td>"; 
	        echo "<td>" . $row["position"]. "</td>";
	        echo "<td>" . $row["team"]. "</td>";
	        echo "<td>" . $row["playerNo"]. "</td></tr>"; 
	    }
		echo "</table>";
	} else {
	    echo "<br><br><br><div class='text-center alert alert-warning' role='alert'>".
   	 "<span class='glyphicon glyphicon-exclamation-sign'>".
   	 "</span> No Search Results. Please Try Again <span class='glyphicon glyphicon-exclamation-sign'></span></div>";
	}	
	
	$conn->close();
}

function SearchTeam($teamName) {
	
	$servername = "localhost";
	$username = "root";
	$password = "bitnami";
	$dbname = "assignment3";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT * FROM team WHERE teamName LIKE '%".$teamName."%' OR abb LIKE '%".$teamName."%'".
	" OR conference LIKE '%".$teamName."%' OR division  LIKE '%".$teamName."%'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    echo "<h2>Search Results</h2>";
	    echo "<table class='table table-striped'><th>Team Name</th><th>Abbr.</th><th>Conference</th>".
	    "<th>Division</th><th>Win</th><th>Loss</th><th>Tie</th><th>Pct.</th>";
	    while($row = $result->fetch_assoc()) {
	        echo "<tr><td>" . $row["teamName"]. "</td>";
	        echo "<td>" . $row["abb"]. "</td>"; 
	        echo "<td>" . $row["conference"]. "</td>";
	        echo "<td>" . $row["division"]. "</td>";
	        echo "<td>" . $row["win"]. "</td>"; 
	        echo "<td>" . $row["loss"]. "</td>";
	        echo "<td>" . $row["tie"]. "</td>";
	        echo "<td>" . $row["pct"]. "</td></tr>";
	    }
		echo "</table>";
	} else {
	    echo "<br><br><br><div class='text-center alert alert-warning' role='alert'>".
   	 "<span class='glyphicon glyphicon-exclamation-sign'>".
   	 "</span> No Search Results. Please Try Again <span class='glyphicon glyphicon-exclamation-sign'></span></div>";
	}	
	
	$conn->close();
}

function LoadPassers() {
	
	$servername = "localhost";
	$username = "root";
	$password = "bitnami";
	$dbname = "assignment3";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT p.fname, p.lname, p.position,p.team, b.*  FROM Player p INNER JOIN Pass b ON b.playerID = p.playerID ".
	"WHERE b.attempts > 100  ORDER BY b.yards desc  LIMIT 0, 10";
	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    $rank = 1;
	    echo "<h2>Top Passers (by yards)</h2>";
	    echo "<table class='table table-striped'><th>Rank</th><th>First Name</th><th>Last Name</th><th>Team</th><th class='text-warning'>Yards</th><th>Attempts</th><th>Completions</th>".
	    "<th>Percentage</th><th>Yards Per Attempt</th><th>Touchdowns</th><th>Interceptions</th><th>Sacks</th><th>Pass Rating</th>";
	    while($row = $result->fetch_assoc()) {
	        echo "<tr><td>" . $rank++ . "</td>";
	        echo "<td>" . $row["fname"]. "</td>";
	        echo "<td>" . $row["lname"]. "</td>"; 
	        echo "<td>" . $row["team"]. "</td>";
	        echo "<td class='text-warning'>" . $row["yards"]. "</td>";
	        echo "<td>" . $row["attempts"]. "</td>";
	        echo "<td>" . $row["completions"]. "</td>";
	        echo "<td>" . $row["percentage"]. "</td>";
	        echo "<td>" . $row["yardsPerAttempt"]. "</td>";
	        echo "<td>" . $row["touchdowns"]. "</td>";
	        echo "<td>" . $row["interceptions"]. "</td>";
	        echo "<td>" . $row["sacks"]. "</td>";
	        echo "<td>" . $row["rating"]. "</td></tr>";
	        	        
	    }
		echo "</table>";
	} else {
	    echo "<br><br><br><div class='text-center alert alert-danger' role='alert'>".
   	 "<span class='glyphicon glyphicon-exclamation-sign'>".
   	 "</span> Something Went Wrong :( <span class='glyphicon glyphicon-exclamation-sign'></span></div>";
	}	
	
	$conn->close();
}

function LoadRushers() {
	
	$servername = "localhost";
	$username = "root";
	$password = "bitnami";
	$dbname = "assignment3";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT p.fname, p.lname, p.position,p.team, b.*  FROM Player p INNER JOIN Rush b ON b.playerID = p.playerID ".
	"WHERE b.attempts > 100  ORDER BY b.yards desc  LIMIT 0, 10";
	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    $rank = 1;
	    echo "<h2>Top Rushers (by yards)</h2>";
	    echo "<table class='table table-striped'><th>Rank</th><th>First Name</th><th>Last Name</th><th>Team</th><th class='text-warning'>Yards</th><th>Attempts</th><th>Yards Per Carry</th>".
	    "<th>Yards Per Game</th><th>Longest Run</th><th>Touchdowns</th><th>Fubmles</th>";
	    while($row = $result->fetch_assoc()) {
	        echo "<tr><td>" . $rank++ . "</td>";
	        echo "<td>" . $row["fname"]. "</td>";
	        echo "<td>" . $row["lname"]. "</td>"; 
	        echo "<td>" . $row["team"]. "</td>";
	        echo "<td class='text-warning'>" . $row["yards"]. "</td>";
	        echo "<td>" . $row["attempts"]. "</td>";
	        echo "<td>" . $row["average"]. "</td>";
	        echo "<td>" . $row["yardsPerGame"]. "</td>";
	        echo "<td>" . $row["lng"]. "</td>";
	        echo "<td>" . $row["touchdowns"]. "</td>";
	        echo "<td>" . $row["fumbles"]. "</td></tr>";
	        	        
	    }
		echo "</table>";
	} else {
	    echo "<br><br><br><div class='text-center alert alert-danger' role='alert'>".
   	 "<span class='glyphicon glyphicon-exclamation-sign'>".
   	 "</span> Something Went Wrong :( <span class='glyphicon glyphicon-exclamation-sign'></span></div>";
	}	
	
	$conn->close();
}

function LoadReceivers() {
	
	$servername = "localhost";
	$username = "root";
	$password = "bitnami";
	$dbname = "assignment3";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT p.fname, p.lname, p.position,p.team, b.*  FROM Player p INNER JOIN Recieve b ON b.playerID = p.playerID ".
	"ORDER BY b.yards desc  LIMIT 0, 10";
	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    $rank = 1;
	    echo "<h2>Top Receivers (by yards)</h2>";
	    echo "<table class='table table-striped'><th>Rank</th><th>First Name</th><th>Last Name</th><th>Team</th><th class='text-warning'>Yards</th><th>Receptions</th><th>Yards Per Catch</th>".
	    "<th>Yards Per Game</th><th>Touchdowns</th><th>Longest Catch</th><th>Fumbles</th>";
	    while($row = $result->fetch_assoc()) {
	        echo "<tr><td>" . $rank++ . "</td>";
	        echo "<td>" . $row["fname"]. "</td>";
	        echo "<td>" . $row["lname"]. "</td>"; 
	        echo "<td>" . $row["team"]. "</td>";
	        echo "<td class='text-warning'>" . $row["yards"]. "</td>";
	        echo "<td>" . $row["receptions"]. "</td>";
	        echo "<td>" . $row["average"]. "</td>";
	        echo "<td>" . $row["yardsPerGame"]. "</td>";
	        echo "<td>" . $row["touchdowns"]. "</td>";
	        echo "<td>" . $row["lng"]. "</td>";
	        echo "<td>" . $row["fumbles"]. "</td></tr>";
	        	        
	    }
		echo "</table>";
	} else {
	    echo "<br><br><br><div class='text-center alert alert-danger' role='alert'>".
   	 "<span class='glyphicon glyphicon-exclamation-sign'>".
   	 "</span> Something Went Wrong :( <span class='glyphicon glyphicon-exclamation-sign'></span></div>";
	}	
	
	$conn->close();
}

function Load_D_By_Tckls() {
	
	$servername = "localhost";
	$username = "root";
	$password = "bitnami";
	$dbname = "assignment3";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT p.fname, p.lname, p.position,p.team, b.*  FROM Player p INNER JOIN Defence b ON b.playerID = p.playerID ".
	"ORDER BY b.tackles desc  LIMIT 0, 10";
	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    $rank = 1;
	    echo "<h2>Top Defenders (by tackles)</h2>";
	    echo "<table class='table table-striped'><th>Rank</th><th>First Name</th><th>Last Name</th><th>Team</th><th>Position</th><th class='text-warning'>Tackles</th><th>Assisted Tackles</th><th>Interceptions</th>".
	    "<th>Sacks</th><th>Forced Fumbles</th>";
	    while($row = $result->fetch_assoc()) {
	        echo "<tr><td>" . $rank++ . "</td>";
	        echo "<td>" . $row["fname"]. "</td>";
	        echo "<td>" . $row["lname"]. "</td>"; 
	        echo "<td>" . $row["team"]. "</td>";
	        echo "<td>" . $row["position"]. "</td>";
	        echo "<td class='text-warning'>" . $row["tackles"]. "</td>";
	        echo "<td>" . $row["assistedTackles"]. "</td>";
	        echo "<td>" . $row["interceptions"]. "</td>";
	        echo "<td>" . $row["sacks"]. "</td>";
	        echo "<td>" . $row["forcedFumbles"]. "</td></tr>";
	        	        
	    }
		echo "</table>";
	} else {
	    echo "<br><br><br><div class='text-center alert alert-danger' role='alert'>".
   	 "<span class='glyphicon glyphicon-exclamation-sign'>".
   	 "</span> Something Went Wrong :( <span class='glyphicon glyphicon-exclamation-sign'></span></div>";
	}	
	
	$conn->close();
}

function Load_D_By_Ints() {
	
	$servername = "localhost";
	$username = "root";
	$password = "bitnami";
	$dbname = "assignment3";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT p.fname, p.lname, p.position,p.team, b.*  FROM Player p INNER JOIN Defence b ON b.playerID = p.playerID ".
	"ORDER BY b.interceptions desc  LIMIT 0, 10";
	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    $rank = 1;
	    echo "<h2>Top Defenders (by interceptions)</h2>";
	    echo "<table class='table table-striped'><th>Rank</th><th>First Name</th><th>Last Name</th><th>Team</th><th>Position</th><th class='text-warning'>Interceptions</th><th>Int. Yards</th>".
	    "<th>Int. Avg</th><th>Tackles</th><th>Assisted Tackles</th><th>Forced Fumbles</th>";
	    while($row = $result->fetch_assoc()) {
	        echo "<tr><td>" . $rank++ . "</td>";
	        echo "<td>" . $row["fname"]. "</td>";
	        echo "<td>" . $row["lname"]. "</td>"; 
	        echo "<td>" . $row["team"]. "</td>";
	        echo "<td>" . $row["position"]. "</td>";
	        echo "<td class='text-warning'>" . $row["interceptions"]. "</td>";
	        echo "<td>" . $row["interceptionYards"]. "</td>";
	        echo "<td>" . $row["interceptionAverage"]. "</td>";
	        echo "<td>" . $row["tackles"]. "</td>";
	        echo "<td>" . $row["assistedTackles"] ."</td>";
	        echo "<td>" . $row["forcedFumbles"] ."</td></tr>";
	        	        
	    }
		echo "</table>";
	} else {
	    echo "<br><br><br><div class='text-center alert alert-danger' role='alert'>".
   	 "<span class='glyphicon glyphicon-exclamation-sign'>".
   	 "</span> Something Went Wrong :( <span class='glyphicon glyphicon-exclamation-sign'></span></div>";
	}	
	
	$conn->close();
}

function Load_D_By_Scks() {
	
	$servername = "localhost";
	$username = "root";
	$password = "bitnami";
	$dbname = "assignment3";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT p.fname, p.lname, p.position,p.team, b.*  FROM Player p INNER JOIN Defence b ON b.playerID = p.playerID ".
	"ORDER BY b.sacks desc  LIMIT 0, 10";
	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    $rank = 1;
	    echo "<h2>Top Defenders (by sacks)</h2>";
	    echo "<table class='table table-striped'><th>Rank</th><th>First Name</th><th>Last Name</th><th>Team</th><th>Position</th><th class='text-warning'>Sacks</th><th>Tackles</th>".
	    "<th>Assisted Tackles</th><th>Forced Fumbles</th>";
	    while($row = $result->fetch_assoc()) {
	        echo "<tr><td>" . $rank++ . "</td>";
	        echo "<td>" . $row["fname"]. "</td>";
	        echo "<td>" . $row["lname"]. "</td>"; 
	        echo "<td>" . $row["team"]. "</td>";
	        echo "<td>" . $row["position"]. "</td>";
	        echo "<td class='text-warning'>" . $row["sacks"]. "</td>";
	        echo "<td>" . $row["tackles"]. "</td>";
	        echo "<td>" . $row["assistedTackles"]. "</td>";
	        echo "<td>" . $row["forcedFumbles"]. "</td></tr>";
	        	        
	    }
		echo "</table>";
	} else {
	    echo "<br><br><br><div class='text-center alert alert-danger' role='alert'>".
   	 "<span class='glyphicon glyphicon-exclamation-sign'>".
   	 "</span> Something Went Wrong :( <span class='glyphicon glyphicon-exclamation-sign'></span></div>";
	}	
	
	$conn->close();
}

function LoadKickers() {
	
	$servername = "localhost";
	$username = "root";
	$password = "bitnami";
	$dbname = "assignment3";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT p.fname, p.lname, p.position,p.team, b.*  FROM Player p INNER JOIN Kicking b ON b.playerID = p.playerID ".
	"ORDER BY b.fieldGoals desc  LIMIT 0, 10";
	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    $rank = 1;
	    echo "<h2>Top Kickers (by field goals)</h2>";
	    echo "<table class='table table-striped'><th>Rank</th><th>First Name</th><th>Last Name</th><th>Team</th><th class='text-warning'>Field Goals</th><th>0-19</th><th>20-29</th>".
	    "<th>30-39</th><th>40-49</th><th>50+</th><th>Percentage</th><th>Point After Touchdown</th>";
	    while($row = $result->fetch_assoc()) {
	        echo "<tr><td>" . $rank++ . "</td>";
	        echo "<td>" . $row["fname"]. "</td>";
	        echo "<td>" . $row["lname"]. "</td>"; 
	        echo "<td>" . $row["team"]. "</td>";
	        echo "<td class='text-warning'>" . $row["fieldGoals"]. "</td>";
	        echo "<td>" . $row["extraShort"]. "</td>";
	        echo "<td>" . $row["short"]. "</td>";
	        echo "<td>" . $row["med"]. "</td>";
	        echo "<td>" . $row["lng"]. "</td>";
	        echo "<td>" . $row["extraLong"]. "</td>";
	        echo "<td>" . $row["percentage"]. "</td>";
	        echo "<td>" . $row["pat"]. "</td></tr>";
	        	        
	    }
		echo "</table>";
	} else {
	    echo "<br><br><br><div class='text-center alert alert-danger' role='alert'>".
   	 "<span class='glyphicon glyphicon-exclamation-sign'>".
   	 "</span> Something Went Wrong :( <span class='glyphicon glyphicon-exclamation-sign'></span></div>";
	}	
	
	$conn->close();
}

function InsertGame($hteam, $ateam, $hscore, $ascore, $date, $week){
	
	$servername = "localhost";
	$username = "root";
	$password = "bitnami";
	$dbname = "assignment3";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	

	$sql = "INSERT INTO Game(weekNumber , team, home, away, homeScore, awayScore, gameDay)VALUES".
	"(".$week.",'".$hteam."','".$hteam."','".$ateam."',".$hscore.",".$ascore.",'".$date."'),".
	"(".$week.",'".$ateam."','".$hteam."','".$ateam."',".$hscore.",".$ascore.",'".$date."')";
	
	if ($conn->query($sql) === TRUE) {
    	echo "<br><br><br><div class='text-center alert alert-success' role='alert'>".
   	 	"Record Created Successfully </div>";
	} else {
   	 //echo "Error: " . $sql . "<br>" . $conn->error;
   	 echo "<br><br><br><div class='text-center alert alert-danger' role='alert'>".
   	 "<span class='glyphicon glyphicon-exclamation-sign'>".
   	 "</span> Something Went Wrong (Check all the fields are filled out) <span class='glyphicon glyphicon-exclamation-sign'></span></div>";
	}
		
	$conn->close();
};

function LoadSchedule($team) {
	
	$servername = "localhost";
	$username = "root";
	$password = "bitnami";
	$dbname = "assignment3";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT * FROM game WHERE team = '".$team."'";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    $rank = 1;
	    echo "<h2>Schedule (missing week is BYE week)</h2>";
	    echo "<table class='table table-striped'><th>Week Number</th><th>Game Date</th><th>Home Team</th><th>Away Team</th><th>Home Score</th><th>Away Score</th>";
	    while($row = $result->fetch_assoc()) {
	        echo "<tr><td>" . $row["weekNumber"]. "</td>";
	        echo "<td>" . $row["gameDay"]. "</td>"; 
	        echo "<td>" . $row["home"]. "</td>";
	        echo "<td>" . $row["away"]. "</td>";
	        echo "<td>" . $row["homeScore"]. "</td>";
	        echo "<td>" . $row["awayScore"]. "</td></tr>"; 	        
	    }
		echo "</table>";
	} else {
	    echo "<br><br><br><div class='text-center alert alert-danger' role='alert'>".
   	 "<span class='glyphicon glyphicon-exclamation-sign'>".
   	 "</span> Something Went Wrong :( <span class='glyphicon glyphicon-exclamation-sign'></span></div>";
	}	
	
	$conn->close();
}

function LoadRoster($team) {
	
	$servername = "localhost";
	$username = "root";
	$password = "bitnami";
	$dbname = "assignment3";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT * FROM player  WHERE team = '".$team."' ORDER BY case WHEN position = 'QB' THEN '1' WHEN position = 'RB' THEN '2'".  
		"WHEN position = 'WR' THEN '3'WHEN position LIKE '%LB' THEN '4' ELSE position END,gplayed DESC";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    $rank = 1;
	    echo "<h2>Roster</h2>";
	    echo "<table class='table table-striped'><th>Jersey Number</th><th>First Name</th><th>Last Name</th><th>Position</th><th>Games Played</th><th>Height</th>".
	    "<th>Weight</th><th>College</th>";
	    while($row = $result->fetch_assoc()) {
	    	echo "<tr><td>" . $row["playerNo"]. "</td>";
	        echo "<td>" . $row["fname"]. "</td>";
	        echo "<td>" . $row["lname"]. "</td>"; 
	        echo "<td>" . $row["position"]. "</td>";
	        echo "<td>" . $row["gplayed"]. "</td>";
	        echo "<td>" . $row["height"]. "</td>";
	        echo "<td>" . $row["weight"]. "</td>";
	        echo "<td>" . $row["amater"]. "</td></tr>"; 	        
	    }
		echo "</table>";
	} else {
	    echo "<br><br><br><div class='text-center alert alert-danger' role='alert'>".
   	 "<span class='glyphicon glyphicon-exclamation-sign'>".
   	 "</span> Something Went Wrong :( <span class='glyphicon glyphicon-exclamation-sign'></span></div>";
	}	
	
	$conn->close();
}

function LoadStandings($conf){
	
	$servername = "localhost";
	$username = "root";
	$password = "bitnami";
	$dbname = "assignment3";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT * FROM Team WHERE conference = '".$conf."' ORDER BY division,pct DESC";

	$result = $conn->query($sql);
	
	$rowCount = 0;
	if ($result->num_rows > 0) {
	    // output data of each row
	    $rank = 1;
	    echo "<h2>Standings</h2>";
	    echo "<table class='table'><th>Team</th><th>Conference</th><th>Divison</th><th>Percentage</th><th>Win</th><th>Loss</th>".
	    "<th>Tie</th>";
	    while($row = $result->fetch_assoc()) {
	    	if($rowCount%4 == 0){
	    		echo "<tr class='danger'><td>" . $row["teamName"]. "</td>";
	    	}else{
	    		echo "<tr><td>" . $row["teamName"]. "</td>";
	    	}
	        	echo "<td>" . $row["conference"]. "</td>";
	        	echo "<td>" . $row["division"]. "</td>"; 
	        	echo "<td>" . $row["pct"]. "</td>";
	        	echo "<td>" . $row["win"]. "</td>";
	        	echo "<td>" . $row["loss"]. "</td>";
	        	echo "<td>" . $row["tie"]. "</td></tr>";
	        
	        $rowCount++;        
	    }
		echo "</table>";
	} else {
	    echo "<br><br><br><div class='text-center alert alert-danger' role='alert'>".
   	 "<span class='glyphicon glyphicon-exclamation-sign'>".
   	 "</span> Something Went Wrong :( <span class='glyphicon glyphicon-exclamation-sign'></span></div>";
	}	
	
	$conn->close();
}

function UpdatePlayer($num, $team, $pos, $stats) {

	if ($pos == "pass") {
		UpdatePasser($num, $team, $pos, $stats);
	} else if ($pos == "rush") {
		UpdateRusher($num, $team, $pos, $stats);
	} else if ($pos == "rec") {
		UpdateReceiving($num, $team, $pos, $stats);
	} else if ($pos == "def") {
		UpdateDefence($num, $team, $pos, $stats);
	} else if ($pos == "kick") {
		UpdateKick($num, $team, $pos, $stats);
	}
}

function UpdatePasser($num, $team, $pos, $stats) {
	
	$fields = explode("-", $stats );

	$servername = "localhost";
	$username = "root";
	$password = "bitnami";
	$dbname = "assignment3";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
		
	
	$query = "SET ";
	if(!(isset($fields[0]))){
		$fields[0] == "";
	}
	
	if ($fields[0] != "") {
		$query = $query."b.attempts =".$fields[0].", ";
	} 
	
	if ($fields[1] != "") {
		$query = $query."b.completions =".$fields[1].", ";
	} 
	
	if ($fields[2] != "") {
		$query = $query."b.percentage =".$fields[2].", ";
	} 
	
	if ($fields[3] != "") {
		$query = $query."b.yards =".$fields[3].", ";
	} 
	
	if ($fields[4] != "") {
		$query = $query."b.yardsPerAttempt =".$fields[4].", ";
	} 
	
	if ($fields[5] != "") {
		$query = $query."b.touchdowns =".$fields[5].", ";
	} 
	
	if ($fields[6] != "") {
		$query = $query."b.interceptions =".$fields[6].", ";
	} 
	
	if ($fields[7] != "") {
		$query = $query."b.sacks =".$fields[7].", ";
	} 
	
	if ($fields[8] != "") {
		$query = $query."b.rating =".$fields[8].", ";
	} 
	
	$query = substr($query, 0, -2);
	
	$sql = "UPDATE Pass b INNER JOIN Player a ON a.playerID = b.playerID ".$query." WHERE a.team = '".$team."' AND a.playerNo = ".$num.";";
	
	if ($conn->query($sql) === TRUE) {
    	echo "<br><br><br><div class='text-center alert alert-success' role='alert'>".
   	 	"Record Updated Successfully </div>";
	} else {
   	 echo "Error: " . $sql . "<br>" . $conn->error;
   	 echo "<br><br><br><div class='text-center alert alert-danger' role='alert'>".
   	 "<span class='glyphicon glyphicon-exclamation-sign'>".
   	 "</span> Something Went Wrong (Check all the fields are filled out) <span class='glyphicon glyphicon-exclamation-sign'></span></div>";
	}
		
	$conn->close();

}

function UpdateRusher($num, $team, $pos, $stats) {
	
	$fields = explode("-", $stats);

	$servername = "localhost";
	$username = "root";
	$password = "bitnami";
	$dbname = "assignment3";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	
	$query = "SET ";
	
	if ($fields[0] != "") {
		$query = $query."b.attempts =".$fields[0].", ";
	} 
	
	if ($fields[1] != "") {
		$query = $query."b.yards =".$fields[1].", ";
	} 
	
	if ($fields[2] != "") {
		$query = $query."b.average =".$fields[2].", ";
	} 
	
	if ($fields[3] != "") {
		$query = $query."b.yardsPerGame =".$fields[3].", ";
	} 
	
	if ($fields[4] != "") {
		$query = $query."b.lng =".$fields[4].", ";
	} 
	
	if ($fields[5] != "") {
		$query = $query."b.touchdowns =".$fields[5].", ";
	} 
	
	if ($fields[6] != "") {
		$query = $query."b.fumbles =".$fields[6].", ";
	} 
	
	$query = substr($query, 0, -2);
	
	$sql = "UPDATE Rush b INNER JOIN Player a ON a.playerID = b.playerID ".$query." WHERE a.team = '".$team."' AND a.playerNo = ".$num.";";
	
	if ($conn->query($sql) === TRUE) {
    	echo "<br><br><br><div class='text-center alert alert-success' role='alert'>".
   	 	"Record Updated Successfully </div>";
	} else {
   	 //echo "Error: " . $sql . "<br>" . $conn->error;
   	 echo "<br><br><br><div class='text-center alert alert-danger' role='alert'>".
   	 "<span class='glyphicon glyphicon-exclamation-sign'>".
   	 "</span> Something Went Wrong (Check all the fields are filled out) <span class='glyphicon glyphicon-exclamation-sign'></span></div>";
	}
		
	$conn->close();

}

function UpdateReceiving($num, $team, $pos, $stats) {
	
	$fields = explode("-", $stats);

	$servername = "localhost";
	$username = "root";
	$password = "bitnami";
	$dbname = "assignment3";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	
	$query = "SET ";
	
	if ($fields[0] != "") {
		$query = $query."b.receptions =".$fields[0].", ";
	} 
	
	if ($fields[1] != "") {
		$query = $query."b.yards =".$fields[1].", ";
	} 
	
	if ($fields[2] != "") {
		$query = $query."b.average =".$fields[2].", ";
	} 
	
	if ($fields[3] != "") {
		$query = $query."b.yardsPerGame =".$fields[3].", ";
	} 
	
	if ($fields[4] != "") {
		$query = $query."b.touchdowns =".$fields[4].", ";
	} 
	
	if ($fields[5] != "") {
		$query = $query."b.lng =".$fields[5].", ";
	} 
	
	if ($fields[6] != "") {
		$query = $query."b.fumbles =".$fields[6].", ";
	} 
	
	$query = substr($query, 0, -2);
	
	$sql = "UPDATE Recieve b INNER JOIN Player a ON a.playerID = b.playerID ".$query." WHERE a.team = '".$team."' AND a.playerNo = ".$num.";";
	
	if ($conn->query($sql) === TRUE) {
    	echo "<br><br><br><div class='text-center alert alert-success' role='alert'>".
   	 	"Record Updated Successfully </div>";
	} else {
   	 //echo "Error: " . $sql . "<br>" . $conn->error;
   	 echo "<br><br><br><div class='text-center alert alert-danger' role='alert'>".
   	 "<span class='glyphicon glyphicon-exclamation-sign'>".
   	 "</span> Something Went Wrong (Check all the fields are filled out) <span class='glyphicon glyphicon-exclamation-sign'></span></div>";
	}
		
	$conn->close();

}

function UpdateDefence($num, $team, $pos, $stats) {
	
	$fields = explode("-", $stats);

	$servername = "localhost";
	$username = "root";
	$password = "bitnami";
	$dbname = "assignment3";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	
	$query = "SET ";
	
	if ($fields[0] != "") {
		$query = $query."b.tackles =".$fields[0].", ";
	} 
	
	if ($fields[1] != "") {
		$query = $query."b.assistedTackles =".$fields[1].", ";
	} 

	if ($fields[2] != "") {
		$query = $query."b.interceptions =".$fields[2].", ";
	} 
	
	if ($fields[3] != "") {
		$query = $query."b.interceptionYards =".$fields[3].", ";
	} 
	
	if ($fields[4] != "") {
		$query = $query."b.touchdowns =".$fields[4].", ";
	} 
	
	if ($fields[5] != "") {
		$query = $query."b.sacks =".$fields[5].", ";
	} 
	
	if ($fields[6] != "") {
		$query = $query."b.forcedFumbles =".$fields[6].", ";
	} 
	
	$query = substr($query, 0, -2);
	
	$sql = "UPDATE Defence b INNER JOIN Player a ON a.playerID = b.playerID ".$query." WHERE a.team = '".$team."' AND a.playerNo = ".$num.";";
	
	if ($conn->query($sql) === TRUE) {
    	echo "<br><br><br><div class='text-center alert alert-success' role='alert'>".
   	 	"Record Updated Successfully </div>";
	} else {
   	 //echo "Error: " . $sql . "<br>" . $conn->error;
   	 echo "<br><br><br><div class='text-center alert alert-danger' role='alert'>".
   	 "<span class='glyphicon glyphicon-exclamation-sign'>".
   	 "</span> Something Went Wrong (Check all the fields are filled out) <span class='glyphicon glyphicon-exclamation-sign'></span></div>";
	}
		
	$conn->close();

}

function UpdateKick($num, $team, $pos, $stats) {
	
	$fields = explode("-", $stats);

	$servername = "localhost";
	$username = "root";
	$password = "bitnami";
	$dbname = "assignment3";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	
	$query = "SET ";
	
	if ($fields[0] != "") {
		$query = $query."b.percentage =".$fields[0].", ";
	} 
	
	if ($fields[1] != "") {
		$query = $query."b.pat =".$fields[1].", ";
	} 

	if ($fields[2] != "") {
		$query = $query."b.fieldGoals =".$fields[2].", ";
	} 
	
	if ($fields[3] != "") {
		$query = $query."b.extraShort =".$fields[3].", ";
	} 
	
	if ($fields[4] != "") {
		$query = $query."b.short =".$fields[4].", ";
	} 
	
	if ($fields[5] != "") {
		$query = $query."b.med =".$fields[5].", ";
	} 
	
	if ($fields[6] != "") {
		$query = $query."b.lng =".$fields[6].", ";
	} 
	
	if ($fields[7] != "") {
		$query = $query."b.extraLong =".$fields[7].", ";
	} 
	
	$query = substr($query, 0, -2);
	
	$sql = "UPDATE Kicking b INNER JOIN Player a ON a.playerID = b.playerID ".$query." WHERE a.team = '".$team."' AND a.playerNo = ".$num.";";
	
	if ($conn->query($sql) === TRUE) {
    	echo "<br><br><br><div class='text-center alert alert-success' role='alert'>".
   	 	"Record Updated Successfully </div>";
	} else {
   	 //echo "Error: " . $sql . "<br>" . $conn->error;
   	 echo "<br><br><br><div class='text-center alert alert-danger' role='alert'>".
   	 "<span class='glyphicon glyphicon-exclamation-sign'>".
   	 "</span> Something Went Wrong (Check all the fields are filled out) <span class='glyphicon glyphicon-exclamation-sign'></span></div>";
	}
		
	$conn->close();

}

function CompareTeams($team1, $team2) {

	$servername = "localhost";
	$username = "root";
	$password = "bitnami";
	$dbname = "assignment3";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	
	$t1passyards = 0;
	$t2passyards = 0;
	
	$t1rushyards = 0;
	$t2rushyards = 0;
	
	$t1recyards = 0;
	$t2recyards = 0;
	
	$t1defence = 0;
	$t2defence = 0;
	
	$t1kick = 0;
	$t2kick = 0;
	
	//GET PASS YARDS
	$sql = "SELECT b.yards, p.team  FROM Player p INNER JOIN Pass b ON p.playerID = b.playerID AND (p.team = '".$team1."' OR p.team ='".$team2."') ORDER BY b.yards desc  LIMIT 0, 2;";
	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$i = 0;
	    while($row = $result->fetch_assoc()) {
	    	if ($i == 0) {
	    		$t1yards = intval($row["yards"]);
	    		$team1 = $row["team"];
	    		$i++;
	    	} else {
	    		$t2yards = intval($row["yards"]);
	    		$team2 = $row["team"];
	    	}
	    }
	} else {
   	 echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	//GET RUSH YARDS FOR TEAM 1
	$sql = "SELECT b.yards FROM Player p INNER JOIN Rush b ON p.playerID = b.playerID AND p.team = '".$team1."' ORDER BY b.yards desc  LIMIT 0, 1;";
	
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		if ($result->num_rows > 0) {
			$t1rushyards = intval($row["yards"]);
		
		}
	}
	
	//GET RUSH YARDS FOR TEAM 2
	$sql = "SELECT b.yards FROM Player p INNER JOIN Rush b ON p.playerID = b.playerID AND p.team = '".$team2."' ORDER BY b.yards desc  LIMIT 0, 1;";
	
	$result = $conn->query($sql);
	
	while($row = $result->fetch_assoc()){
		if ($result->num_rows > 0) {
			$t2rushyards = intval($row["yards"]);
		}
	}
	
	//GET RECIEVING YARDS FOR TEAM 1
	$sql = "SELECT b.yards, p.team FROM Player p INNER JOIN Recieve b ON p.playerID = b.playerID AND p.team = '".$team1."' ORDER BY b.yards desc  LIMIT 0, 1 ;";
	
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		if ($result->num_rows > 0) {
			$t1recyards = intval($row["yards"]);
		}
	}
	//GET RECIEVING YARDS FOR TEAM 2
	$sql = "SELECT b.yards, p.team FROM Player p INNER JOIN Recieve b ON p.playerID = b.playerID AND p.team = '".$team2."' ORDER BY b.yards desc  LIMIT 0, 1 ;";
	
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		if ($result->num_rows > 0) {
			$t2recyards = intval($row["yards"]);
		}
	}
	//GET D STATS FOR TEAM 1
	$sql = "SELECT b.tackles, p.team FROM Player p INNER JOIN Defence b ON p.playerID = b.playerID AND p.team = '".$team1."' ORDER BY b.tackles desc  LIMIT 0, 1;";
	
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		if ($result->num_rows > 0) {
			$t1defence = intval($row["tackles"]);
		}
	}
	//GET D STATS FOR TEAM 2
	$sql = "SELECT b.tackles, p.team FROM Player p INNER JOIN Defence b ON p.playerID = b.playerID AND p.team = '".$team2."' ORDER BY b.tackles desc  LIMIT 0, 1;";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		if ($result->num_rows > 0) {
			$t2defence = intval($row["tackles"]);
		}
	}
	//GET KICK FOR TEAM 1
	$sql = "SELECT b.fieldGoals, p.team FROM Player p INNER JOIN Kicking b ON p.playerID = b.playerID AND p.team = '".$team1."' ORDER BY b.fieldGoals desc  LIMIT 0, 1;";
	
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		if ($result->num_rows > 0) {
			$t1kick = intval($row["fieldGoals"]);
		}
	}
	//GET KICKS FOR TEAM 2
	$sql = "SELECT b.fieldGoals, p.team FROM Player p INNER JOIN Kicking b ON p.playerID = b.playerID AND p.team = '".$team2."' ORDER BY b.fieldGoals desc  LIMIT 0, 1;";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		if ($result->num_rows > 0) {
			$t2kick = intval($row["fieldGoals"]);
		}
	}
	// 
	// team1, t1passyards, t1rushyards, t1recyards, t1defence, t1kick
	// team2, t2passyards, t2rushyards, t2recyards, t2defence, t2kick
	//
	
	$t1count = 0;
	$t2count = 0;
	
	if ($t1yards > $t2yards) {
		$t1count++;
		echo "<span class='label label-danger'>".$team1."</span> has better passing.<br>";
	} else {
		$t2count++;
		echo "<span class='label label-success'>".$team2."</span> has better passing.<br>";
	}
	
	if ($t1rushyards > $t2rushyards) {
		$t1count++;
		echo "<span class='label label-danger'>".$team1."</span> has better rushing.<br>";
	} else {
		$t2count++;
		echo "<span class='label label-success'>".$team2."</span> has better rushing.<br>";
	}
	
	if ($t1recyards > $t2recyards) {
		$t1count++;
		echo "<span class='label label-danger'>".$team1."</span> has better receiving.<br>";
	} else {
		$t2count++;
		echo "<span class='label label-success'>".$team2."</span> has better receiving.<br>";
	}
	
	if ($t1defence > $t2defence) {
		$t1count++;
		echo "<span class='label label-danger'>".$team1."</span> has better defence.<br>";
	} else {
		$t2count++;
		echo "<span class='label label-success'>".$team2."</span> has better defence.<br>";
	}
	
	if ($t1kick > $t2kick) {
		$t1count++;
		echo "<span class='label label-danger'>".$team1."</span> has better kicking.<br>";
	} else {
		$t2count++;
		echo "<span class='label label-success'>".$team2."</span> has better kicking.<br>";
	}
	
	if ($t1count > $t2count) {
		echo "<br><br><span class='label label-danger'>".$team1."</span> IS THE BETTER TEAM!";
	} else {
		echo "<br><br><span class='label label-success'>".$team2."</span> IS THE BETTER TEAM!";
	}
	
	$conn->close();

}
?>
