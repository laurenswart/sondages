<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=Logout" >
	<div class="nickname"><?php echo htmlentities($model->getLogin()); ?></div> 
	<input class="submit" type="submit" value="Déconnexion" />
</form>
