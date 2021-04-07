## Instalacija

1. composer install
2. npm install

U .env fajlu podesiti naziv baze i ostale parametre

Nakon toga:
```php artisan migrate:fresh --seed```

## API dokumentacija
Da generisete API dokumentaciju izvrsite komandu: 
```
php artisan scribe:generate
```
Zatim otvorite putanju `/docs`

### Dodatno
ElasticSearch instalirati lokalno za testiranje.

####
Elasticsearch indexi
```
php artisan elastic:create-index "App\PartnerIndexConfigurator" // za konfiguraciju elastic-a
php artisan elastic:update-mapping "App\Models\Partner" // za konfiguraciju elastic-a
php artisan scout:import "App\Models\Partner" // za podatke kad se mijenaju
php artisan elastic:create-index "App\RacuniIndexConfigurator"
php artisan elastic:update-mapping "App\Models\Racun"
php artisan scout:import "App\Models\Racun"
php artisan elastic:create-index "App\FizickaLicaIndexConfigurator"
php artisan elastic:update-mapping "App\Models\FizickoLice"
php artisan scout:import "App\Models\FizickoLice"
php artisan elastic:create-index "App\PreduzecaIndexConfigurator"
php artisan elastic:update-mapping "App\Models\Preduzece"
php artisan scout:import "App\Models\Preduzece"
php artisan elastic:create-index "App\RobaIndexConfigurator"
php artisan elastic:update-mapping "App\Models\Roba"
php artisan scout:import "App\Models\Roba"
php artisan elastic:create-index "App\RobaAtributRobeIndexConfigurator"
php artisan elastic:update-mapping "App\Models\RobaAtributRobe"
php artisan scout:import "App\Models\RobaAtributRobe"
php artisan elastic:create-index "App\UlazniRacuniIndexConfigurator"
php artisan elastic:update-mapping "App\Models\UlazniRacun"
php artisan scout:import "App\Models\UlazniRacun"
php artisan elastic:create-index "App\UslugaIndexConfigurator"
php artisan elastic:update-mapping "App\Models\Usluga"
php artisan scout:import "App\Models\Usluga"
```
