<?php
	require_once'session2.php';
	include('../config.php');
	
	$tbl_name="category";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 2;
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT COUNT(*) as num FROM $tbl_name";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];
	
	/* Setup vars for query. */
	$targetpage = "product.php"; 	//your file name  (the name of this file)
	$limit = 4; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$sql = "SELECT * FROM $tbl_name order by `cate_name` LIMIT $start, $limit";
	
	$result = mysql_query($sql);
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage?page=$prev\">« previous</a>";
		else
			$pagination.= "<span class=\"disabled\">« previous</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?page=$next\">next »</a>";
		else
			$pagination.= "<span class=\"disabled\">next »</span>";
		$pagination.= "</div>\n";		
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
								
		$(document).ready(function(){
			
			/*$(".parent").toggle(
					function(){
					$(this).next().slideDown();
				},
					function(){
						$(this).next().slideUp();
				}
			);*/
			
		
		});
		
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
        <input type="button" value="Tambah Category" onclick="cate_add()" />  <input type="button" value="Tambah Product" onclick="prd_add()" />  <input type="button" value="View Product" onclick="view_prd()" />
        <?php
			
				if($_GET['ref'] == 'edited'){
					echo "<p>Your Category has been Edited..</p>";
				}else if($_GET['ref'] == 'deleted'){
					echo "<p>Your Category has been Deleted..</p>";
				}else if($_GET['ref'] == 'added'){
					echo "<p>Your Category has been Added..</p>";
				}else{
				
				}

		?>
        	<table border="0" cellspacing="2" cellpadding="5" width="100%">
				  <thead>
					<th>Id</th>
					<th>Photo</th>
					<th>Category</th>
                    <th>Entry Date</th>
                    <th>Last Update</th>
					<th>Action</th>
				  </thead>
				<?php
				while($row = mysql_fetch_array($result)){
				?>
				
					<tr>
                        <td class="bold"><?php echo $row['cate_id']; ?></td>
                        <td><img src="../uploads/thumbs/<?php echo $row['cate_img']; ?>" width="100" /></td>
                        <td><a href="<?php echo "view_prd.php?cat=".$row['cate_name'];?>"><?php echo $row['cate_name']; ?></td>
                        <td><?php echo $row['entry_date']; ?></td>
                        <td><?php echo $row['last_update']; ?></td>
                        <td>
                        	<a href="<?php echo "cate_edit.php?id=".$row['cate_id'];?>"><input type="button" value="Edit" onclick="cate_edit(this.title)" title="<?php echo $row['cate_id']; ?>" /></a>
                        	<input type="button" value="Delete" onclick="delete_user(this.title)" title="<?php echo $row['cate_id']; ?>" />
                        </td> 
					</tr>
				<?php 
				}
				?>
			</table>
            <?php echo $pagination; ?>

		</div><!--content-->
		<div class="clear"></div>
	</div><!--wrapper-->
<script type="text/javascript">
	function delete_user(title){
		var x = confirm("Are You sure want to delete this Category?["+title+"]?");
		if(x){
			location.href = "cate_delete.php?id=" + title;
		}else{
			return false;
		}
	}
	
	function prd_edit(title){
			location.href = "prd_edit.php?id=" + title;
	}
	
	function prd_add(){
			location.href = "prd_add.php";
	}
	function cate_add(){
			location.href = "cate_add.php";
	}
	function view_prd(){
			location.href = "view_prd.php";
	}
</script>
</body>
</html>