<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("branchoffice/index", "Go Back") }}</li>
            <li class="next">{{ link_to("branchoffice/new", "Create ") }}</li>
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
            <th>Branchoffice Of Name</th>
            <th>Branchoffice Of Phone</th>
            <th>Branchoffice Of Address</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for branchoffice in page.items %}
            <tr>
                <td>{{ branchoffice.getId() }}</td>
            <td>{{ branchoffice.getBranchofficeName() }}</td>
            <td>{{ branchoffice.getBranchofficePhone() }}</td>
            <td>{{ branchoffice.getBranchofficeAddress() }}</td>

                <td>{{ link_to("branchoffice/edit/"~branchoffice.getId(), "Edit") }}</td>
                <td>{{ link_to("branchoffice/delete/"~branchoffice.getId(), "Delete") }}</td>
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
                <li>{{ link_to("branchoffice/search", "First") }}</li>
                <li>{{ link_to("branchoffice/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("branchoffice/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("branchoffice/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
