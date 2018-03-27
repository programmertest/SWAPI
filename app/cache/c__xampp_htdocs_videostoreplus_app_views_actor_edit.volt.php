<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?php echo $this->tag->linkTo(array('actor', 'Go Back')); ?></li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Edit actor
    </h1>
</div>

<?php echo $this->getContent(); ?>

<?php echo $this->tag->form(array('actor/save', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal')); ?>

<div class="form-group">
    <label for="fieldCountryCode" class="col-sm-2 control-label">Country Of Code</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(array('country_code', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldCountryCode')); ?>
		<div id="country"></div>
    </div>
</div>

<div class="form-group">
    <label for="fieldActorName" class="col-sm-2 control-label">Actor Of Name</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(array('actor_name', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldActorName')); ?>
    </div>
</div>


<?php echo $this->tag->hiddenField(array('id')); ?>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php echo $this->tag->submitButton(array('Send', 'class' => 'btn btn-default')); ?>
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
