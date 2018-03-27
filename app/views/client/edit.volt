<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("client", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Edit client
    </h1>
</div>

{{ content() }}

{{ form("client/save", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

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


{{ hidden_field("id") }}

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Send', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
