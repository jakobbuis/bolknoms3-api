@extends('docs/template')

@section('content')
    <h1>Communication</h1>
    <p>
        The Bolknoms 3 API is a HTTP JSON REST API.
    </p>

    <h2>JSON</h2>
    <p>
        The Bolknoms API accepts and returns only JSON. You should send all requests with an <code>Accept: application/json</code> header and a <code>Content-Type: application/json</code> header. Responses are compressed and not formatted for human readability.
    </p>

    <h2>REST</h2>
    <p>
        This is a proper REST API and supports <a href="https://en.wikipedia.org/wiki/HATEOAS">HATEOAS</a>. You should never generate URLs to resources yourself. Use the urls provided in the <code>links</code> property on every response.
    </p>

    <h2>Including relationships</h2>
    <p>
        All endpoints support an <code>include</code> query parameter. You can use this parameter to include related resources into the response. This makes certain scenarios more efficient as you require less HTTP requests to populate a view.
    </p>
    <p class="notification is-warning">
        <strong>Caution: </strong> you should not construct these URLs manually, use the URLs included in the <code>links</code> property in the response.
    </p>
    <p>
        For example, when requesting the data for a meal, you can includes its registrations by adding a <code>?include=registrations</code> query parameter. A request to <code>https://api.noms.debolk.nl/meals/3cade410-4902-11e7-9c66-08002732ed04?include=registrations</code> will result in the following response:
    </p>
<pre>
{
    "data": {
        "id": "3cade410-4902-11e7-9c66-08002732ed04",
        "meal_timestamp": "2017-11-03T18:30:00+01:00",
        "registration_close": "2017-11-03T15:00:00+01:00",
        "event": "testevent",
        "registrations": {
            "data": [
                {
                    "id": "3cb50c6a-4902-11e7-9c66-08002732ed04",
                    "name": "Peter Dummy",
                    "diet": null,
                    "confirmed": 1
                },
                {
                    "id": "3cb4f712-4902-11e7-9c66-08002732ed04",
                    "name": "Hans Talmon",
                    "diet": "vegetariër",
                    "confirmed": 0
                }
            ]
        }
    }
}
</pre>

@endsection
