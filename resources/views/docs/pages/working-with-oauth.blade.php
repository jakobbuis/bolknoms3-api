@extends('docs/template')

@section('content')
    <h1>Working with OAuth</h1>

    <p>
        Some actions in Bolknoms are available without a Bolkaccount. For example, you can see what the next meal is and subscribe to it by simply sending your details. Most other actions require that you are logged in to your Bolkaccount. If you want to take full advantage from the benefits of having an account, such as having your name up on the top eaters list every year, you'll need to use the Bolknoms API with your Bolkaccount.
    </p>

    <p>
        Unfortunately, the process of gaining access in a safe and secure way is somewhat involved. Luckily, there are resources available to help you.
    </p>

    <h2>Learning OAuth2</h2>
    <p>

    </p>

    <h2>Logging into your account</h2>
    <p>
        Bolknoms requires that you send a valid access token on all requests that require minimum <a href="/docs/authorisation">authorisation level</a>. That token must be send as the "Authorization" HTTP header in the following format:
    </p>
    <p>
        <pre>Authorization: Token b93fe28f2f60c8c69757ef0733f6bc8e046b0ade</pre>
    </p>
    <p>
        Failure to send a valid token will result in <a href="/docs/errors">an error response</a>. You may encounter any of these errors:
    </p>

    @include('docs/partials/tables/errors/oauth')

@endsection
