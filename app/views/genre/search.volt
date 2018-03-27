<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("genre/index", "Go Back") }}</li>
            <li class="next">{{ link_to("genre/new", "Create ") }}</li>
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
            <th>Genre Of Name</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for genre in page.items %}
            <tr>
                <td>{{ genre.getId() }}</td>
            <td>{{ genre.getGenreName() }}</td>

                <td>{{ link_to("genre/edit/"~genre.getId(), "Edit") }}</td>
                <td>{{ link_to("genre/delete/"~genre.getId(), "Delete") }}</td>
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
                <li>{{ link_to("genre/search", "First") }}</li>
                <li>{{ link_to("genre/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("genre/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("genre/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
