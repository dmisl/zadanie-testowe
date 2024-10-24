<?php

require 'vendor/autoload.php';

echo str_repeat("=", 100)."\n";
echo "Przede wszystkim w przypadku wystąpienia błędu proszę państwo zmienić ustawinia połączenia z serwerem w pliku database.php\n";
echo str_repeat("=", 100)."\n";

// POŁĄCZAMY SIĘ Z SERWEREM (JEŻELI PAŃTWO MA INNE USTAWIENIA - PROSZE ZMIENIĆ)

  $connection = mysqli_connect('localhost', 'root', '');

// TWORZYMY BAZE DANYCH
  // function create_database($name, $connection)
  // {
  //   try {
  //     $query = "CREATE DATABASE $name";
  //     $connection->query($query);
  //     echo "Baza danych pod nazwą $name była utworzona \n";
  //     $connection->select_db($name);
  //     return $connection;
  //   } catch (mysqli_sql_exception $e) {
  //     echo "Wygląda na to że baza danych już pod nazwą \"$name\" istnieje \n";
  //     echo "Wpisz inną nazwe nowej bazy danych \n";
  //     echo "Nazwa nowej bazy danych: ";
  //     return create_database(trim(fgets(STDIN)), $connection);
  //   }
  // }

  // echo "\n\n".str_repeat("=", 100)."\n\n";
  // echo "1/2 Tworzymy bazy danych\n";

  // $connection = create_database('zadanie', $connection);

  // echo "2/2 Baza danych była utworzona\n";
  // echo "\n\n".str_repeat("=", 100)."\n\n";

// ZAPEŁNIAMY STRUKTURE BAZY (JA BYM JĄ OCZEWIŚCIE NORMALIZOWAŁ, ALE W ŻYCIU JEST TAK, ŻE GRUBY ROBI TO CO MU POWIEDZĄ)

  // echo "\n\n".str_repeat("=", 100)."\n\n";
  // echo "Tworzymy tabeli i ich struktury...\n";

  // $klienci_structure = "CREATE TABLE `klienci` (
  //   `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  //   `login` varchar(255) NOT NULL,
  //   `konto_bankowe` varchar(28) NOT NULL,
  //   `NIP` varchar(10) NOT NULL,
  //   PRIMARY KEY (`id`)
  // )";

  // $connection->query($klienci_structure);

  // echo "1/4 Klienci już są\n";

  // $faktury_structure = "CREATE TABLE `faktury` (
  //   `numer` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  //   `data_wystawienia` date NOT NULL,
  //   `termin_platnosci` date NOT NULL,
  //   `suma_brutto` decimal(10,2) NOT NULL,
  //   `klient_id` int DEFAULT NULL,
  //   PRIMARY KEY (`numer`),
  //   KEY `klient_id` (`klient_id`)
  // )";

  // $connection->query($faktury_structure);

  // echo "2/4 Faktury połaczyły się\n";

  // $pozycje_faktury_structure = "CREATE TABLE IF NOT EXISTS `pozycje_faktury` (
  //   `id` int NOT NULL AUTO_INCREMENT,
  //   `nazwa_produktu` varchar(255) NOT NULL,
  //   `ilosc` int NOT NULL,
  //   `cena` decimal(10,2) NOT NULL,
  //   `numer_faktury` varchar(50) NOT NULL,
  //   PRIMARY KEY (`id`),
  //   KEY `numer_faktury` (`numer_faktury`)
  // )";

  // $connection->query($pozycje_faktury_structure);

  // echo "3/4 Pozycjy faktury są\n";

  // $platnosci_structure = "CREATE TABLE IF NOT EXISTS `platnosci` (
  //   `id` int NOT NULL AUTO_INCREMENT,
  //   `tytul` varchar(255) NOT NULL,
  //   `kwota` decimal(10,2) NOT NULL,
  //   `data_wplaty` date NOT NULL,
  //   `numer_konta` varchar(28) NOT NULL,
  //   `numer_faktury` varchar(50) NOT NULL,
  //   PRIMARY KEY (`id`),
  //   KEY `numer_faktury` (`numer_faktury`)
  // )";

  // $connection->query($platnosci_structure);

  // echo "4/4 Płatności mowią że to się wjeżdża\n";

  // echo "Struktura bazy danych jest gotowa do korzystania";

  // echo "\n\n".str_repeat("=", 100)."\n\n";

// ZAPEWNIAMY TABELE DANYMI

  $connection->select_db("zadanie");

  echo "\n\n".str_repeat("=", 100)."\n\n";
  echo "Zapewniamy tabele przykładowymi danymi\n";
  echo "1/4 Zapewniamy klientów\n";

  // KORZYSTAJAC Z FAKERA TWORZYMY 20 KLIENTÓW
    $faker = Faker\Factory::create();

    // $klienci = [];
    // for ($i = 0; $i < 20; $i++) {
    //   $accountNumber = 'PL';
    //   for ($i2 = 0; $i2 < 26; $i2++) {
    //       $accountNumber .= rand(0, 9);
    //   }
    //   $klienci[] = "('" . $faker->userName() . "', '" . $accountNumber . "', '" . str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT) . "')";
    // }

    // $connection->query("INSERT INTO klienci (login, konto_bankowe, NIP) VALUES " . implode(", ", $klienci));

  echo "2/4 Zapewniamy klientowskie faktury\n";

  // TWORZYMY PO 3 FAKTURY DLA KAŻDEGO KLIENTA
    $result = $connection->query('SELECT id FROM klienci');
    $faktury = [];
    while($row = mysqli_fetch_assoc($result))
    {
      for ($i = 0; $i < 3; $i++) {
        $rok = date('Y');
        $miesiac = date('m');
        $numerPorzadkowy = str_pad(count($faktury)+1, 4, '0', STR_PAD_LEFT);

        $numer = "FV/$rok/$miesiac/$numerPorzadkowy";
        $data_wystawienia = $faker->date();
        $termin_platnosci = date('Y-m-d', strtotime($data_wystawienia . ' + 14 days'));
        $suma_brutto = $faker->randomFloat(2, 100, 1000);

        $faktury[] = "('$numer', '$data_wystawienia', '$termin_platnosci', '$suma_brutto', {$row['id']})";
      }
    }
    $connection->query("INSERT INTO faktury (numer, data_wystawienia, termin_platnosci, suma_brutto, klient_id) VALUES " . implode(", ", $faktury));

// ZAMYKAMY POŁĄCZENIE
  $connection->close();