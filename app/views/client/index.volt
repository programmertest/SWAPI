<div class="page-header">
    <h1>
        Search client
    </h1>
    <p>
        {{ link_to("client/new", "Create client") }}
    </p>
</div>

{{ content() }}

{{ form("client/search", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldId" class="col-sm-2 control-label">Id</label>
    <div class="col-sm-10">
        {{ text_field("id", "type" : "numeric", "class" : "form-control", "id" : "fieldId") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldClientName" class="col-sm-2 control-label">Client Of Name</label>
    <div class="col-sm-10">
        {{ text_field("client_name", "size" : 30, "class" : "form-control", "id" : "fieldClientName") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldClientSurname" class="col-sm-2 control-label">Client Of Surname</label>
    <div class="col-sm-10">
        {{ text_field("client_surname", "size" : 30, "class" : "form-control", "id" : "fieldClientSurname") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldClientPhone" class="col-sm-2 control-label">Client Of Phone</label>
    <div class="col-sm-10">
        {{ text_field("client_phone", "size" : 30, "class" : "form-control", "id" : "fieldClientPhone") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldClientAddress" class="col-sm-2 control-label">Client Of Address</label>
    <div class="col-sm-10">
        {{ text_field("client_address", "size" : 30, "class" : "form-control", "id" : "fieldClientAddress") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldClientMobile" class="col-sm-2 control-label">Client Of Mobile</label>
    <div class="col-sm-10">
        {{ text_field("client_mobile", "size" : 30, "class" : "form-control", "id" : "fieldClientMobile") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldClientEmail" class="col-sm-2 control-label">Client Of Email</label>
    <div class="col-sm-10">
        {{ text_field("client_email", "size" : 30, "class" : "form-control", "id" : "fieldClientEmail") }}
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Search', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
