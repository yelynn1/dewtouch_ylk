<div class="row-fluid">
	<div class="alert alert-info">
		<h3>Data Migration</h3>
	</div>

	<hr />

	<div class="alert">
		<h3>Import Form</h3>
        <strong>If your file is xls or xlsx, please change to csv format first.</strong>
	</div>
<?php
echo $this->Form->create('Migrate', array('type' => 'file'));
echo $this->Form->input('file', array('label' => 'File Upload', 'type' => 'file'));
echo $this->Form->submit('Upload', array('class' => 'btn btn-primary'));
echo $this->Form->end();
?>

</div>