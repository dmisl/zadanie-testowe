<?php

echo str_repeat("=", 100)."\n";
echo "Przede wszystkim w przypadku wystąpienia błędu proszę państwo zmienić ustawinia połączenia z serwerem w pliku database.php\n";
echo str_repeat("=", 100)."\n";

// POŁĄCZAMY SIĘ Z MYSQL (JEŻELI PAŃTWO MA INNE USTAWIENIA - PROSZE ZMIENIĆ)

  $connection = mysqli_connect('localhost', 'root', '');

// TWORZYMY BAZE DANYCH
  function create_database($name, $connection)
  {
    try {
      $query = "CREATE DATABASE $name";
      $connection->query($query);
      echo "Baza danych pod nazwą $name była utworzona \n";
      $connection->select_db($name);
      return $connection;
    } catch (mysqli_sql_exception $e) {
      echo "Wygląda na to że baza danych już pod nazwą \"$name\" istnieje \n";
      echo "Wpisz inną nazwe nowej bazy danych \n";
      echo "Nazwa nowej bazy danych: ";
      return create_database(trim(fgets(STDIN)), $connection);
    }
  }

  echo "\n\n".str_repeat("=", 100)."\n\n";
  echo "1/2 Tworzymy bazy danych\n";

  $connection = create_database('zadanie', $connection);

  echo "2/2 Baza danych była utworzona\n";
  echo "\n\n".str_repeat("=", 100)."\n\n";

// ZAPEŁNIAMY STRUKTURE BAZY (JA BYM JĄ OCZEWIŚCIE NORMALIZOWAŁ, ALE W ŻYCIU JEST TAK, ŻE GRUBY ROBI TO CO MU POWIEDZĄ)

  echo "\n\n".str_repeat("=", 100)."\n\n";
  echo "Tworzymy tabeli i ich struktury...\n";

  // $connection->select_db('zadanie');

  $klienci_structure = "CREATE TABLE `klienci` (
    `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
    `login` varchar(255) NOT NULL,
    `konto_bankowe` varchar(34) NOT NULL,
    `NIP` varchar(10) NOT NULL,
    PRIMARY KEY (`id`)
  )";

  $connection->query($klienci_structure);

  echo "1/4 Klienci już są\n";

  $faktury_structure = "CREATE TABLE `faktury` (
    `numer` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
    `data_wystawienia` date NOT NULL,
    `termin_platnosci` date NOT NULL,
    `suma_brutto` decimal(10,2) NOT NULL,
    `klient_id` int DEFAULT NULL,
    PRIMARY KEY (`numer`),
    KEY `klient_id` (`klient_id`)
  )";

  $connection->query($faktury_structure);

  echo "2/4 Faktury połaczyły się\n";

  $pozycje_faktury_structure = "CREATE TABLE IF NOT EXISTS `pozycje_faktury` (
    `id` int NOT NULL AUTO_INCREMENT,
    `nazwa_produktu` varchar(255) NOT NULL,
    `ilosc` int NOT NULL,
    `cena` decimal(10,2) NOT NULL,
    `numer_faktury` varchar(50) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `numer_faktury` (`numer_faktury`)
  )";

  $connection->query($pozycje_faktury_structure);

  echo "3/4 Pozycjy faktury są\n";

  $platnosci_structure = "CREATE TABLE IF NOT EXISTS `platnosci` (
    `id` int NOT NULL AUTO_INCREMENT,
    `tytul` varchar(255) NOT NULL,
    `kwota` decimal(10,2) NOT NULL,
    `data_wplaty` date NOT NULL,
    `numer_konta` varchar(34) NOT NULL,
    `numer_faktury` varchar(50) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `numer_faktury` (`numer_faktury`)
  )";

  $connection->query($platnosci_structure);

  echo "4/4 Płatności mowią że to się wjeżdża\n";

  echo "Struktura bazy danych jest gotowa do korzystania";

  echo "\n\n".str_repeat("=", 100)."\n\n";

// ZAMYKAMY POŁĄCZENIE
  $connection->close();