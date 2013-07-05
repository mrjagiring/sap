<?php
	require_once'session2.php';
	require_once'../config.php';
	$sql_alb="select distinct gal_album, gal_alias from gallery order by gal_album ASC";
	$query_alb=mysql_query($sql_alb);
	$row_alb=mysql_fetch_object($query_alb);
	$num_alb=mysql_num_rows($query_alb);
	
	$sql_img="select * from gallery_img where gal_alias='$_GET[album]'";
	$query_img=mysql_query($sql_img);
	$row_img=mysql_fetch_object($query_img);
	$num_img=mysql_num_rows($query_img);
	
	$x=mysql_fetch_object(mysql_query("select * from gallery where gal_alias='$_GET[album]'"));

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript" src="jquery/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="jquery/jquery-easing.js"></script>
<script type="text/javascript" src="jquery/jquery.cycle.all.js"></script>
<script type="text/javascript">
								
		$(document).ready(function(){
			
			/*$(".parent").toggle(
					function(){
					$(this).next().slideUp();
				},
					function(){
					$(this).next().slideDown();
				}
			);*/
			
		});
		
		function new_window(){
		window.open('add_alb_img.php?album=<?php echo $x->gal_alias; ?>','image','width=400,height=250,screenX=50,screenY=50,scrollbars=yes,dependent=yes,location=no');
		}
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
				if(isset($_GET[album])){
					echo "<h3>".$x->gal_album."</h3>";
					echo "<hr />";
					if($num_img > 0){
						do{
						echo '<div id="img_alb">
							<img src="../uploads/thumbs/'.$row_img->img.'" alt="" />
							<h4>'.$row_img->title.'</h4>
							<input type="button" value="Delete" style="font-size:12px" title="'.$row_img->id.'" onclick="delete_img(this.title)" />
							</div>';
						}while($row_img=mysql_fetch_object($query_img));
					}else{
						echo "<h4>This Album is Empty...</h4>";
					}
			?>
                    <div class="clear"></div>
                    <hr />
                    <input type="button" value="Add Image" style="font-size:12px"  onclick="new_window()" id="add_img" />
				<?php
				}else{
				
                    if($num_alb > 0){
                    
                ?>
                    <table cellpadding="5">
                        <thead>
                            <th>Nama Album</th>
                            <th colspan="2">Action</th>
                        </thead>
                    <?php
                        do{
                    ?>
                        <tr>
                            <td><?php echo $row_alb->gal_album;?></td>
                            <td><input type="button" value="View Images" style="font-size:12px" title="<?php echo $row_alb->gal_alias; ?>" onclick="view_album(this.title)" /></td>
                            <td><input type="button" value="Delete Album" style="font-size:12px" title="<?php echo $row_alb->gal_alias; ?>" onclick="delete_album(this.title)" /></td>
                        </tr>
                    <?php
                        }while($row_alb=mysql_fetch_object($query_alb));
                    ?>
                    </table>
                    <input type="button" value="Add New Album" id="add_alb" style="font-size:12px; margin:10px 0 0 0" />
                 <?php
                    }else{
                        echo "<h3>Belum ada Daftar Album</h3><br /><input type=\"button\" value=\"Album Baru\" id=\"add_alb\" />";
                    }
				}
                 ?>
		</div><!--content-->
		<div class="clear"></div>
	</div><!--wrapper-->
<script type="text/javascript">
	function delete_album(title){
		var x = confirm("Are You sure want to delete this Album["+title+"]?");
		if(x){
			location.href = "alb_del.php?album=" + title;
		}else{
			return false;
		}
	}
	
	function delete_img(title){
		var x = confirm("Are You sure want to delete this Photo["+title+"]?");
		if(x){
			location.href = "img_del.php?id=" + title;
		}else{
			return false;
		}
	}
	
	function view_album(title){
		location.href = "gallery.php?album=" + title;
	}
	
	
		$('#add_alb').click(function(){
			var x = prompt("Please input new Album : ");
			//alert(x);
			if(x){
				location.href = "alb_add.php?album=" + x;
			}else{
				return false;
			}
		});
</script>
</body>
</html>