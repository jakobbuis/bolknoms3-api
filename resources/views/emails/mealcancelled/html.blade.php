<html>
<body>
    <p>
        Beste {{ $registration->name }},
    </p>
    <p>
        Je hebt je aangemeld op <a href="{{ url('/') }}">Bolknoms</a> voor de maaltijd van {{ $meal->meal_timestamp->formatLocalized('%A %d %B %Y') }}. Helaas kan de maaltijd niet doorgaan. Je aanmelding is automatisch verwijderd.
    </p>
    <p>
        <small>
            Met vriendelijke groet,<br>
            Commissaris Maaltijden <br>
            De Bolk (D.S.V. "Nieuwe Delft") <br>
            E-mail: <a href="mailto:maaltijdcom@nieuwedelft.nl">maaltijdcom@nieuwedelft.nl</a> <br>
            Telefoon: <a href="tel:+31152126012">+31 15 212 6012</a>
        </small>
    </p>
</body>
</html>
