<!DOCTYPE html>

<html>
	
	<head>
		<title>Baby Names</title>

		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	</head>

	<body >


		<h1>
			Baby Names
		</h1>

		<div id="namearea">
			<h2>First Name:</h2>

			<div>
				<!-- list of all baby names should be inserted into this select box -->
				<form action="names.php" method="GET">
				<select id="allnames" name="allnames">
					<option value="">(choose a name)</option>
                    <?php
                    include 'babynames.php';
                    populateDropdown();
                    ?>
				</select>

				<button type="submit" id="search">
					<img src="pacifier.gif" alt="icon" />
					Search
				</button>
				<!--<input type="submit"  value="submit" name="submit">-->
				</form>

			</div>


			<div>
				<label><input type="radio" id="genderm" name="gender" value="m" checked="checked" /> Male</label>
				<label><input type="radio" id="genderf" name="gender" value="f" /> Female</label>
			</div>

		</div>

		<!-- un-hide this 'resultsarea' div when you fetch data about the name -->
		<div id="resultsarea" style="display: none">
			<div id="originmeaning">
				<h2>Origin/Meaning:</h2>

				<p>The name <b id="nested"></b> means ... </p>
				<hr>

				<!-- baby name meaning data should be inserted into this div -->

                <div id="meaning">


				</div>



			</div>

			<div id="grapharea">
				<h2>Popularity:</h2>
				
				<!-- if there is no ranking data for the given name, show this error message -->
				<div id="norankdata" style="display: none;">
					There is no ranking data for that name/gender combination.
				</div>

				<!-- baby name ranking data should be inserted into this table -->
				<table id="graph"></table>
			</div>

		</div>
		
		<!-- an empty div for inserting any error text -->
		<div id="errors"></div>
		
		<!-- your files -->
		<!--<link href="names.css" type="text/css" rel="stylesheet" /> -->
		<script src="names.js" type="text/javascript" ></script>
	</body>
</html>
