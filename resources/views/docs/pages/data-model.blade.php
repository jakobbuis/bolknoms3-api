@extends('docs/template')

@section('content')
    <h1>Data model</h1>
    <p>
        The basic data model for Bolknoms is quite simple and consists of three main entities: meals, users and registrations. These entities and their relationships are clarified in the following schema:
    </p>

    <img src="/images/datamodel.png" alt="" width=686 height=422>

    <h2>Meals</h2>
    <p>
        Meals are the backbone of Bolknoms: an instance of a meal represents a meal on a specific date and time. There can be more than one meal on a day, though this is rare. A meal can have many registrations, but it could have none.
    </p>

    <table class=table>
        <thead><tr>
            <th>Property</th>
            <th>Data type</th>
            <th>Purpose</th>
        </tr></thead>
        <tbody>
            <tr>
                <td>id</td>
                <td>UUID (<a href="https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_.28random.29">v4</a>)</td>
                <td>Unique identifier for this meal</td>
            </tr>
            <tr>
                <td>event</td>
                <td>String</td>
                <td>An optional, short description of the event on the evening of this meal</td>
            </tr>
            <tr>
                <td>meal_timestamp</td>
                <td>Date (<a href="https://en.wikipedia.org/wiki/ISO_8601">ISO 8601</a>)</td>
                <td>The date and time (and timezone) when this meal takes place</td>
            </tr>
            <tr>
                <td>registration_close</td>
                <td>Date (<a href="https://en.wikipedia.org/wiki/ISO_8601">ISO 8601</a>)</td>
                <td>The date and time (and timezone) of the deadline for registering for this meal</td>
            </tr>
        </tbody>
    </table>

    <h2>Registrations</h2>
    <p>
        A registration is a reservation for one person for a meal. A registration always belong to a single meal, and if that meal is deleted, the registration is deleted too. A registration can be made by a registered user, in which case it belongs to that user, but that is not required. Visitors can register for meals without having a logged-in user.
    </p>
    <p>
        Registrations can be confirmed or unconfirmed. A registration made by a user is always confirmed immediately. A registration made by a visitor that is not logged-in, is unconfirmed. If an unconfirmed registration is made, the user must click on the link in the confirmation e-mail to confirm the registration.
    </p>

    <table class=table>
        <thead><tr>
            <th>Property</th>
            <th>Data type</th>
            <th>Purpose</th>
        </tr></thead>
        <tbody>
            <tr>
                <td>id</td>
                <td>UUID (<a href="https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_.28random.29">v4</a>)</td>
                <td>Unique identifier for this registration</td>
            </tr>
            <tr>
                <td>name</td>
                <td>String</td>
                <td>Name given when making the registration</td>
            </tr>
            <tr>
                <td>diet</td>
                <td>String</td>
                <td>dietary requirements</td>
            </tr>
            <tr>
                <td>confirmed</td>
                <td>Boolean</td>
                <td>Whether the registration is fully confirmed</td>
            </tr>
        </tbody>
    </table>

    <h2>Users</h2>
    <p>
        Members of De Bolk have a Bolkaccount with which they may register for meals. The User resource holds the Bolknoms-specific details for a user. When creating a registration for a user, the name and diet properties are copied over to the created registration.
    </p>

    <table class=table>
        <thead><tr>
            <th>Property</th>
            <th>Data type</th>
            <th>Purpose</th>
        </tr></thead>
        <tbody>
            <tr>
                <td>id</td>
                <td>UUID (<a href="https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_.28random.29">v4</a>)</td>
                <td>Unique identifier for this registration</td>
            </tr>
            <tr>
                <td>username</td>
                <td>String</td>
                <td>Bolkaccount username</td>
            </tr>
            <tr>
                <td>diet</td>
                <td>String</td>
                <td>dietary requirements</td>
            </tr>
            <tr>
                <td>name</td>
                <td>String</td>
                <td>Full name (first + last) of the Bolkaccount</td>
            </tr>
            <tr>
                <td>blocked</td>
                <td>Boolean</td>
                <td>Whether the user has been blocked from registration</td>
            </tr>
        </tbody>
    </table>
@endsection
