<div class="page-header">
    <h1>
        Search classification
    </h1>
    <p>
        {{ link_to("classification/new", "Create classification") }}
    </p>
</div>

{{ content() }}

{{ form("classification/search", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldId" class="col-sm-2 control-label">Id</label>
    <div class="col-sm-10">
        {{ text_field("id", "type" : "numeric", "class" : "form-control", "id" : "fieldId") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldClassificationName" class="col-sm-2 control-label">Classification Of Name</label>
    <div class="col-sm-10">
        {{ text_field("classification_name", "size" : 30, "class" : "form-control", "id" : "fieldClassificationName") }}
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Search', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
