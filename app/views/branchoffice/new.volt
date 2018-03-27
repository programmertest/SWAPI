<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("branchoffice", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Create branchoffice
    </h1>
</div>

{{ content() }}

{{ form("branchoffice/create", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldBranchofficeName" class="col-sm-2 control-label">Branchoffice Of Name</label>
    <div class="col-sm-10">
        {{ text_field("branchoffice_name", "size" : 30, "class" : "form-control", "id" : "fieldBranchofficeName") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldBranchofficePhone" class="col-sm-2 control-label">Branchoffice Of Phone</label>
    <div class="col-sm-10">
        {{ text_field("branchoffice_phone", "size" : 30, "class" : "form-control", "id" : "fieldBranchofficePhone") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldBranchofficeAddress" class="col-sm-2 control-label">Branchoffice Of Address</label>
    <div class="col-sm-10">
        {{ text_field("branchoffice_address", "size" : 30, "class" : "form-control", "id" : "fieldBranchofficeAddress") }}
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Save', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
