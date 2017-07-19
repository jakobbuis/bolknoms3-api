@extends('docs/template')

@section('content')
    <h1>/rules</h1>
    <p>
        Rules is a utility endpoint. It returns a nested array of the current
        business logic in human-readable form. You should use this endpoint in
        your application to clarify the rules that end-users are subject to in
        Bolknoms.
        While you could hardcode the rules in your application, the rules may
        change significantly and without prior warning; in which case your
        application will need to be updated.
    </p>
    <p>
        Rules are returned as plain text in Dutch, without any formatting.
    </p>
    <p>
        The rules are divided into sections, each with an appropriate title. You
        are encouraged to display the rules with those titles as section headings.
        This will help your users to understand the rules. If you have very little
        space available, you may opt to show the rules as a flat list instead.
    </p>
    <div class="notification is-warning">
        <p>
            <strong>Caution: </strong> you are strongly encouraged, but not required
            to display the rules in a clear location in your client.
        </p>
        <p>
            <em>If you display the rules, you must display all rules as given.</em>
            You may not add to, change, or shorten the response.
            You must make a clear distinction between the Bolknoms rules and any
            other rules that may apply to the usage of your application.
            Failure to do so will result in the immediate termination of your
            client credentials, which will prevent your application from accessing
            the API.
        </p>

    </div>

    <h2>Endpoints</h2>
    <nav>
        <ul>
            <li><a href="#get-rules">GET /rules</a> The current business rules</li>
        </ul>
    </nav>

    <h2 id="get-rules">GET /rules</h2>
    <table class="table endpoint">
        <tbody>
            <tr><th>Purpose</th><td>The current rules as applied to end-users</td></tr>
            <tr><th>URL</th><td>/rules</td></tr>
            <tr><th>Method</th><td>GET</td></tr>
            <tr><th>Required user level</th><td>public</td></tr>
            <tr>
                <th>URL parameters</th><td>None</td>
            </tr>
            <tr><th>Data parameters</th><td>None</td></tr>
            <tr>
                <th>Success response</th>
                <td>
<pre>
{
    "data": [
        {
            "title": "Aanmelden",
            "rules": [
                "Je kunt niet mee-eten zonder je aan te melden."
            ]
        },
        {
            "title": "Betalen",
            "rules": [
                "Je betaalt de maaltijd met een bonnetje. Die kun je kopen in de sociëteit.",
                "Iedereen die mee-eet betaalt 10 euro aan Jakob Buis."
            ]
        }
    ]
}
</pre>
                </td>
            </tr>
            <tr><th>Notes</th><td>None</td></tr>
        </tbody>
    </table>
@endsection
