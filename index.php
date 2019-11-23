<?php
	if (isset($_POST['button']))
	{
		exec('pull.sh')
	}
?>
<html>
<h1> Welcome DB world! Sibal </h1>
Test2
<form method="post">
	<button name="button">pull</button>
</form>

</html>
