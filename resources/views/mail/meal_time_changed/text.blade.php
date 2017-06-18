Beste {{ $registration->name }},

Je hebt je aangemeld op <a href="{{ url('/') }}">Bolknoms</a> voor de maaltijd van {{ $meal->meal_timestamp->formatLocalized('%A %d %B %Y') }}. Het tijdstip van deze maaltijd is veranderd: de maaltijd begint nu om {{ $meal->meal_timestamp->format('H:i') }} uur.

@include('mail/_partials/signature/text')
