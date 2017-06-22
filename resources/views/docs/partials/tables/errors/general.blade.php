<table>
    <thead><tr>
        <th>HTTP status</th>
        <th>Code</th>
        <th>Explanation</th>
    </tr></thead>
    <tbody>
        <tr>
            <td class=nowrap>404 Not Found</td>
            <td class=nowrap>resource_nonexistent</td>
            <td>You are trying to request a resource that does not exist.</td>
        </tr>
        <tr>
            <td class=nowrap>410 Gone</td>
            <td class=nowrap>resource_deleted</td>
            <td>This resource used to exist, but it has since been destroyed. This is permanent: you should destroy all local data of the object.</td>
        </tr>
        <tr>
            <td class=nowrap>500 Internal Server Error</td>
            <td class=nowrap>internal_server_error</td>
            <td>Something went wrong and we do not know what exactly. Contact support and relay details.</td>
        </tr>
    </tbody>
</table>
