<table>
    <thead><tr>
        <th>HTTP status</th>
        <th>Code</th>
        <th>Explanation</th>
    </tr></thead>
    <tbody>
        <tr>
            <td class=nowrap>400 Bad Request</td>
            <td class=nowrap>oauth_token_invalid</td>
            <td>Something is wrong with your token, the description will contain further details.</td>
        </tr>
        <tr>
            <td class=nowrap>401 Unauthorized</td>
            <td class=nowrap>oauth_token_expired</td>
            <td>Your token has expired. Make sure to refresh your tokens on time using the refresh token.</td>
        </tr>
        <tr>
            <td class=nowrap>401 Unauthorized</td>
            <td class=nowrap>oauth_header_missing</td>
            <td>You have not send an Authorization header.</td>
        </tr>
        <tr>
            <td class=nowrap>400 Bad Request</td>
            <td class=nowrap>oauth_header_wrong</td>
            <td>You have send an Authorization header, but its format is wrong.</td>
        </tr>
        <tr>
            <td class=nowrap>502 Bad Gateway</td>
            <td class=nowrap>oauth_authorization_server_wrong</td>
            <td>Validating your token produced an invalid response from the OAuth Authorization server.</td>
        </tr>
    </tbody>
</table>
