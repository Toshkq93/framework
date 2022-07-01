<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">{$config->get('app.name')}</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{get_route name='home'}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Dashboard</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            {auth}
                <li class="nav-item">
                    <a class="nav-link" href="#">{$auth->user()->first_name}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"
                       onclick="event.preventDefault(); document.getElementById('logout').submit();">Sign out</a>
                </li>
            {/auth}
            {guest}
                <li class="nav-item">
                    <a class="nav-link" href="{get_route name='auth.login'}">Sign in</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{get_route name='auth.register'}">Create an account</a>
                </li>
            {/guest}
        </ul>
    </div>
</nav>

<form action="" method="POST" style="display: none;" id="logout">
    <input type="hidden" name="" value="">
</form>
