<?php
	function listroot(){
		global $mysqli1;
		$DATA=mysqli_query($mysqli1,"select `name` from `menu` where `root`='' order by `priority` asc");
		while($ARRAY=mysqli_fetch_array($DATA)){
			$result.="<option value='$ARRAY[name]'>$ARRAY[name]</option>";
		}
		return $result;
	}
	function listpriority(){
		global $mysqli1;
		for($i=1;$i<=10;$i++){
			$result.="<option value='$i'>$i</option>";
		}
		return $result;
	}
?>