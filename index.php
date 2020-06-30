<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>TestWork</title>    
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="container">
            <div class="login">
                <a href="login.php"> Log in </a><br>
		<a href="logout.php"> Log out </a>
            </div>
            <div class="form">
                <div class="input-boxes">
                    <form action="add.php" method="post">
                        <input type="text" name="name" id="name" placeholder="your name">
                        <input type="text" name="email" id="email" placeholder="email">
                        <input type="text" name="task_text" id="task_text" placeholder="task">
                        <button type="submit">Send task</button>
                    </form>
					<form method="get">
						<select name="orderBy">
							<option value="name">name</option>
							<option value="email">email</option>
							<option value="progress">status</option>
						</select>
						<button type="submit" name="orderDirection" value="asc">Ascending sort</button>
						<button type="submit" name="orderDirection" value="desc">Descending sort</button>
					</form>
                </div>
				<?php
					if (isset($_COOKIE['logged'])){
						echo '<form action="send.php" method="post">';
					}
				?>
                <div class="table"> 
		    <div>User name</div>
		    <div>email</div>
		    <div>task</div>
		    <div>progress (to change put a tick)</div>

		    <?php 
			require 'config.php';
			if (isset($_GET['page'])){
				$page = $_GET['page'];    
			} else {
				$page = 0;
			}
			$from = $page * 3;
			if (isset($_GET['orderBy'])){
				if ($_GET['orderDirection'] == 'asc'){
					$query = $pdo->query("SELECT * FROM `tasks1` ORDER BY ". $_GET['orderBy']. " LIMIT $from, 3");	
				} else {	
					$query = $pdo->query("SELECT * FROM `tasks1` ORDER BY ". $_GET['orderBy']. " DESC LIMIT $from, 3");
				}
			} else {
				$query = $pdo->query("SELECT * FROM `tasks1` LIMIT $from, 3");
			}	
			    while ($row = $query->fetch(PDO::FETCH_OBJ)){
					if ($_COOKIE['logged']){								//admin's output
						echo '<div>'. $row->name .'</div>
						     <div>'. $row->email .'</div>
							 <div><input type="text" name="' . $row->id . '" value="'. $row->task_text.'"></div>';
						if ($row->progress == NULL){
						    echo '<div class="not-ready"><input name="check' . $row->id . '" type="checkbox" value="tick"></div>';
						} else {
					    	echo '<div class="ready"><input name="check' . $row->id . '" type="checkbox" value="tonull"></div>';
						}
					} else {												//user's output
						echo '<div>'. $row->name .'</div>
						     <div>'. $row->email .'</div>
						     <div>'. $row->task_text .'</div>';
						if ($row->progress == NULL){
						    echo '<div class="not-ready"></div>';
						} else {
					    	echo '<div class="ready"></div>';
						}
					}
			    }
		    ?>  
                </div>
				<div class="links">
					<?php
						$pagesCount = ceil($counter->count / 3);				//counts pages
						for ($i = 0; $i < $pagesCount; $i++){
							if (isset($_GET['orderBy'])){
								echo "<a href=\"?page=$i&orderBy=" .$_GET['orderBy']. "&orderDirection=".$_GET['orderDirection']."\">". ($i + 1) ."</a>";
							} else {
								echo "<a href=\"?page=$i\">". ($i + 1) ."</a>";
							}
						}
						echo '<br>';
						if (isset($_COOKIE['logged'])){
							echo '
								<button type="submit">Send changes</button>
							</form>';
						}
					?>
				</div>		
            </div>
        </div> 
    </body>
</html>
