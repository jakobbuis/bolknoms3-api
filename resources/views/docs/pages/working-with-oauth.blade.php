@extends('docs/template')

@section('content')
    <h1>Working with OAuth</h1>

    <p>
        Some actions in Bolknoms are available without a Bolkaccount. For example, you can see what the next meal is and subscribe to it by simply sending your details. Most other actions require that you are logged in to your Bolkaccount. If you want to take full advantage from the benefits of having an account, such as having your name up on the top eaters list every year, you'll need to use the Bolknoms API with your Bolkaccount.
    </p>

    <p>
        Unfortunately, the process of gaining access in a safe and secure way is somewhat involved. Luckily, there are resources available to help you.
    </p>

    <h2>Learning OAuth2</h2>
    <p>
        OAuth2 is a protocol by which an <em>end user</em> may grant access to a <em>client</em> to use or change a <em>resource</em> on his or her behalf. You have probably used OAuth2 to login to common services: everytime you click a button on the web that says "Login with Google" or "Login with Facebook", you are using OAuth2. Every Bolkaccount can use OAuth2 too: essentially a big button that says "Login with your Bolkaccount here". If you want build a client for Bolknoms which can be used by other members, you will need to implement OAuth2.
    </p>
    <p>
        In very general terms, you'll register a <em>client</em> (your application) which displays a button that says "Login with your Bolkaccount". The browser than redirects to <a href="https://auth.debolk.nl">auth.debolk.nl</a> (the <em>authorization server</em>). Once the user logs in there and grants permission to your application to access their account, you'll receive an <em>authorization token</em>. This token is valid only for a very short time.
    </p>
    <p>
        You than immediately exchange the authorization token for two other tokens: an <em>access token</em> and a <em>refresh token</em>. The access token is valid for one hour and is used by your client to do things: this is the token that you send to Bolknoms in the Authorization-header to prove that you are allowed to do things on behalf of the end user. The refresh token is valid for a month and can be used to get a new access token when your current one expires after an hour.
    </p>
    <p>
        To get started with OAuth2, read the <a href="https://www.digitalocean.com/community/tutorials/an-introduction-to-oauth-2">excellent introduction on DigitalOcean</a> and than read the <a href="https://auth.debolk.nl">Bolklogin documentation on what you actually need to do</a>. You might be able to find a OAuth2-library for your favourite language somewhere, to make this somewhat easier.
    </p>

    <h2>Sending access tokens</h2>
    <p>
        Bolknoms requires that you send a valid access token on all requests that require minimum <a href="/docs/authorisation">authorisation level</a>. That token must be send as the "Authorization" HTTP header in the following format:
    </p>
    <p>
        <pre>Authorization: Token b93fe28f2f60c8c69757ef0733f6bc8e046b0ade</pre>
    </p>
    <p>
        Note that you must closely match this format. Omitting the word "Token" or the space that follows it, or encrypting or changing your access token in any way, will all result in errors. Failure to send a valid token will result in <a href="/docs/errors">an error response</a>. You may encounter any of these errors:
    </p>

    @include('docs/partials/tables/errors/oauth')

@endsection
