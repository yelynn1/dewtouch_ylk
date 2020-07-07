<div class="alert  ">
<button class="close" data-dismiss="alert"></button>
Question: Advanced Input Field</div>

<p>
1. Make the Description, Quantity, Unit price field as text at first. When user clicks the text, it changes to input field for use to edit. Refer to the following video.

</p>


<p>
2. When user clicks the add button at left top of table, it wil auto insert a new row into the table with empty value. Pay attention to the input field name. For example the quantity field

<?php echo htmlentities('<input name="data[1][quantity]" class="">')?> ,  you have to change the data[1][quantity] to other name such as data[2][quantity] or data["any other not used number"][quantity]

</p>



<div class="alert alert-success">
<button class="close" data-dismiss="alert"></button>
The table you start with</div>

<table class="table table-striped table-bordered table-hover">
<thead>
<th><span id="add_item_button" class="btn mini green addbutton" onclick="addToObj=false">
											<i class="icon-plus"></i></span></th>
<th>Description</th>
<th>Quantity</th>
<th>Unit Price</th>
</thead>

<tbody id="tablebody">
	<tr id="row">
		<th class="del">x</th>
		<td class="editable"><textarea name="data[1][description]" class="m-wrap  description required editinput" rows="2" style="display:none"></textarea><span></span></td>
		<td class="editable"><input name="data[1][quantity]" class="editinput" style="display:none" ><span></span></td>
		<td class="editable"><input name="data[1][unit_price]"  class="editinput" style="display:none" ><span></span></td>
	</tr>
</tbody>

</table>


<p></p>
<div class="alert alert-info ">
<button class="close" data-dismiss="alert"></button>
Video Instruction</div>

<p style="text-align:left;">
<video width="78%"   controls>
  <source src="/video/q3_2.mov">
Your browser does not support the video tag.
</video>
</p>





<?php $this->start('script_own');?>
<script>
$(document).ready(function(){

	var numrow = 1;
	var new_row = "<tr>" + $('#row').html() + "</tr>";
	
	$("#add_item_button").click(function(){
		numrow++;
		var new_row_element = new_row.replace(/1/g, numrow);
		$("#tablebody").append(new_row_element);
		//console.log(new_row_element);
		});

	$("table").on('click', ".editable", function(){
		//alert("clicked");
		var text = $(this).children().eq(1);
		text.css({'display': 'none'});
		var input = $(this).children().eq(0);
		input.css({'display': 'block'});
		input.focus();
	});

	$("table").on('focusout', '.editinput', function(){
		var input = $(this);
		input.css({'display': 'none'});
		var text = input.next();
		text.css({'display': 'block'});
		text.text(input.val());
	});

	$("table").on("click", ".del", function(){
		var obj = $(this).parent().remove();
	});
	
});
</script>
<?php $this->end();?>

