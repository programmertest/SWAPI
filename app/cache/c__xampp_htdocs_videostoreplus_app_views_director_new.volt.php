<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?php echo $this->tag->linkTo(array('director', 'Go Back')); ?></li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Create director
    </h1>
</div>

<?php echo $this->getContent(); ?>

<?php echo $this->tag->form(array('director/create', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal')); ?>

<div class="form-group">
    <label for="fieldCountryCode" class="col-sm-2 control-label">Country Of Code</label>
    <div class="col-sm-10">
        
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
        <?php echo $this->tag->submitButton(array('Save', 'class' => 'btn btn-default')); ?>
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
            html += '<option value="' + index + '">' + value + '</option>'; 
    });
	html += '</select>';
	$('#country').html(html);

});
</script>
</form>
