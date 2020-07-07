
<div class="row-fluid">
	<div class="span6">
		<div id="" class="dataTables_length">
			<label>
			<select size="1" id="page">
				<option value="10" selected="selected">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option>
			</select> records per page
			</label>
		</div>
	</div>
	<div class="span6">
		<div class="dataTables_filter">
			<label>Search:
				<input type="text" id="searchbox">
				<button type="submit" class="btn btn-primary" id="submitbtn">Search</button>
			</label>
			
		</div>
	</div>

	<table class="table table-bordered" id="table_records">
		<thead>
			<tr>
				<th>ID</th>
				<th>NAME</th>	
			</tr>
		</thead>
		<tbody>
			<?php foreach($records as $record):?>
			<tr>
				<td><?php echo $record['Record']['id']?></td>
				<td><?php echo $record['Record']['name']?></td>
			</tr>	
			<?php endforeach;?>
		</tbody>
	</table>

	<?php
		$paginator = $this->Paginator;
		echo "<div class='paging'>";
		echo "<button class='btn btn-primary'>" . $paginator->first("First") . "</button>";
		if($paginator->hasPrev()){
            echo "<button class='btn btn-primary'>" . $paginator->prev("Prev") . "</button>";
        }
        echo "<button class='btn btn-primary'>" . $paginator->numbers(array('modulus' => 2)) . "</button>";
        if($paginator->hasNext()){
            echo"<button class='btn btn-primary'>" .  $paginator->next("Next") . "</button>";
        }
        echo "<button class='btn btn-primary'>" .  $paginator->last("Last") . "</button>";
     
    	echo "</div>";
     
	?>
</div>
<?php $this->start('script_own')?>
<script>
// $(document).ready(function(){
// 	$("#table_records").dataTable({
// 	});
// })
$(document).ready(function(){

	var urlParams = new URLSearchParams(window.location.search);
	if (urlParams.has('limit')){
		$("#page").val(urlParams.get('limit'));
	}

	$('#page').on('change', function() {
		var page = this.value;
		var server_url = "/Record?limit=" + page;
		if (urlParams.has('search')) {
			server_url += "&search=" + urlParams.get("search");
		}
		$(location).attr('href',server_url);
	});

	$("#submitbtn").click(function() {
		var keyword = $("#searchbox").val();
		var server_url = "/Record?search=" + keyword;
		if(urlParams.has('limit')) {
			server_url += "&limit=" + urlParams.get("limit");
		}
		$(location).attr('href',server_url);
	}
	);

});
</script>
<?php $this->end()?>