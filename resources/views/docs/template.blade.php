<!doctype html>
<html>
<head>
    <title>Bolknoms 3 API Documentation</title>

    <link rel="stylesheet" href="/css/docs.css">
</head>

<body>
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-vcentered">
                    <div class="column">
                        <p class="title">
                            Bolknoms 3 API Documentation
                        </p>
                        <p class="subtitle">
                            Everything you need to build your own client for Bolknoms
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="columns">
            <aside class="column is-3">
                <nav class="menu">
                    <ul class="menu-list">
                        <li><a href="/docs/introduction">Introduction</a></li>
                        <li><a href="/docs/working-with-oauth">Working with OAuth</a></li>
                        <li><a href="/docs/authorisation">Authorisation</a></li>
                        <li><a href="/docs/emails">E-mails</a></li>
                    </ul>

                    <p class="menu-label">
                        Reference
                    </p>
                    <ul class="menu-list">
                        <li><a href="/docs/meals">Meals</a></li>
                        <li><a href="/docs/registrations">Registrations</a></li>
                        <li><a href="/docs/users">Users</a></li>
                    </ul>

                    <p class="menu-label">
                        Examples
                    </p>
                    <ul class="menu-list">
                        <li><a href="/docs/see-all-open-meals">See all open meals</a></li>
                        <li><a href="/docs/get-the-next-meal">Get the next meal</a></li>
                        <li><a href="/docs/register-for-a-meal">Register for a meal</a></li>
                    </ul>
                </nav>
            </aside>

            <main class="column is-9">
                <section class="section">
                    @yield('content')
                </section>
            </main>
        </div>
    </div>
</body>
</html>
