<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("rent/index", "Go Back") }}</li>
            <li class="next">{{ link_to("rent/new", "Create ") }}</li>
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
        {% if page.items is defined %}
        {% for rent in page.items %}
            <tr>
                <td>{{ rent.rentId }}</td>
            <td>{{ rent.branchofficeName }}</td>
            <td>{{ rent.clientName }}</td>
            <td>{{ rent.movieName }}</td>
            <td>{{ rent.starDate }}</td>
            <td>{{ rent.returnDate }}</td>
            <td>{{ rent.value }}</td>
            <td>{{ rent.amount }}</td>

                <td>{{ link_to("rent/edit/"~rent.rentId, "Edit") }}</td>
                <td>{#{ link_to("rent/delete/"~rent.rentId, "Delete") }#}<a onclick="remove({{ rent.rentId}})" style="cursor : pointer;">Delete</a></td>
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
                <li>{{ link_to("rent/search", "First") }}</li>
                <li>{{ link_to("rent/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("rent/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("rent/search?page="~page.last, "Last") }}</li>
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
