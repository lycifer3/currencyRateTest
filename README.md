Run Project
=============

### Docker build

1. go to docker folder and run command
```
docker-compose up -d 
```
### Project setting

1. Install composer packages
```
docker-compose exec php_fpm composer install
```
2. Run migration
```
docker-compose exec php_fpm php bin/comsole doctrine:migrations:migrate
```
3. Load fixture
```
docker-compose exec php_fpm php bin/console doctrine:fixtures:load
```
API Endpoints test
=============

1. `http://localhost/api/bitcoin-rate`

#### Query params

Param name | type | required | description
---------- | -----| -------- | ------------
currency | string | `true` | `ISO 4217` format
dateInterval | string | `true` | php `DateInterval` [format](https://www.php.net/manual/ru/dateinterval.construct.php), one of variants `P1H, P12H, P1D, P1W, P1M`

#### Example `http://localhost/api/bitcoin-rate?currency=USD&dateInterval=P1H`
#### Response
```json
{
    "data": [
        {
            "code": "USD",
            "rate": 48787.055,
            "datetime": "2021-08-28T22:51:00+00:00"
        },
        {
            "code": "USD",
            "rate": 48789.4368,
            "datetime": "2021-08-28T22:52:00+00:00"
        },
        {
            "code": "USD",
            "rate": 48762.3789,
            "datetime": "2021-08-28T22:53:00+00:00"
        }
    ]
}
```