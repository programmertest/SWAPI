<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?php echo $this->tag->linkTo(array('rent/index', 'Go Back')); ?></li>
            <li class="next"><?php echo $this->tag->linkTo(array('rent/new', 'Create ')); ?></li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>Search result</h1>
</div>

<?php echo $this->getContent(); ?>

<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
            <th>Branchoffice</th>
            <th>Client</th>
            <th>Movie</th>
            <th>Rent Of Stardate</th>
            <th>Rent Of Returndate</th>
            <th>Rent Of Value</th>
            <th>Rent Of Amount</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php if (isset($page->items)) { ?>
        <?php foreach ($page->items as $rent) { ?>
            <tr>
                <td><?php echo $rent->rentId; ?></td>
            <td><?php echo $rent->branchofficeName; ?></td>
            <td><?php echo $rent->clientName; ?></td>
            <td><?php echo $rent->movieName; ?></td>
            <td><?php echo $rent->starDate; ?></td>
            <td><?php echo $rent->returnDate; ?></td>
            <td><?php echo $rent->value; ?></td>
            <td><?php echo $rent->amount; ?></td>

                <td><?php echo $this->tag->linkTo(array('rent/edit/' . $rent->rentId, 'Edit')); ?></td>
                <td><a onclick="remove(<?php echo $rent->rentId; ?>)" style="cursor : pointer;">Delete</a></td>
            </tr>
        <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-sm-1">
        <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
            <?php echo $page->current . '/' . $page->total_pages; ?>
        </p>
    </div>
    <div class="col-sm-11">
        <nav>
            <ul class="pagination">
                <li><?php echo $this->tag->linkTo(array('rent/search', 'First')); ?></li>
                <li><?php echo $this->tag->linkTo(array('rent/search?page=' . $page->before, 'Previous')); ?></li>
                <li><?php echo $this->tag->linkTo(array('rent/search?page=' . $page->next, 'Next')); ?></li>
                <li><?php echo $this->tag->linkTo(array('rent/search?page=' . $page->last, 'Last')); ?></li>
            </ul>
        </nav>
    </div>
</div>

<script>
function remove(value){
var opt = confirm("Esta seguro que desea eliminar este registro?"); 
    if (opt == true){	
		location.href = '/videostoreplus/rent/delete/' + value + '';
		}
}

</script>
