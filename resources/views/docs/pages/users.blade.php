@extends('docs/template')

@section('content')
    <h1>/users</h1>
    <p>
        This resources has the information and actions to work with users in Bolknoms.
        Users are the local data in Bolknoms, related to a Bolkaccount. User details
        cannot be changed in Bolknoms, save for a few specific fields. New users
        cannot be created, they are created automatically based off a Bolkaccount
        when the Bolker uses Bolknoms for the very first time.
    </p>

    <h2>Endpoints</h2>
    <nav>
        <ul>
            <li><a href="#get-users">GET /users</a> A list of all users</li>
            <li><a href="#get-users-blocked">GET /users/blocked</a> A list of blocked users</li>
            <li><a href="#get-users-id">GET /users/{id}</a> Details of a single user</li>
            <li><a href="#patch-users-id">PATCH /users/{id}</a> Update the details of a user</li>
        </ul>
    </nav>

    <h2 id="get-users">GET /users</h2>
    <table class="table endpoint">
        <tbody>
            <tr><th>Purpose</th><td>A list of all users</td></tr>
            <tr><th>URL</th><td>/users</td></tr>
            <tr><th>Method</th><td>GET</td></tr>
            <tr><th>Required user level</th><td><a href="/docs/authorisation">member</a></td></tr>
            <tr>
                <th>URL parameters</th>
                <td>
                    This endpoints supports
                    <a href="/docs/communication#including-relationships">includes</a>
                    for registrations by appending <code>?include=registrations</code>
                </td>
            </tr>
            <tr><th>Data parameters</th><td>None</td></tr>
            <tr>
                <th>Success response</th>
                <td>
<pre>
{
    "data": [
        {
            "id": "3cb07169-4903-11e7-9c66-08002732ed09",
            "username": "peter",
            "diet": null,
            "name": "Peter Dummy",
            "blocked": 0
        },
        {
            "id": "3cb07211-4902-11e7-9c66-08002732ed09",
            "username": "hans",
            "diet": "veganistisch",
            "name": "Hans de Klerck",
            "blocked": 1
        }
    ]
}
</pre>
                </td>
            </tr>
            <tr><th>Notes</th><td>None</td></tr>
        </tbody>
    </table>

    <h2 id="get-users-blocked">GET /users/blocked</h2>
    <table class="table endpoint">
        <tbody>
            <tr><th>Purpose</th><td>A list of all blocked users</td></tr>
            <tr><th>URL</th><td>/users/blocked</td></tr>
            <tr><th>Method</th><td>GET</td></tr>
            <tr><th>Required user level</th><td><a href="/docs/authorisation">member</a></td></tr>
            <tr>
                <th>URL parameters</th>
                <td>
                    This endpoints supports
                    <a href="/docs/communication#including-relationships">includes</a>
                    for registrations by appending <code>?include=registrations</code>
                </td>
            </tr>
            <tr><th>Data parameters</th><td>None</td></tr>
            <tr>
                <th>Success response</th>
                <td>
<pre>
{
    "data": [
        {
            "id": "3cb07211-4902-11e7-9c66-08002732ed09",
            "username": "hans",
            "diet": "veganistisch",
            "name": "Hans de Klerck",
            "blocked": 1
        }
    ]
}
</pre>
                </td>
            </tr>
            <tr><th>Notes</th><td>None</td></tr>
        </tbody>
    </table>

    <h2 id="get-users-id">GET /users/{id}</h2>
    <table class="table endpoint">
        <tbody>
            <tr><th>Purpose</th><td>Details of a single user</td></tr>
            <tr><th>URL</th><td>/users/{id}</td></tr>
            <tr><th>Method</th><td>GET</td></tr>
            <tr><th>Required user level</th><td>member</td></tr>
            <tr>
                <th>URL parameters</th>
                <td>
                    <code>id</code> Full UUID of the user. You may also send
                    <code>me</code> as a parameter, i.e. <code>/users/me</code>
                    to refer to the currently logged-in user.
                </td>
            </tr>
            <tr>
                <th>Data parameters</th><td>None</td>
            </tr>
            <tr>
                <th>Success response</th>
                <td>
<pre>
{
    "data": {
        "id": "3cb07169-4901-11e7-9c66-08002732ed09",
        "username": "peter",
        "diet": null,
        "name": "Peter Dummy",
        "blocked": 1
    }
}
</pre>
                </td>
            </tr>
            <tr>
                <th>Notes</th><td>None</td>
            </tr>
        </tbody>
    </table>

    <h2 id="patch-users-id">PATCH /users/{id}</h2>
    <table class="table endpoint">
        <tbody>
            <tr><th>Purpose</th><td>Update the details of a user</td></tr>
            <tr><th>URL</th><td>/users/{id}</td></tr>
            <tr><th>Method</th><td>PATCH</td></tr>
            <tr><th>Required user level</th><td>Member or board. Members may edit
            themselves, board members may edit any user. Only board members may change the
            <code>blocked</code> field.</td></tr>
            <tr>
                <th>URL parameters</th>
                <td>
                    <code>id</code> Full UUID of the user. You may also send
                    <code>me</code> as a parameter, i.e. <code>/users/me</code>
                    to refer to the currently logged-in user.
                </td>
            </tr>
            <tr>
                <th>Data parameters</th>
                <td>
                    <code>diet</code> (string) dietary requirements of the user <br>
                    <code>blocked</code> (boolean) true if the user is blocked
                </td>
            </tr>
            <tr>
                <th>Success response</th>
                <td>
<pre>
{
    "data": {
        "id": "3cb07169-4901-11e7-9c66-08002732ed09",
        "username": "peter",
        "diet": null,
        "name": "Peter Dummy",
        "blocked": 1
    }
}
</pre>
                </td>
            </tr>
            <tr>
                <th>Notes</th>
                <td>
                    This endpoint returns the complete user details upon completion.
                    You should replace any local state with these new details. <br><br>
                    This is a PATCH request: fields that are not set in the request,
                    will be left as-is. You can (and should) send partial data sets
                    to make partial updates.
                </td>
            </tr>
        </tbody>
    </table>

@endsection
