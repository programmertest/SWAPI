<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("format", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Edit format
    </h1>
</div>

{{ content() }}

{{ form("format/save", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldFormatName" class="col-sm-2 control-label">Format Of Name</label>
    <div class="col-sm-10">
        {{ text_field("format_name", "size" : 30, "class" : "form-control", "id" : "fieldFormatName") }}
    </div>
</div>


{{ hidden_field("id") }}

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Send', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
