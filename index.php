<?php
// Project: Ordering of Results

// connection to the database
try {
	$pdo = new PDO("mysql:dbname=project_sort;host=localhost", "root", "");
	
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}

// check if the data was sent using the form
if(isset($_GET['ordem']) && empty($_GET['ordem']) == false) {
	$ordem = addslashes($_GET['ordem']); // adding in some variable and putting a basic protection
	// consult in the database
	$sql = "SELECT * FROM users ORDER BY ".$ordem;
} else {
	// if not, then select the way it is in the database
	$ordem = '';
	$sql = "SELECT * FROM users";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="styles.css" rel="stylesheet" type="text/css"> 
	<title>Ordering</title>
</head>
<body>
	<main>
		<div class="container column">
			<div class="top">
				<h1>Ordenar resultados</h1>
				<!-- Results sort button -->
				<form method="GET">
					<select name="ordem" onchange="this.form.submit()"> <!-- when selecting the option the form reloads the screen -->
						<option></option>
						<option value="nome" <?php echo ($ordem=="nome")?'selected="selected"':''; ?>>Pelo nome</option> <!-- if the option has selected then php puts selected-->
						<option value="idade"<?php echo ($ordem=="idade")?'selected="selected"':''; ?>>Pela idade</option>
					</select>
				</form>
			</div>
	
			<table>
				<thead>
					<tr>
						<th>Nome</th>
						<th>Idade</th>
					</tr>
				</thead>

				<tbody>
					<!-- listing of database items -->
					<?php
					$sql = $pdo->query($sql);
					// check if there was any result
					if($sql->rowCount() > 0 ) {
						// if there was any result then I show it on the screen
						foreach($sql->fetchAll() as $usuario):
							?>
							<!-- html code: columns -->
							<tr>
								<td><?php echo $usuario['nome']; ?></td>
								<td><?php echo $usuario['idade']; ?></td>
							</tr>
							
							<?php
						endforeach;
					}
					?>
				</tbody>
			</table>
		</div>

		

	</main>
</body>
</html>