@extends('docs/template')

@section('content')
    <h1>E-mails</h1>

    <p>
        A number of changes you can make in Bolknoms, will result in e-mails being sent. These are mostly notifications to prior registrations that a meal has meaningfully changed and that they should be aware of the change. In most cases, the actions that result in these e-mails require board-level permission to initiate.
    </p>

    <p>
        In most circumstances, these e-mails are not your concern. There is no way to prevent these e-mails from being sent, and no way to change their content. The documentation here is primarily for your understanding of Bolknoms internal behaviour.
    </p>

    <p>
        E-mails are sent from:
    </p>
    <p>
        <pre>{{ env('MAIL_FROM_NAME') }} &lt;{{ env('MAIL_FROM_ADDRESS') }}&gt;</pre>
    </p>

    <h2>List of e-mails</h2>
    <table class="table is-striped is-narrow">
        <thead><tr>
            <th>E-mail</th>
            <th>Content example</th>
        </tr></thead>
        <tbody>
            <tr>
                <td>MealCancelled</td>
                <td>Je hebt je aangemeld op Bolknoms voor de maaltijd van {datum}. Helaas kan de maaltijd niet doorgaan. Je aanmelding is automatisch verwijderd.</td>
            </tr>
            <tr>
                <td>MealTimeChanged</td>
                <td>Je hebt je aangemeld op Bolknoms voor de maaltijd van {datum}. Het tijdstip van deze maaltijd is veranderd: de maaltijd begint nu om {tijd} uur.</td>
            </tr>
        </tbody>
    </table>
@endsection
