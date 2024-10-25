<?php
// contracts

// 0 => id, 2 => nazwa przedsiebiorcy, 4 => NIP, 10 => kwota,

if ($_GET['akcja'] == 5) {

    // show contracts with amount more than 10

    $x = "id = {$_GET[i]} AND kwota > 10; ";

    switch ($_GET['sort'])

    {

    case 1: $sql_orderby = " order by 2, 4"; break;

    case 2: $sql_orderby = " order by 10"; break;

    }

    if ($sql_orderby == ' order by 2, 4') $b = 'DESC';

    $i = "SELECT * FROM contracts WHERE $x ORDER BY $sql_orderby $b";

    $a = mysql_query($i);

    echo "<html><body bgcolor=$dg_bgcolor>";

    echo "<br>";

    echo "<table width=95%>";

    while ($z = mysql_fetch_array($a)) {

            echo '<tr>';

        echo '<td>'.$z[0];

        echo '</td>';

        echo '<td>';

        echo $z[2];

        if ($z[10] > 5)

        { echo ' '; echo $z[10];

        } echo '</td><tr>';

    }

} else {

    $c = mysql_query("SELECT * FROM contracts WHERE $x ORDER BY id");

    echo "<html><body bgcolor=$dg_bgcolor>";

    echo "<br>";

    echo "<table width=95%>";

    while ($z = mysql_fetch_array($c)) {

        echo '<tr><td>'.$z[0];

        echo '</td>';

        echo '<td>';

        echo $z[2];

        echo '</td><tr>';

    }

}

echo '</table></body></html>';