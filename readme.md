# Bolknoms3 server
> The very best application in the world for feeding your members in an organized and predictable way.

This is the server-part of the bolknoms3 project. This is een REST-API to manage all meal-related information. Use the [official client](https://github.com/jakobbuis/bolknoms3-client) to register for meals, or roll your own!

## Installation
1. Setup as a regular Laravel application.
1. Configure Task scheduling:
    ```cron
    * * * * * php /code/bolknoms3/api/artisan schedule:run >> /dev/null 2>&1
    ```

## Development
[Jakob Buis](http://www.jakobbuis.nl)
