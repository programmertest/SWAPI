<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("country", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Create country
    </h1>
</div>

{{ content() }}

{{ form("country/create", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldCountryCode" class="col-sm-2 control-label">Country Of Code</label>
    <div class="col-sm-10">
        {{ text_field("country_code", "size" : 30, "class" : "form-control", "id" : "fieldCountryCode") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCountryName" class="col-sm-2 control-label">Country Of Name</label>
    <div class="col-sm-10">
        {{ text_field("country_name", "size" : 30, "class" : "form-control", "id" : "fieldCountryName") }}
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Save', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
