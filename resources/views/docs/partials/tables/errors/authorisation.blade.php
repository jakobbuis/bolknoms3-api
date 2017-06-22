<table>
    <thead><tr>
        <th>HTTP status</th>
        <th>Code</th>
        <th>Explanation</th>
    </tr></thead>
    <tbody>
        <tr>
            <td class=nowrap>403 Forbidden</td>
            <td class=nowrap>authorization_insufficient_level</td>
            <td>Your <a href="/docs/authorisation">user level</a> is not high enough to do this. For example, trying to block a user when you are not a board member will trigger this error.</td>
        </tr>
        <tr>
            <td class=nowrap>403 Forbidden</td>
            <td class=nowrap>authorization_not_owner</td>
            <td>You do not own this object. For example, attempting to unsubscribe another user from a meal or changing somebody else's diet will trigger this error.</td>
        </tr>
    </tbody>
</table>
