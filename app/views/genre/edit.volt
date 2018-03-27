<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("genre", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Edit genre
    </h1>
</div>

{{ content() }}

{{ form("genre/save", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldGenreName" class="col-sm-2 control-label">Genre Of Name</label>
    <div class="col-sm-10">
        {{ text_field("genre_name", "size" : 30, "class" : "form-control", "id" : "fieldGenreName") }}
    </div>
</div>


{{ hidden_field("id") }}

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Send', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
