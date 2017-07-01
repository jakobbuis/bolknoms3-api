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
            <nav class="column is-3 menu">
                <p class="menu-label">
                    Getting started
                </p>
                <ul class="menu-list">
                    @include('docs/partials/menu', ['path' => 'docs/introduction', 'title' => 'Introduction'])
                    @include('docs/partials/menu', ['path' => 'docs/communication', 'title' => 'Communication'])
                    @include('docs/partials/menu', ['path' => 'docs/working-with-oauth', 'title' => 'Working with OAuth'])
                    @include('docs/partials/menu', ['path' => 'docs/authorisation', 'title' => 'Authorisation'])
                    @include('docs/partials/menu', ['path' => 'docs/emails', 'title' => 'E-mails'])
                    @include('docs/partials/menu', ['path' => 'docs/data-model', 'title' => 'Data model'])
                </ul>

                <p class="menu-label">
                    Reference
                </p>
                <ul class="menu-list">
                    @include('docs/partials/menu', ['path' => 'docs/meals', 'title' => 'Meals'])
                    @include('docs/partials/menu', ['path' => 'docs/registrations', 'title' => 'Registrations'])
                    @include('docs/partials/menu', ['path' => 'docs/users', 'title' => 'Users'])
                    @include('docs/partials/menu', ['path' => 'docs/errors', 'title' => 'Errors'])
                </ul>

                <p class="menu-label">
                    Examples
                </p>
                <ul class="menu-list">
                    @include('docs/partials/menu', ['path' => 'docs/see-all-open-meals', 'title' => 'See all open meals'])
                    @include('docs/partials/menu', ['path' => 'docs/get-the-next-meal', 'title' => 'Get the next meal'])
                    @include('docs/partials/menu', ['path' => 'docs/register-for-a-meal', 'title' => 'Register for a meal'])
                </ul>
            </nav>

            <main class="column is-9">
                <section class="section content">
                    @yield('content')
                </section>
            </main>
        </div>
    </div>
</body>
</html>
