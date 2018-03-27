<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?php echo $this->tag->linkTo(array('director/index', 'Go Back')); ?></li>
            <li class="next"><?php echo $this->tag->linkTo(array('director/new', 'Create ')); ?></li>
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
            <th>Country Of Code</th>
            <th>Director Of Name</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php if (isset($page->items)) { ?>
        <?php foreach ($page->items as $director) { ?>
            <tr>
                <td><?php echo $director->getId(); ?></td>
            <td><?php echo $director->getCountryCode(); ?></td>
            <td><?php echo $director->getDirectorName(); ?></td>

                <td><?php echo $this->tag->linkTo(array('director/edit/' . $director->getId(), 'Edit')); ?></td>
                <td><?php echo $this->tag->linkTo(array('director/delete/' . $director->getId(), 'Delete')); ?></td>
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
                <li><?php echo $this->tag->linkTo(array('director/search', 'First')); ?></li>
                <li><?php echo $this->tag->linkTo(array('director/search?page=' . $page->before, 'Previous')); ?></li>
                <li><?php echo $this->tag->linkTo(array('director/search?page=' . $page->next, 'Next')); ?></li>
                <li><?php echo $this->tag->linkTo(array('director/search?page=' . $page->last, 'Last')); ?></li>
            </ul>
        </nav>
    </div>
</div>
