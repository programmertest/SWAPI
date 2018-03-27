<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?php echo $this->tag->linkTo(array('classification', 'Go Back')); ?></li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Create classification
    </h1>
</div>

<?php echo $this->getContent(); ?>

<?php echo $this->tag->form(array('classification/create', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal')); ?>

<div class="form-group">
    <label for="fieldClassificationName" class="col-sm-2 control-label">Classification Of Name</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(array('classification_name', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldClassificationName')); ?>
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php echo $this->tag->submitButton(array('Save', 'class' => 'btn btn-default')); ?>
    </div>
</div>

</form>
