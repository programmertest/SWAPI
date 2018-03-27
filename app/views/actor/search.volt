<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("actor/index", "Go Back") }}</li>
            <li class="next">{{ link_to("actor/new", "Create ") }}</li>
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
            <th>Country Of Code</th>
            <th>Actor Of Name</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for actor in page.items %}
            <tr>
                <td>{{ actor.getId() }}</td>
            <td>{{ actor.getCountryCode() }}</td>
            <td>{{ actor.getActorName() }}</td>

                <td>{{ link_to("actor/edit/"~actor.getId(), "Edit") }}</td>
                <td>{{ link_to("actor/delete/"~actor.getId(), "Delete") }}</td>
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
                <li>{{ link_to("actor/search", "First") }}</li>
                <li>{{ link_to("actor/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("actor/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("actor/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
