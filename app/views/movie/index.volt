<div class="page-header">
    <h1>
        Search movie
    </h1>
    <p>
        {{ link_to("movie/new", "Create movie") }}
    </p>
</div>

{{ content() }}

{{ form("movie/search", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldId" class="col-sm-2 control-label">Id</label>
    <div class="col-sm-10">
        {{ text_field("id", "type" : "numeric", "class" : "form-control", "id" : "fieldId") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldFormatId" class="col-sm-2 control-label">Format</label>
    <div class="col-sm-10">
        {{ text_field("format_id", "type" : "numeric", "class" : "form-control", "id" : "fieldFormatId") }}
		<div id="format"></div>
    </div>
</div>

<div class="form-group">
    <label for="fieldClassificationId" class="col-sm-2 control-label">Classification</label>
    <div class="col-sm-10">
        {{ text_field("classification_id", "type" : "numeric", "class" : "form-control", "id" : "fieldClassificationId") }}
		<div id="classification"></div>
    </div>
</div>

<div class="form-group">
    <label for="fieldGenreId" class="col-sm-2 control-label">Genre</label>
    <div class="col-sm-10">
        {{ text_field("genre_id", "type" : "numeric", "class" : "form-control", "id" : "fieldGenreId") }}
		<div id="genre"></div>
    </div>
</div>

<div class="form-group">
    <label for="fieldDirectorId" class="col-sm-2 control-label">Director</label>
    <div class="col-sm-10">
        {{ text_field("director_id", "type" : "numeric", "class" : "form-control", "id" : "fieldDirectorId") }}
		<div id="director"></div>
    </div>
</div>

<div class="form-group">
    <label for="fieldActorId" class="col-sm-2 control-label">Actor</label>
    <div class="col-sm-10">
        {{ text_field("actor_id", "type" : "numeric", "class" : "form-control", "id" : "fieldActorId") }}
		<div id="actor"></div>
    </div>
</div>

<div class="form-group">
    <label for="fieldMovieName" class="col-sm-2 control-label">Movie Of Name</label>
    <div class="col-sm-10">
        {{ text_field("movie_name", "size" : 30, "class" : "form-control", "id" : "fieldMovieName") }}
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Search', 'class': 'btn btn-default') }}
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
$.post('http://localhost/videostoreplus/Format/select', function(obj){ 
   var html = '<select id="fieldFormatId" name="format_id" class="form-control">';  
       html += '<option value = "">-- Select --</option>';  
   var data = JSON.parse(obj);
   jQuery.each(data, function (index, value) {
        if (typeof value != 'object')
            html += '<option value="' + index + '" ' + (index==$('#fieldFormatId').val()?'selected=selected':'') + '>' + value + '</option>'; 
    });
	html += '</select>';
	$('#fieldFormatId').remove();
	$('#format').html(html);

});
$.post('http://localhost/videostoreplus/Classification/select', function(obj){ 
   var html = '<select id="fieldClassificationId" name="classification_id" class="form-control">';  
       html += '<option value = "">-- Select --</option>';  
   var data = JSON.parse(obj);
   jQuery.each(data, function (index, value) {
        if (typeof value != 'object')
            html += '<option value="' + index + '" ' + (index==$('#fieldFormatId').val()?'selected=selected':'') + '>' + value + '</option>'; 
    });
	html += '</select>';
	$('#fieldClassificationId').remove();
	$('#classification').html(html);

});
$.post('http://localhost/videostoreplus/Genre/select', function(obj){
   var html = '<select id="fieldGenreId" name="genre_id" class="form-control">';  
       html += '<option value = "">-- Select --</option>';  
   var data = JSON.parse(obj);
   jQuery.each(data, function (index, value) {
        if (typeof value != 'object')
            html += '<option value="' + index + '" ' + (index==$('#fieldFormatId').val()?'selected=selected':'') + '>' + value + '</option>'; 
    });
	html += '</select>';
	$('#fieldGenreId').remove();
	$('#genre').html(html);

});
$.post('http://localhost/videostoreplus/Director/select', function(obj){
   var html = '<select id="fieldDirectorId" name="director_id" class="form-control">';  
       html += '<option value = "">-- Select --</option>';  
   var data = JSON.parse(obj);
   jQuery.each(data, function (index, value) {
        if (typeof value != 'object')
            html += '<option value="' + index + '" ' + (index==$('#fieldFormatId').val()?'selected=selected':'') + '>' + value + '</option>'; 
    });
	html += '</select>';
	$('#fieldDirectorId').remove();
	$('#director').html(html);

});
$.post('http://localhost/videostoreplus/Actor/select', function(obj){
   var html = '<select id="fieldActorId" name="actor_id" class="form-control">';  
       html += '<option value = "">-- Select --</option>';  
   var data = JSON.parse(obj);
   jQuery.each(data, function (index, value) {
        if (typeof value != 'object')
            html += '<option value="' + index + '" ' + (index==$('#fieldFormatId').val()?'selected=selected':'') + '>' + value + '</option>'; 
    });
	html += '</select>';
	$('#fieldActorId').remove();
	$('#actor').html(html);

});
</script>

</form>
