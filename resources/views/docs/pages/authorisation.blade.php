@extends('docs/template')

@section('content')
    <h1>Authorisation</h1>
    <p>
        Once you are <a href="/docs/working-with-oauth">authenticated with a valid token</a>, you may execute requests
        to get information or change things in Bolknoms. The actions you are allowed to take are limited by your
        authorisation level. Your authorisation depends on both your user level and the object on which you take action.
    </p>

    <h2>User level</h2>
    <p>
        Bolknoms recognizes three separate authorisation levels:
    </p>
    <ul>
        <li><strong>board</strong> Board members and members of beheer</li>
        <li><strong>member</strong> Current and candidate members</li>
        <li><strong>none</strong> All other users</li>
    </ul>
    <p>
        Normally, your level will be "member". Your authorisation level is retrieved from the <a href="https://auth.debolk.nl">Bolklogin OAuth authorisation server</a> (and beyond that, from <a href="http://gosa.i.bolkhuis.nl">Gosa</a>), and cannot be changed in Bolknoms.
    </p>
    <p class="notification is-warning">
        <strong>Caution:</strong> Bolknoms user levels are similar to
        <a href="https://auth.debolk.nl/#check-access-level">the levels used by the Bolklogin OAuth server</a>, but are
        not completely equivalent. For example, the OAuth level "member" does not include candidate members, but Bolknoms' member-level does include them.
    </p>
    <p>
        These levels are additive: members are allowed to do anything a "none"-user will, board-members are allowed to do anything a member is, etc. None-users have very limited permissions: they may see some things, and subscribe themselves to a small subset of meals. Members can see most entities and change most resources that they own. Board members have very wide-ranging privileges: they may see and change basically anything. They are also exempt from most business rules: a board member may subscribe other users to meals, even without their permission and after the deadline has passed.
    </p>

    <h2>Object ownership</h2>
    <p>
        Apart from your level, whether you can take an action depends on the object or resource on which you are trying to take the action.
    </p>
    <p>
        For example, consider the <a href="/docs/users">/users</a> resource. This endpoint can be used to change two properties of a user: blocked and diet. Blocked is a boolean flag that enables suspension of users who abuse the system. If it's set to true, noone (including board members) will be able to register this user for a meal. Diet is a string of text that describes the users's dietary requirements.
    </p>
    <p>
        Setting or removing the blocked flag requires board-level permissions: if you are not a board member, you will never be allowed to change this field on yourself or on other users. Whether you can change the diet property, depends on who's diet you're changing: you may set your own diet at any point, but not change other people's diets. Board members can override anyone's diet at their discretion.
    </p>
    <p>
        In a similar fashion, a member can remove a registration from a meal (as long as the deadline for registration hasn't passed), but only their own registration. In other words, you can undo your own registration upto the deadline, but not those of other people. A board member can remove other people's registrations, both before and after the registration deadline.
    </p>

    <h2>Errors</h2>
    <p>
        You may encounter these authorisation errors while working with Bolknoms:
    </p>
    @include('docs/partials/tables/errors/authorisation')
@endsection
