<div class="page-header">
    <h1>
        Search director
    </h1>
    <p>
        <?php echo $this->tag->linkTo(array('director/new', 'Create director')); ?>
    </p>
</div>

<?php echo $this->getContent(); ?>

<?php echo $this->tag->form(array('director/search', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal')); ?>

<div class="form-group">
    <label for="fieldId" class="col-sm-2 control-label">Id</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(array('id', 'type' => 'numeric', 'class' => 'form-control', 'id' => 'fieldId')); ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldCountryCode" class="col-sm-2 control-label">Country Of Code</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(array('country_code', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldCountryCode')); ?>
		<div id="country"></div>
    </div>
</div>

<div class="form-group">
    <label for="fieldDirectorName" class="col-sm-2 control-label">Director Of Name</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(array('director_name', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldDirectorName')); ?>
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php echo $this->tag->submitButton(array('Search', 'class' => 'btn btn-default')); ?>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
$.post('http://localhost/videostoreplus/Country/select', function(obj){ 
   var html = '<select id="fieldCountryCode" name="country_code" class="form-control">';  
       html += '<option value = "">-- Select --</option>';  
   var data = JSON.parse(obj);
   jQuery.each(data, function (index, value) {
        if (typeof value != 'object')
            html += '<option value="' + index + '" ' + (index==$('#fieldCountryCode').val()?'selected=selected':'') + '>' + value + '</option>'; 
    });
	html += '</select>';
	$('#fieldCountryCode').remove();
	$('#country').html(html);

});
</script>

</form>
