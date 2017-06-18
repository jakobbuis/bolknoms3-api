<html>
<body>
    <p>
        Beste {{ $registration->name }},
    </p>
    <p>
        Je hebt je aangemeld op <a href="{{ url('/') }}">Bolknoms</a> voor de maaltijd van {{ $meal->mealDate }}. Helaas kan de maaltijd niet doorgaan. Je aanmelding is automatisch verwijderd.
    </p>
    @include('meal/_partials/signature/html')
</body>
</html>
