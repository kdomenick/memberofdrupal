<!-- This PHP page allows someone to check for Drupal User accounts without actually logging in to a Drupal site.  Could be beneficial for a first-line support staff or help desk person who doesn't have a Drupal admin account (or any login ability).  This could have security implication when used improperly.  Proceed with caution.  -->

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Links to simple responsive CSS template on Github.  Can also download and save locally -->
		<link rel="stylesheet" media="all" type="text/css" href="https://github.com/kdomenick/responsive-html5-template/tree/master/stylescommon.css">
		<link rel="stylesheet" media="all" type="text/css" href="https://github.com/kdomenick/responsive-html5-template/tree/master/styles/responsive.css">

		<style>
			table {margin-top: 30px; margin-bottom: 20px;}
			body {font-size: 95%;}
		</style>	
	</head>
	<body>
		<div id="container">
			<div id="top-bar">
			</div>

			<header>
				<div id="main-header">
					<div class="logo column-half">
					</div>
					<div class="right-header column-half">
						<h1 class="nopad">Member Of</h1>
						<h2 class="nopad">Insert Name of Drupal Site</h2>
					</div>
				</div>	
				<nav class="menu">
				</nav>
			</header>
			<div id="content">

				<div class="column-third pad">
					<div class="box pad grey">
						<form action="memberof.php" method="GET">
							<label>Username or Last Name (partial allowed):</label>
							<input type="text" name="searchname">
							<input type="submit" value="Submit">
						</form>
					</div>
				</div>
				<div class="column-two-third">
					<!--  Some information for whomever is searching the user database -->
					<div class="box pad column-third" style="min-height:200px">
						<h3 class="nopad">User doesn't exist?</h3>
						<p>Insert instructions to handle that  </p>
					</div>
					<div class="box pad column-third" style="min-height:200px">
						<h3 class="nopad">Home Department is WRONG?</h3>
						<p>Insert instructions to handle that</p>
					</div>	
					<div class="box pad column-third" style="min-height:200px">
						<h3 class="nopad">Username or something else is wrong, or account is BLOCKED?</h3>
						<p>Insert instructions to handle that </p>
					</div>
				</div>
				<div class="clear-both">
				</div>		
				<hr style="border: 1px solid #eaeaea;">	

				<?php
				
				
					$searchname= mysqli_real_escape_string($dbc, $_GET['searchname']);
					$min_length = 3;

					if (strlen($searchname) >= $min_length) {
						// link to your connection string
						require 'yourdbconnectionfile.php';

						// usersimplified is a view that was added to the MySQL Drupal database to gather all of the user data into one table.  
						// The SQL below searches across the user account name, as well as the first and last name fields
						$sql="SELECT * FROM usersimplified WHERE lastname like '".$searchname."' or username like '".$searchname."' or firstname like '".$searchname."' ";

						$result = mysqli_query($dbc, $sql) or die ("Bad query: $sql");

						echo "<table>";
						echo "<tr><th>Username</th><th>Role</th><th>First Name</th><th>Last Name</th><th>Active</th><th>Home Department</th></tr>";
						while ($row = mysqli_fetch_assoc($result)) {
							echo "<tr><td>{$row['username']}</td><td>{$row['role']}</td><td>{$row['firstname']}</td><td>{$row['lastname']}</td><td>{$row['status']}</td><td>{$row['homedept']}</td></tr>";
								
						}

						echo "</table>";


					}
					else {
						echo "Enter at least 3 characters of the user's first or last name";
					}

					mysqli_close($dbc);

				?>


			</div><!--end Content-->
			<div id="footer-wrapper">
				<footer>
				</footer>
				<div id="bottom-bar">
				</div>
			</div>			
		</div><!--end Container-->
	</body>

</html>