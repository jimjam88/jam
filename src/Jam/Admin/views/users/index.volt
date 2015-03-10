{{ partial('partials/nav') }}

<section class="content">
    <h1>
        <span class="icon-users c-blue"></span>
        Users
    </h1>
    {{ partial('partials/flash') }}
    <!-- Users table -->
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th class="hidden-xs">Email</th>
                <th class="hidden-xs">Login Count</th>
                <th>Role</th>
                <th class="actions">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        {% for key, user in users %}
            <tr>
                <td>{{ user["firstName"] }} {{ user["lastName"] }}</td>
                <td class="hidden-xs">{{ user["email"] }}</td>
                <td class="hidden-xs">{{ user["loginCount"] }}</td>
                <td>{{ user["role"]["name"] }}</td>
                <td class="actions">
                    <a class="btn btn-success" href="/admin/users/{{ user["id"] }}">
                        <span class="icon-search"></span>
                    </a>
                </td>
            </tr>
        {% endfor %}
        </tbody>
    </table>

    {% if isAdmin %}
    <!-- Add user button -->
    <a href="/admin/users/add" class="btn btn-success add-user-button"><span class="icon-user-plus"></span> Add a user</a>
    {% endif %}

</section>
