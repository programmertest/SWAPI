<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?php echo $this->tag->linkTo(array('format', 'Go Back')); ?></li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Edit format
    </h1>
</div>

<?php echo $this->getContent(); ?>

<?php echo $this->tag->form(array('format/save', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal')); ?>

<div class="form-group">
    <label for="fieldFormatName" class="col-sm-2 control-label">Format Of Name</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(array('format_name', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldFormatName')); ?>
    </div>
</div>


<?php echo $this->tag->hiddenField(array('id')); ?>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php echo $this->tag->submitButton(array('Send', 'class' => 'btn btn-default')); ?>
    </div>
</div>

</form>
