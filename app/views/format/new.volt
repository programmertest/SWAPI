<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("format", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Create format
    </h1>
</div>

{{ content() }}

{{ form("format/create", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldFormatName" class="col-sm-2 control-label">Format Of Name</label>
    <div class="col-sm-10">
        {{ text_field("format_name", "size" : 30, "class" : "form-control", "id" : "fieldFormatName") }}
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Save', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
