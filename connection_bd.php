<?php
$servername = "localhost";
$username = "root";
$password = "12345";
$charset = "utf8";
$db = "usersbd";
$conn = db_connect($servername,$username,$password,$charset,$db);
if (!$conn)
	throw new Exception(sprintf('Не удалось выполнить запрос к БД, код ошибки %d, текст ошибки: %s', mysqli_errno($res), mysqli_error($res)));
else 
echo "<br/>";
    function db_connect( $servername, $username,$password,$charset,$db)
{$res = mysqli_connect($servername, $username,$password,$db);
	if (!$res)
		return(False);
	$charset = mysqli_set_charset($res,$charset);
	if ( !$charset)
		return(False);
	return($res);
}
?>