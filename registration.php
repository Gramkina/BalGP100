<html>
	<head>
		<title>Регистрация</title>
		<link rel="stylesheet" type="text/css" href="registration/css/registration.css">
		<link rel="stylesheet" type="text/css" href="css/fonts.css">
		<script src="library/js/jquery.min.js"></script>
		<meta charset="utf-8">
	</head>
	
	<body>
		
		<?php 
			if($_GET['code'] == null) include("registration/default.php");
			else{
				include("php/db/db.php");
				$mysql = new mysqli($hostDB, $userDB, $passwordDB, $database);
				$stmt = $mysql->prepare('SELECT * FROM vr_reg WHERE code = ?');
				$stmt->bind_Param("s", $_GET['code']);
				$stmt->execute();
				if(($array = $stmt->get_result()->fetch_assoc()) != null){
					$stmt = $mysql->prepare('INSERT INTO Users(Password, Email, Fam, Imya, Otch, Phone, Gender, Date) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
					$stmt->bind_Param("ssssssis", $array['password'], $array['email'], $array['fam'], $array['imya'], $array['otch'], $array['phone'], $array['Gender'], $array['Date']);
					$stmt->execute();
					$stmt = $mysql->prepare('DELETE FROM vr_reg WHERE code = ?');
					$stmt->bind_Param("s", $_GET['code']);
					$stmt->execute();
					include("registration/congratulation.php");
				}
				else include("registration/error.php");
				$mysql->close();
			}
		?>				
		
	</body>
	
</html>

<script src="registration/js/registration.js"></script>