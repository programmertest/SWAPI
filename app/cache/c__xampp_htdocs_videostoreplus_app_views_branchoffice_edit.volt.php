<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?php echo $this->tag->linkTo(array('branchoffice', 'Go Back')); ?></li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Edit branchoffice
    </h1>
</div>

<?php echo $this->getContent(); ?>

<?php echo $this->tag->form(array('branchoffice/save', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal')); ?>

<div class="form-group">
    <label for="fieldBranchofficeName" class="col-sm-2 control-label">Branchoffice Of Name</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(array('branchoffice_name', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldBranchofficeName')); ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldBranchofficePhone" class="col-sm-2 control-label">Branchoffice Of Phone</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(array('branchoffice_phone', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldBranchofficePhone')); ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldBranchofficeAddress" class="col-sm-2 control-label">Branchoffice Of Address</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(array('branchoffice_address', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldBranchofficeAddress')); ?>
    </div>
</div>


<?php echo $this->tag->hiddenField(array('id')); ?>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php echo $this->tag->submitButton(array('Send', 'class' => 'btn btn-default')); ?>
    </div>
</div>

</form>
