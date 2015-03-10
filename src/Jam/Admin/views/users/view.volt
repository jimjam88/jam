{{ partial('partials/nav') }}

<section class="content">
    <h1>
        <span class="icon-user c-pink"></span>
        {{ details.getFirstName() }} {{ details.getLastName() }}
    </h1>

    <div class="widget view-only">
        {{ partial('partials/flash') }}
        <form name="edit-user" method="post" action="/admin/users/{{ details.getId() }}/edit">
            <div class="form-group">
                <label for="firstName" class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-10">
                {% if isAdmin %}
                    <input type="text" name="firstName" id="firstName" class="form-control" value="{{ details.getFirstName() }}">
                {% else %}
                    <input type="text" id="firstName" class="form-control" value="{{ details.getFirstName() }}" disabled="disabled">
                {% endif %}
                </div>
            </div>
            <div class="form-group">
                <label for="lastName" class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-10">
                {% if isAdmin %}
                    <input type="text" id="lastName" name="lastName" class="form-control" value="{{ details.getLastName() }}">
                {% else %}
                    <input type="text" id="lastName" class="form-control" value="{{ details.getLastName() }}" disabled="disabled">
                {% endif %}
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                {% if isAdmin %}
                    <input type="email" id="email" name="email" class="form-control" value="{{ details.getEmail() }}">
                {% else %}
                    <input type="email" id="email" class="form-control" value="{{ details.getEmail() }}" disabled="disabled">
                {% endif %}
                </div>
            </div>
            <div class="form-group">
                <label for="dateAdded" class="col-sm-2 control-label">Date Added</label>
                <div class="col-sm-10">
                    <input type="text" id="dateAdded" class="form-control" value="{{ details.getDateAdded().format('l jS F Y') }}" disabled="disabled">
                </div>
            </div>
            <div class="form-group">
                <label for="lastLogin" class="col-sm-2 control-label">Last Login</label>
                <div class="col-sm-10">
                    <input type="text" id="lastLogin" class="form-control" value="{{ details.getDaysSinceLastLogin() }}" disabled="disabled">
                </div>
            </div>
            <div class="form-group">
                <label for="role" class="col-sm-2 control-label">Role</label>
                <div class="col-sm-10">
                    <select name="role" class="form-control">
                        {% for role in roles %}
                        {% if details.getRole().getId() == role.getId() %}
                        <option value="{{ role.getId() }}" selected="selected">{{ role.getName() }}</option>
                        {% else %}
                        <option value="{{ role.getId() }}">{{ role.getName() }}</option>
                        {% endif %}
                        {% endfor %}
                    </select>
                </div>
            </div>
            {% if isAdmin %}
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <span class="icon-pencil"></span>&nbsp;&nbsp;Edit User
                </button>
            </div>
        </form>
        <form name="delete-user" method="post" id="delete-user-form" action="/admin/users/{{ details.getId() }}/delete">
            <div class="form-group">
                <button type="submit" class="btn btn-danger">
                    <span class="icon-bin"></span>&nbsp;&nbsp;Delete User
                </button>
            </div>
        </form>
        {% endif %}
    </div>
</section>

<script type="text/javascript">
    $('form#delete-user-form').on('submit', function(e) {
        if (!confirm('Are you sure you want to delete this user?')) {
            e.preventDefault();
        }
    });
</script>