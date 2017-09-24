@extends('docs/template')

@section('content')
    <h1>/meals</h1>
    <p>
        Meals are the primary resource of Bolknoms. They are instances of a meal
        to which a meal or visitor may register.
    </p>

    <h2>Endpoints</h2>
    <nav>
        <ul>
            <li><a href="#get-meals">GET /meals</a> A list of all meals</li>
            <li><a href="#get-meals-today">GET /meals/today</a> A list of all meals today</li>
            <li><a href="#get-meals-available">GET /meals/available</a> A list of all meals still open for registration</li>
            <li><a href="#get-meals-upcoming">GET /meals/upcoming</a> A list of all meals that start now or later</li>
            <li><a href="#get-meals-id">GET /meals/{id}</a> Details of a single meal</li>
            <li><a href="#post-meals">POST /meals</a> Create a new meal</li>
            <li><a href="#patch-meals-id">PATCH /meals/{id}</a> Update the details of a meal</li>
            <li><a href="#delete-meals-id">DELETE /meals/{id}</a> Destroy a meal</li>
        </ul>
    </nav>

    <h2 id="get-meals">GET /meals</h2>
    <table class="table endpoint">
        <tbody>
            <tr><th>Purpose</th><td>A list of all meals</td></tr>
            <tr><th>URL</th><td>/meals</td></tr>
            <tr><th>Method</th><td>GET</td></tr>
            <tr><th>Required user level</th><td><a href="/docs/authorisation">none</a></td></tr>
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
            "id": "d00656c4-a133-11e9-9d4a-080027a8df8b",
            "meal_timestamp": "2017-09-24T18:30:00+02:00",
            "registration_close": "2017-09-24T15:00:00+02:00",
            "event": "42com-feest: LED there be light!"
        },
        {
            "id": "d006563f-a133-11e3-9d4a-080027a8df8b",
            "meal_timestamp": "2017-09-25T18:30:00+02:00",
            "registration_close": "2017-09-25T15:00:00+02:00",
            "event": null
        }
    ]
}
</pre>
                </td>
            </tr>
            <tr><th>Notes</th><td>None</td></tr>
        </tbody>
    </table>

    <h2 id="get-meals-today">GET /meals/today</h2>
    <table class="table endpoint">
        <tbody>
            <tr><th>Purpose</th><td>A list of all meals today</td></tr>
            <tr><th>URL</th><td>/meals</td></tr>
            <tr><th>Method</th><td>GET</td></tr>
            <tr><th>Required user level</th><td><a href="/docs/authorisation">none</a></td></tr>
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
                <td>See <a href="#get-meals">GET /meals</a></td>
            </tr>
            <tr><th>Notes</th><td>None</td></tr>
        </tbody>
    </table>

    <h2 id="get-meals-available">GET /meals/available</h2>
    <table class="table endpoint">
        <tbody>
            <tr><th>Purpose</th><td>A list of all meals still open for registration</td></tr>
            <tr><th>URL</th><td>/meals</td></tr>
            <tr><th>Method</th><td>GET</td></tr>
            <tr><th>Required user level</th><td><a href="/docs/authorisation">none</a></td></tr>
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
                <td>See <a href="#get-meals">GET /meals</a></td>
            </tr>
            <tr><th>Notes</th><td>None</td></tr>
        </tbody>
    </table>

    <h2 id="get-meals-upcoming">GET /meals/upcoming</h2>
    <table class="table endpoint">
        <tbody>
            <tr><th>Purpose</th><td>A list of all meals that start now or later</td></tr>
            <tr><th>URL</th><td>/meals</td></tr>
            <tr><th>Method</th><td>GET</td></tr>
            <tr><th>Required user level</th><td><a href="/docs/authorisation">none</a></td></tr>
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
                <td>See <a href="#get-meals">GET /meals</a></td>
            </tr>
            <tr><th>Notes</th><td>None</td></tr>
        </tbody>
    </table>

    <h2 id="get-meals-id">GET /meals/{id}</h2>
    <table class="table endpoint">
        <tbody>
            <tr><th>Purpose</th><td>Details of a single meal</td></tr>
            <tr><th>URL</th><td>/meals/{id}</td></tr>
            <tr><th>Method</th><td>GET</td></tr>
            <tr><th>Required user level</th><td>none</td></tr>
            <tr>
                <th>URL parameters</th>
                <td>
                    <code>id</code> Full UUID of the meal.
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
        "id": "d006563f-a133-11e3-9d4a-080027a8df8b",
        "meal_timestamp": "2017-09-25T18:30:00+02:00",
        "registration_close": "2017-09-25T15:00:00+02:00",
        "event": null
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

    <h2 id="post-meals">POST /meals</h2>
    <table class="table endpoint">
        <tbody>
            <tr><th>Purpose</th><td>Create a new meal</td></tr>
            <tr><th>URL</th><td>/meals</td></tr>
            <tr><th>Method</th><td>POST</td></tr>
            <tr><th>Required user level</th><td>Board</td></tr>
            <tr>
                <th>URL parameters</th>
                <td>None</td>
            </tr>
            <tr>
                <th>Data parameters</th>
                <td>
                    <code>meal_timestamp</code> (string) date and time of the meal, ISO-8601 formatted <br>
                    <code>registration_close</code> (string) date and time until which users may register for this meal, ISO-8601 formatted <br>
                    <code>event</code> (string) optional description of a related event.
                    Generally used as a promotional.
                </td>
            </tr>
            <tr>
                <th>Success response</th>
                <td>
<pre>
{
    "data": {
        "id": "d006563f-a133-11e3-9d4a-080027a8df8b",
        "meal_timestamp": "2017-09-25T18:30:00+02:00",
        "registration_close": "2017-09-25T15:00:00+02:00",
        "event": null
    }
}
</pre>
                </td>
            </tr>
            <tr>
                <th>Notes</th>
                <td>None</td>
            </tr>
        </tbody>
    </table>

    <h2 id="patch-meals-id">PATCH /meals/{id}</h2>
    <table class="table endpoint">
        <tbody>
            <tr><th>Purpose</th><td>Update the details of a meal</td></tr>
            <tr><th>URL</th><td>/meals/{id}</td></tr>
            <tr><th>Method</th><td>PATCH</td></tr>
            <tr><th>Required user level</th><td>Board</td></tr>
            <tr>
                <th>URL parameters</th>
                <td>
                    <code>id</code> Full UUID of the meal
                </td>
            </tr>
            <tr>
                <th>Data parameters</th>
                <td>
                    <code>meal_timestamp</code> (string) date and time of the meal, ISO-8601 formatted <br>
                    <code>registration_close</code> (string) date and time until which users may register for this meal, ISO-8601 formatted <br>
                    <code>event</code> (string) optional description of a related event.
                    Generally used as a promotional.
                </td>
            </tr>
            <tr>
                <th>Success response</th>
                <td>
<pre>
{
    "data": {
        "id": "d006563f-a133-11e3-9d4a-080027a8df8b",
        "meal_timestamp": "2017-09-25T18:30:00+02:00",
        "registration_close": "2017-09-25T15:00:00+02:00",
        "event": null
    }
}
</pre>
                </td>
            </tr>
            <tr>
                <th>Notes</th>
                <td>
                    This endpoint returns the complete meal details upon completion.
                    You should replace any local state with these new details. <br><br>
                    This is a PATCH request: fields that are not set in the request,
                    will be left as-is. You can (and should) send partial data sets
                    to make partial updates.
                </td>
            </tr>
        </tbody>
    </table>

    <h2 id="delete-meals-id">DELETE /meals/{id}</h2>
    <table class="table endpoint">
        <tbody>
            <tr><th>Purpose</th><td>Destroy a meal</td></tr>
            <tr><th>URL</th><td>/meals/{id}</td></tr>
            <tr><th>Method</th><td>DELETE</td></tr>
            <tr><th>Required user level</th><td>Board</td></tr>
            <tr>
                <th>URL parameters</th>
                <td>
                    <code>id</code> Full UUID of the meal
                </td>
            </tr>
            <tr>
                <th>Data parameters</th>
                <td>None</td>
            </tr>
            <tr>
                <th>Success response</th>
                <td>This endpoint returns <code>204 No Content</code> on success.</td>
            </tr>
            <tr>
                <th>Notes</th>
                <td>None</td>
            </tr>
        </tbody>
    </table>

@endsection
