<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link rel="stylesheet" href="storage/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <div class="parent">

        <div class="account__badge__parent">
            <div class="account__badge">

                <img class="avatar" src="storage/img/avatar.jpg">
                <form action="auth" method="POST">
                    <select class="form-select change_user" name="user_id">
                        <!-- SHOWING OUR USERS -->
                        <?php foreach ($users as $user): ?>
                            <option value="<?=htmlspecialchars($user['id'])?>" <?=htmlspecialchars($user['id']) == $_SESSION['user_id'] ? 'selected' : ''?>>
                                <?=htmlspecialchars($user['login'])?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" style="display: none;"></button>
                </form>
                <p class="hint">zmień konto</p>
            </div>
        </div>
    
        <a href="/<?=basename(ROOT_PATH)?>">back</a>
        <div class="nadplaty_content">

            <div class="d-flex">
                <h1 class="title">Zalegwych faktur: <?=$zalegle->num_rows?></h1>
                <form action="zalegle" method="POST">
                    <button name="sort" value="ASC" style="margin-top: 30px; margin-left: 50px;">sort asc</button>
                </form>
                <form action="zalegle" method="POST">
                    <button name="sort" value="DESC" style="margin-top: 30px; margin-left: 50px;">sort desc</button>
                </form>
            </div>
            
            <table class="wplaczic">
                <tr>
                    <th>Numer faktury</th>
                    <th>Data wystawienia</th>
                    <th>Termin płatności</th>
                    <th>Suma brutto</th>
                </tr>
                <?php foreach ($zalegle as $zalegla): ?>
                    <tr>
                        <td><?=$zalegla['numer']?></td>
                        <td><?=$zalegla['data_wystawienia']?></td>
                        <td><?=$zalegla['termin_platnosci']?></td>
                        <td><?=$zalegla['suma_brutto']?></td>
                        <td><?=$zalegla['SUM(platnosci.kwota)']?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>

    </div>
    
</body>
</html>
<script>
    
    let change_user = document.querySelector('.change_user')
    let change_user_submit = change_user.parentElement.querySelector('button')
    
    change_user.addEventListener('change', function () {
        change_user_submit.click()
    })

</script>