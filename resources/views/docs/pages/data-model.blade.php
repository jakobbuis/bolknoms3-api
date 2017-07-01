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

    @include('docs/partials/tables/properties/users')

    <h2>Registrations</h2>
    <p>
        A registration is a reservation for one person for a meal. A registration always belong to a single meal, and if that meal is deleted, the registration is deleted too. A registration can be made by a registered user, in which case it belongs to that user, but that is not required. Visitors can register for meals without having a logged-in user.
    </p>
    <p>
        Registrations can be confirmed or unconfirmed. A registration made by a user is always confirmed immediately. A registration made by a visitor that is not logged-in, is unconfirmed. If an unconfirmed registration is made, the user must click on the link in the confirmation e-mail to confirm the registration.
    </p>

    @include('docs/partials/tables/properties/registrations')

    <h2>Users</h2>
    <p>
        Members of De Bolk have a Bolkaccount with which they may register for meals. The User resource holds the Bolknoms-specific details for a user. When creating a registration for a user, the name and diet properties are copied over to the created registration.
    </p>
    <p>
        A board member can block a member from the system. A blocked member will not be able to register for any meal, though their existing registrations for upcoming and past meals are not removed. Blocks do not expire: they must be removed manually by a board member.
    </p>
    <p class="notification">
        <strong>Lore:</strong> Blocking users is a feature that only exists because <a href="https://www.facebook.com/bdiepersloot">Boedi</a> requested for himself that he never be able to eat at De Bolk again. The feature is built solely for him and his user remains blocked to this day.
    </p>

    @include('docs/partials/tables/properties/users')
@endsection
