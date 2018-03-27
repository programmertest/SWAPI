<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?php echo $this->tag->linkTo(array('genre', 'Go Back')); ?></li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Edit genre
    </h1>
</div>

<?php echo $this->getContent(); ?>

<?php echo $this->tag->form(array('genre/save', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal')); ?>

<div class="form-group">
    <label for="fieldGenreName" class="col-sm-2 control-label">Genre Of Name</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(array('genre_name', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldGenreName')); ?>
    </div>
</div>


<?php echo $this->tag->hiddenField(array('id')); ?>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php echo $this->tag->submitButton(array('Send', 'class' => 'btn btn-default')); ?>
    </div>
</div>

</form>
