{{ partial('partials/nav') }}

<section class="content">
    <h1>
        <span class="icon-user-plus c-green"></span>
        Add a user
    </h1>
    <form method="post">
        <div class="widget view-only">
        {{ partial('partials/flash') }}
            <div class="form-group">
                <label for="firstName" class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-10">
                    <input type="text" name="firstName" id="firstName" class="form-control" placeholder="Enter user's first name..." required="required" value="{{ data["firstName"] }}">
                </div>
            </div>
            <div class="form-group">
                <label for="lastName" class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-10">
                    <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Enter user's last name..." required="required" value="{{ data["lastName"] }}">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter user's email address..." required="required" value="{{ data["email"] }}">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter user's password..." required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="confirmPassword" class="col-sm-2 control-label">Confirm Password</label>
                <div class="col-sm-10">
                    <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Confirm user's password..." required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="role" class="col-sm-2 control-label">Role</label>
                <div class="col-sm-10">
                    <select name="role" class="form-control">
                        <option value="">Select Role</option>
                        {% for role in roles %}
                        {% if data["role"] == role.getId() %}
                        <option value="{{ role.getId() }}" selected="selected">{{ role.getName() }}</option>
                        {% else %}
                        <option value="{{ role.getId() }}">{{ role.getName() }}</option>
                        {% endif %}
                        {% endfor %}
                    </select>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <span class="icon-user-plus"></span>&nbsp;&nbsp;Add User
                </button>
            </div>
        </div>
    </form>
</section>
