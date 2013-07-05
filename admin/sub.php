<?php
	require_once'session2.php';
	require_once'../config.php';
	$sub = $_GET['sub'];
	$list = $_GET['list'];
	if(!isset($sub) && !isset($list)){
		header('location:admin.php');	
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Admin Panel</title>
<link rel="shortcut icon" href="../images/ico.png" />
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="jquery/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="jquery/jquery-easing.js"></script>
<script type="text/javascript" src="jquery/jquery.cycle.all.js"></script>
<script type="text/javascript">
								
/*		$(document).ready(function(){
			
			$(".parent").toggle(
					function(){
					$(this).next().slideUp();
				},
					function(){
					$(this).next().slideDown();
				}
			);
			
		
		});*/
		
</script>

<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
	include('header.php');
?>
<div class="clear"></div>
	<div id="wrapper">
		<div id="nav">
        
		<?php
			include('nav.php');
		?>
		</div><!--nav-->
		<div id="content">
        
        <?php
		if($_GET['ref'] == "added"){
		echo "<p>Successfully Update / Berhasil Ditambah</p>";
		}else if($_GET['ref'] == "ada"){
			echo "<p>Already Exist / Nama Telah ada, Pilih Nama Lain..</p>";
		}else{
		
		}
		if($sub == "news"){
		$query_news=mysql_query("select * from news");
		$row_news=mysql_fetch_object($query_news);
		$num_news=mysql_num_rows($query_news);
		?>
 		<h3>News</h3><hr />
        <?php
				
			if($num_news !== 0){
				do{
				echo "<p><input type=\"button\" value=\"Delete\" title=\"$row_news->news_id\" onclick=\"del_list(this.title)\" /><a href=\"sub.php?list=$row_news->news_id\" class=\"list_page\">$row_news->news_name</a></p>";
				}while($row_news=mysql_fetch_object($query_news));
			}else{
				echo "No News List..";
			}
		?>
        <hr />
        
        <input type="button" value="Add new sub list"  title="<?php echo $sub; ?>" onclick="new_sub_list(this.title)" />
        
        <?php
		}else if(isset($list)){
			$q_cont=mysql_query("select * from news where news_id='$list'");
			$r_cont=mysql_fetch_object($q_cont);
		?>
        <form action="sub_page_edit.php?list=<?php echo $r_cont->news_id; ?>" method="post">
<p><label for="page_name" class="italic">Page Name :</label><br /><input type="text" id="page_name" name="page_name" value="<?php echo $r_cont->news_name; ?>" /></p>
<p><label for="page_content" class="italic">Content :</label><br /><textarea id="page_content" name="page_content"><?php echo $r_cont->news_content; ?></textarea></p>
<script type="text/javascript">
	var editor = CKEDITOR.replace( 'page_content' );
	CKFinder.SetupCKEditor( editor, 'ckfinder' );
</script>

<input type="submit" value="Save" />

		</form>
		<?php
		}
		?>
        
        
		</div><!--content-->
		<div class="clear"></div>
	</div><!--wrapper-->
<script type="text/javascript">
	function new_sub_list(z){
			location.href = "sub_list_add.php?sub=" + z;
	}
	
	function del_sub_page(title){
		var x = confirm("Are You sure want to delete this Sub Page["+title+"]?");
		if(x){
			location.href = "sub_page_exec.php?sub=" + title;
		}else{
			return false;
		}
	}
	
	function del_list(title){
		var x = confirm("Are You sure want to delete this List Page["+title+"]?");
		if(x){
			location.href = "sub_page_exec.php?list=" + title;
		}else{
			return false;
		}
	}
	
	$('#sub_name').click(function(){
			var x = prompt("Rename : ");
			if(x){
				location.href = "sub_page_exec.php?ren=" + x + "&page=<?php echo $sub;?>";
			}else{
				return false;
			}
	});
	
	$('#sub_nama').click(function(){
			var x = prompt("Ganti Nama : ");
			if(x){
				location.href = "sub_page_exec.php?ren_ind=" + x + "&page=<?php echo $sub;?>";
			}else{
				return false;
			}
	});
	
</script>
</body>
</html>