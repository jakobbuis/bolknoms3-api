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
