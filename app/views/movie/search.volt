<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("movie/index", "Go Back") }}</li>
            <li class="next">{{ link_to("movie/new", "Create ") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>Search result</h1>
</div>

{{ content() }}

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
        {% if page.items is defined %}
        {% for movie in page.items %}
            <tr>
            <td>{{ movie.movieId }}</td>
            <td>{{ movie.formatName }}</td>
			<td>{{ movie.classificationName }}</td>
			<td>{{ movie.genreName }}</td>
			<td>{{ movie.directorName }}</td>
			<td>{{ movie.actorName }}</td>
			<td>{{ movie.movieName }}</td>

                <td>{{ link_to("movie/edit/"~movie.movieId, "Edit") }}</td>
                <td>{{ link_to("movie/delete/"~movie.movieId, "Delete") }}</td>
            </tr>
        {% endfor %}
        {% endif %}
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-sm-1">
        <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
            {{ page.current~"/"~page.total_pages }}
        </p>
    </div>
    <div class="col-sm-11">
        <nav>
            <ul class="pagination">
                <li>{{ link_to("movie/search", "First") }}</li>
                <li>{{ link_to("movie/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("movie/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("movie/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
