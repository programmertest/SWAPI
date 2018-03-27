<div class="page-header">
    <h1>
        Search classification
    </h1>
    <p>
        <?php echo $this->tag->linkTo(array('classification/new', 'Create classification')); ?>
    </p>
</div>

<?php echo $this->getContent(); ?>

<?php echo $this->tag->form(array('classification/search', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal')); ?>

<div class="form-group">
    <label for="fieldId" class="col-sm-2 control-label">Id</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(array('id', 'type' => 'numeric', 'class' => 'form-control', 'id' => 'fieldId')); ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldClassificationName" class="col-sm-2 control-label">Classification Of Name</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(array('classification_name', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldClassificationName')); ?>
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php echo $this->tag->submitButton(array('Search', 'class' => 'btn btn-default')); ?>
    </div>
</div>

</form>
