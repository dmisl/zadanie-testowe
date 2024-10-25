<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="background-color: '<?= $_GET['dg_bgcolor'] ?? 'white' ?>';">

    <a href="/<?=basename(ROOT_PATH)?>">back</a>

    <table width="95%">
        <?php foreach ($contracts as $contract): ?>
            <tr>
                <td><?= $contract['id'] ?></td>
                <td><?= $contract['nazwa_przedsiebiorcy'] ?></td>
                <?php if ($contract['kwota'] > 5): ?>
                    <td><?= $contract['kwota'] ?></td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>