<?php

include "../koneksidb.php";

if($_SESSION['level']=='admin'){ 

echo "
<html>
<head><title> LOGIN </title></head>
<body>
	<fieldset>
		<legend> Ganti Password  </legend>
			<form method='POST' action='proses_admin.php?a=gantipassword' enctype='multipart/form-data'>
				
				Password Lama : <input type='text' name='pl'><br><br>
				Password Baru : <input type='text' name='pb' ><br><br>
				Ulangi Password Baru : <input type='text' name='pb2'><br><br>
				
				<input type='submit' value='GANTI' name='GANTI'>
			</form>
	</fieldset>	<br>
	<a href='homepage.php'><input type='Submit' value=' KEMBALI '></a>
</body>
</html>
";

		

}else{
	header('location:../login.php');
}

?>
