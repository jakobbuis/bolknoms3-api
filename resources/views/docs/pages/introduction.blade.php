@extends('docs/template')

@section('content')
    <h1>Introduction</h1>
    <p>
        Welcome to the API documentation for Bolknoms. This is both the internal and external API. You can use this API
        to build your own full-fledged client to do anything you like! (well, as long as <a href="/docs/authorisation">
        you have sufficient authorisation to do it</a>).
    </p>

    <h2>Ideas</h2>
    <p>
        Do you want to build a <a href="https://www.sparkfun.com/products/9181">giant red button</a> next to your desk (or your bed) that you can slap to register the meal that day? Or have a little widget on your phone that you can toggle to register? Or send your phone a notification every day 15 minutes before the deadline to remind you to register for today's meal? You can do all of those things!
    </p>

    <h2>Help is available</h2>
    <p>
        This API exists mostly because a) it's modern, cool and fancy; and b) there are more great ideas for Bolknoms than I can build myself in my spare time. If you need any help or pointers to get started (and have read this documentation!), I'll be <a href="mailto:jakob@jakobbuis.nl">happy to help you</a>.
    </p>

    <h2>Getting started</h2>
    <p>
        To get started with your first application, start with reading the topics in the menu under Getting Started. These will give you a firm grasp on what you need for your first application. Your first major hurdle is <a href="/docs/working-with-oauth">getting a valid OAuth token</a>, refreshing it, etc. Once you have that, you can experiment with the endpoints under Reference to see what you can see and change in Bolknoms.
    </p>
@endsection
