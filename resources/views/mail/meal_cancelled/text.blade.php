Beste {{ $registration->name }},

Je hebt je aangemeld op Bolknoms ({{ url('/') }}) voor de maaltijd van {{ $meal->mealDate }}. Helaas kan de maaltijd niet doorgaan. Je aanmelding is automatisch verwijderd.

@include('mail/_partials/signature/text')
