<div class="menu-overlay"></div>

<nav class="topbar visible-xs visible-sm">
    <span class="icon-menu" id="menu-button"></span>

    <script type="text/javascript">
        var menuOpen = false;

        $('#menu-button, .menu-overlay').click(function() {

            var $menu = $('nav#sidebar-nav');

            if (menuOpen) {
                $menu.removeClass('open');
                document.documentElement.className = '';
            } else {
                $menu.addClass('open');
                document.documentElement.className = 'menu-fade';
            }

            menuOpen = !menuOpen;
        });

    </script>
</nav>

<nav class="sidebar" id="sidebar-nav">
    <h3><img src="/img/logo_75.png" alt="JAM"></h3>
    <ul>
        <li>
            <a href="/admin/pages">Pages</a>
            <span class="icon-earth"></span>
        </li>
        <li>
            <a href="/admin/blog">Blog</a>
            <span class="icon-book"></span>
        </li>
        <li>
            <a href="/admin/users">Users</a>
            <span class="icon-users"></span>
        </li>
        <li>
            <a href="/admin/profile/{{ sessionUser.getId() }}">Your Profile</a>
            <span class="icon-user"></span>
        </li>
        {# ADMIN #}
        {% if isAdmin %}
        <li>
            <a href="/admin/settings">Settings</a>
            <span class="icon-wrench"></span>
        </li>
        <li>
            <a href="/admin/api">API</a>
            <span class="icon-database"></span>
        </li>
        {% endif %}
        <li>
            <a href="/admin/logout" class="logout">Logout</a>
            <span class="icon-lock"></span>
        </li>
    </ul>
</nav>
