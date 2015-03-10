{{ partial('partials/nav') }}

<section class="content">
    <h1>
        <span class="icon-user c-pink"></span>
        Your Profile
    </h1>
    {{ partial('partials/flash') }}

    <form method="post" action="/admin/profile/{{ user.getId() }}">
        <div class="widget view-only">
            <h3>
                <span class="icon-user"></span>
                Update your details
            </h3>
            <hr>
            <div class="form-group">
                <label for="firstName" class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-10">
                    <input type="text" name="firstName" id="firstName" class="form-control" placeholder="Enter user's first name..." required="required" value="{{ user.getFirstName() }}">
                </div>
            </div>
            <div class="form-group">
                <label for="lastName" class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-10">
                    <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Enter user's last name..." required="required" value="{{ user.getLastName() }}">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter user's email address..." required="required" value="{{ user.getEmail() }}">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <span class="icon-pencil"></span>&nbsp;&nbsp;Update Details
                </button>
            </div>
        </div>
    </form>
    <form method="post" action="/admin/change-password/{{ user.getId() }}">
        <div class="widget view-only">
            <h3>
                <span class="icon-lock"></span>
                Change your password
            </h3>
            <hr>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Current Password</label>
                <div class="col-sm-10">
                    <input type="password" name="oldPassword" id="password" class="form-control" placeholder="Enter your current password..." required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">New Password</label>
                <div class="col-sm-10">
                    <input type="password" name="newPassword" id="password" class="form-control" placeholder="Enter your new password..." required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="confirmPassword" class="col-sm-2 control-label">Confirm Password</label>
                <div class="col-sm-10">
                    <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Confirm your new password..." required="required">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <span class="icon-lock"></span>&nbsp;&nbsp;Change Password
                </button>
            </div>
        </div>
    </form>
</section>