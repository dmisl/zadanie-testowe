### Pierwsze zadanie

Proszę stworzyć bazę danych, na to są 2 sposoby <br>
1 - Ręcznie - zaimportować plik zadanie.sql
```
zaimportowac plik do serwera z bazami danych
php composer.phar install
```
2 - Skorzystać z skryptu database.php, który zapewni wszystko losowymi danymi, a także zainstaluje zależności aplikacji przez composer
```
php database.php
```

Połączenie z bazą wykonuje się przez
```
App\Model\Database.php
```
> [!WARNING]
> w przypadku jeżeli państwu nie udało się połączyć się z serwerem baz danych - prosze zmienić konfiguracje pod swój serwer baz danych

Po tym wchodzimy na adres http://127.0.0.1/zadanie-testowe/

### Drugie zadanie było realizowane w plikach 
```
app/Controller/ContractController.php
app/Model/Contract.php
app/View/contract.php
```
