<table>
    <thead><tr>
        <th>HTTP status</th>
        <th>Code</th>
        <th>Explanation</th>
    </tr></thead>
    <tbody>
        <tr>
            <td class=nowrap>400 Bad request</td>
            <td class=nowrap>relationship_mismatch</td>
            <td>You've sent a meal ID combined with a registration ID that
            do not match. Both exist, but this registration is for a different meal.
            The error message will include the correct meal ID.</td>
        </tr>
        <tr>
            <td class=nowrap>500 Internal server error</td>
            <td class=nowrap>user_missing</td>
            <td>You have a valid token, but your user account does not exist anywhere
            in Bolknoms. This is an internal error: contact support.</td>
        </tr>
    </tbody>
</table>
