<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?php echo $this->tag->linkTo(array('movie/index', 'Go Back')); ?></li>
            <li class="next"><?php echo $this->tag->linkTo(array('movie/new', 'Create ')); ?></li>
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
            <th>Format</th>
            <th>Classification</th>
            <th>Genre</th>
            <th>Director</th>
            <th>Actor</th>
            <th>Movie Of Name</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php if (isset($page->items)) { ?>
        <?php foreach ($page->items as $movie) { ?>
            <tr>
            <td><?php echo $movie->movieId; ?></td>
            <td><?php echo $movie->formatName; ?></td>
			<td><?php echo $movie->classificationName; ?></td>
			<td><?php echo $movie->genreName; ?></td>
			<td><?php echo $movie->directorName; ?></td>
			<td><?php echo $movie->actorName; ?></td>
			<td><?php echo $movie->movieName; ?></td>

                <td><?php echo $this->tag->linkTo(array('movie/edit/' . $movie->movieId, 'Edit')); ?></td>
                <td><?php echo $this->tag->linkTo(array('movie/delete/' . $movie->movieId, 'Delete')); ?></td>
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
                <li><?php echo $this->tag->linkTo(array('movie/search', 'First')); ?></li>
                <li><?php echo $this->tag->linkTo(array('movie/search?page=' . $page->before, 'Previous')); ?></li>
                <li><?php echo $this->tag->linkTo(array('movie/search?page=' . $page->next, 'Next')); ?></li>
                <li><?php echo $this->tag->linkTo(array('movie/search?page=' . $page->last, 'Last')); ?></li>
            </ul>
        </nav>
    </div>
</div>
