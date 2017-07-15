@extends('docs/template')

@section('content')
    <h1>Errors</h1>

    <p>
        If Bolknoms is broken or you make a mistake, Bolknoms will throw an error at you. Errors are <strong>always</strong> returned with a HTTP status code of 400 or greater. If a response returns a 200, 204, etc. status code, you can rely on Bolknoms to have processed your request succesfully. Errors are always formatted as follows:
    </p>
    <p>
<pre>
    {
        "errors": [
            {
                "code": "oauth_token_expired",
                "description": "Your token has expired",
                "href": "https://api.noms.debolk.nl/docs/errors#oauth_token_expired"
            }
        ]
    }
</pre>
    </p>
    <p>
        If you want to generate a friendly message, rely on the <code>code</code> parameter. This parameter will not change between instances of the same problem. The <code>description</code> field will return a description of your problem, which we attempt to make as clear as possible. You may show this string to your end-users, though it could be too technical depending on your use case. The <code>href</code> fields redirects to the error code in this documentation.
    </p>
    <p class="notification is-warning">
        <strong>Caution:</strong> note that for a given <code>code</code> field, multiple descriptions can be returned. There is no guarantee that a specific code will always have that particular description.
    </p>

    <h2>List of error codes</h2>
    <p>
        This is the complete list of all errors that Bolknoms may return. The first part of a <code>code</code> generally indicates that area in which the error occurred: the list has been divided into sections based on these areas.
    </p>

    <h3>OAuth (authentication errors)</h3>
    @include('docs/partials/tables/errors/oauth')

    <h3>Authorisation errors</h3>
    @include('docs/partials/tables/errors/authorisation')

    <h3>Resource-specific errors</h3>
    @include('docs/partials/tables/errors/resource')

    <h3>General errors</h3>
    @include('docs/partials/tables/errors/general')

@endsection
