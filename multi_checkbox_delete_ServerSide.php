<?php
	if( @$_GET['action'] == "deletelink" && 
		!empty($_GET['id']) && is_numeric($_GET['id']) ) 
	{
    	$result = mysql_query("SELECT * FROM books WHERE id='".intval($_GET['id'] ) );

    	while ($row = mysql_fetch_array ($result) )
       		unlink("/home/me/public_html/upload/image/{$row['image']}");
	}
	if( @$_GET['action'] == "delete_all_url" ) 
	{

		$all_ids = $_GET['id']; 
		// Remove trailing ',' from IDs 
		$all_ids = trim($all_ids, ",");
		// Temporary variable to check only integer value passes
		$tempId = str_replace(",", "", $all_ids);
		
		// Check id numeric or not 
		if ( is_numeric($tempId) ) {			
			$sql_query = "SELECT * FROM books WHERE id in (".intval($_GET['id'].")";
			$result = mysql_query($sql_query);
    		while ($row = mysql_fetch_array ($result) )
       			unlink("/home/me/public_html/upload/image/{$row['image']}");			
		} else {
			//echo 'errors';
		}
    	
	}

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Multi Check box Delete </title>
</head>
<body>
<script src="js/jquery.min.js"></script>


<table>
	<td><a href="javascript:confirmDelete('?action=deleteurl&id=<?php echo 1; ?>')"></a>
		<input type="checkbox" id="myCheck[]" value="1">delete
	</td>
	<td><a href="javascript:confirmDelete('?action=deleteurl&id=<?php echo 1; ?>')"></a>
		<input type="checkbox" id="myCheck[]" value="2">delete
	</td>
	<td><a href="javascript:confirmDelete('?action=deleteurl&id=<?php echo 1; ?>')"></a>
		<input type="checkbox" id="myCheck[]" value="3">delete
	</td>
	<td><a href="javascript:confirmDelete('?action=deleteurl&id=<?php echo 1; ?>')"></a>
		<input type="checkbox" id="myCheck[]" value="4">delete
	</td>
	<td><a href="javascript:confirmDelete('?action=deleteurl&id=<?php echo 1; ?>')"></a>
		<input type="checkbox" id="myCheck[]" value="5">delete
	</td>
	<td><a href="javascript:confirmDelete('?action=deleteurl&id=<?php echo 1; ?>')"></a>
		<input type="button" id="delete_value" name="delete_value" value="Delete" />
	</td>
</table>

<script>
function confirmDelete(delUrl) {
    if (confirm("Are you sure you want to delete")) {
        document.location = delUrl;
    }
}

// Document Ready Start 
$( document ).ready(function() {			
	
	$("#delete_value").on("click", function (e){		
		var val = [];
		var ids = '';
		$(':checkbox:checked').each(function(i){
		  val[i] = $(this).val();
		  console.log($(this).val());
			ids += $(this).val() + ','; 
		});	
		confirmDelete('?action=delete_all_url&id='+ids)				
	});		 
	
 // 	
});
// Document Ready End  
</script>
</body>
</html>