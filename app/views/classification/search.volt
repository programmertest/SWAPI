<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("classification/index", "Go Back") }}</li>
            <li class="next">{{ link_to("classification/new", "Create ") }}</li>
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
            <th>Classification Of Name</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for classification in page.items %}
            <tr>
                <td>{{ classification.getId() }}</td>
            <td>{{ classification.getClassificationName() }}</td>

                <td>{{ link_to("classification/edit/"~classification.getId(), "Edit") }}</td>
                <td>{{ link_to("classification/delete/"~classification.getId(), "Delete") }}</td>
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
                <li>{{ link_to("classification/search", "First") }}</li>
                <li>{{ link_to("classification/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("classification/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("classification/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
