<?php
	require 'config.php';
	for ($i = 1; $i <= $counter->count; ++$i){
		$box = 'check' . $i;
		if (isset($_POST[$i])){
			$sqlinputupdate = 'UPDATE `tasks1` SET task_text =\''.htmlspecialchars($_POST[$i]).'\' WHERE id ='.$i;
			$request = $pdo->prepare($sqlinputupdate);			
			$request->execute();
		}
		if (isset($_POST[$box])){
			if ($_POST[$box] == 'tonull'){
				$sqlcheckbox = 'UPDATE `tasks1` SET progress = NULL WHERE id ='. $i ;
				$request = $pdo->prepare($sqlcheckbox);			
				$request->execute();
			} else {
				$sqlcheckbox = 'UPDATE `tasks1` SET progress = 1 WHERE id ='. $i;
				$request = $pdo->prepare($sqlcheckbox);			
				$request->execute();
			}
		}
	}

	header('Location: /');
?>
