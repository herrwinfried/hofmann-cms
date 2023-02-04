<br>
<?php
$rank = $First_rankresult["rank"];

$sqlkont = "SELECT * FROM ranks WHERE id = :id";
$rankchk = $conn->prepare($sqlkont);
$rankchk->bindValue(':id', $rank);
$rankchk->execute();
$rankresult = $rankchk->fetch(PDO::FETCH_ASSOC);

$allowperm = $rankresult["USER_UPDATE"];

if ($allowperm != 1 && $rankresult["ADMIN"] != 1) {
    header("Location: ../../index?failrank");
}
?>


<?php

if(isset($_GET["pid"]))
{
    $check_data=$conn->prepare('SELECT id, username, email, rank FROM users WHERE id = :id');
    $check_data->bindValue(':id', $_GET["pid"]);
    $check_data->execute();
    $UserInfo = $check_data->fetch(PDO::FETCH_ASSOC);
    if ($UserInfo == false) {
        header("Location: /admin/users?error=invalidid");
    }
} else {
    header("Location: /admin/users?error=invalidlink");
}

    $user_id = $UserInfo["id"];
    $user_username = $UserInfo["username"];
    $user_rank = $UserInfo["rank"];
    $user_email = $UserInfo["email"];


if ($rankresult["ADMIN"] == 0 && $rank < $user_rank) {
    header("Location: /admin/users?error=insufficientperm");
}
    elseif ($rankresult["ADMIN"] == 0 && $rank == $user_rank) {
        header("Location: /admin/users?error=insufficientperm");
    }
     elseif ($rankresult["ADMIN"] == 0 && $user_id == $First_rankresult["id"]) {
        header("Location: /admin/users?error=insufficientperm");
    } else {
?>

<?php

if(isset($_POST['submitForm'])) {
    $Form_ID = $_GET["pid"];
    $username = $_POST["usernameForm"];
    $email = $_POST["emailForm"];
    $password = $_POST["passwordForm"];
    $rankF = $_POST["rankForm"];

$sqlkont = "SELECT * FROM users WHERE username = :username";
$rankchk = $conn->prepare($sqlkont);
$rankchk->bindValue(':username', $username);
$rankchk->execute();
$Sec_result = $rankchk->fetch(PDO::FETCH_ASSOC);

$sqlkont = "SELECT * FROM users WHERE email = :email";
$rankchk = $conn->prepare($sqlkont);
$rankchk->bindValue(':email', $email);
$rankchk->execute();
$Twi_result = $rankchk->fetch(PDO::FETCH_ASSOC);

if ($Sec_result && ($Sec_result["id"] != $Form_ID)) {
    ?>
    <div class="alert alert-danger text-white" role="alert">
        Bu kullanıcı adına sahip kullanıcı var!
    </div>
    <?php
} elseif ($Twi_result && ($Twi_result["id"] != $Form_ID)) {
        ?>
        <div class="alert alert-danger text-white" role="alert">
            Bu epostaya sahip kullanıcı var!
        </div>
        <?php
    }
    else {

    if (empty($password)) {
        $update_data = $conn->prepare("UPDATE users SET username = ?, email = ?, rank = ? WHERE ID = ?");
        $update_data->bindParam(1, $username, PDO::PARAM_STR);
        $update_data->bindParam(2, $email, PDO::PARAM_STR);
        $update_data->bindParam(3, $rankF, PDO::PARAM_STR);
        $update_data->bindParam(4, $_GET["pid"], PDO::PARAM_STR);
        $update_data->execute();
    } else {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));

        $update_data = $conn->prepare("UPDATE users SET username = ?, email = ?, rank = ?, password = ? WHERE ID = ?");
        $update_data->bindParam(1, $username, PDO::PARAM_STR);
        $update_data->bindParam(2, $email, PDO::PARAM_STR);
        $update_data->bindParam(3, $rankF, PDO::PARAM_STR);
        $update_data->bindParam(4, $passwordHash, PDO::PARAM_STR);
        $update_data->bindParam(5, $_GET["pid"], PDO::PARAM_STR);
        $update_data->execute();
    }
   header("Location: /admin/users.php?successful=users");

}
}
}
?>

<div class="container-fluid gap-0">
    <form method="POST" action="./users.php?pid=<?= $_GET["pid"] ?>">
        <fieldset class="container-fluid gap-0">
            <legend>Kullanıcı Düzenle</legend>
            <div class="mb-3">
                <label for="usernameForm" class="form-label">Kullanıcı adı</label>
                <input type="text" name="usernameForm" id="usernameForm" class="form-control" placeholder="Kullanıcı adı Giriniz..." value="<?= $user_username ?>" required>
            </div>
            <div class="mb-3">
                <label for="emailForm" class="form-label">E-mail</label>
                <input type="email" name="emailForm" id="emailForm" class="form-control" placeholder="E-mail Giriniz..." value="<?= $user_email ?>" required>
            </div>
            <div class="mb-3">
                <label for="passwordForm" class="form-label">Parola</label>
                <input type="password" name="passwordForm" id="passwordForm" class="form-control" placeholder="Parola Giriniz...">
            </div>
            <div class="mb-3">
                <label for="rankForm" class="form-label">Yetki Seçiniz</label>
                <select name="rankForm" id="rankForm"  class="form-select" required>
                    <?php
                    $sqlkont = "SELECT id,name FROM ranks";
                    $rankchk = $conn->prepare($sqlkont);
                    $rankchk->execute();
                    $ranksresult = $rankchk->fetchAll(PDO::FETCH_OBJ);
                    foreach ($ranksresult as $rank_x) {
                        if ($rankresult["ADMIN"] == 0 && $rank > $rank_x->id) {
                            if ($user_rank == $rank_x->id) {
                                ?>
                                <option value="<?=$rank_x->id?>" selected><?=$rank_x->name?></option>
                                <?php
                            } else {
                            ?>
                            <option value="<?=$rank_x->id?>"><?=$rank_x->name?></option>
                            <?php
                            }} elseif ($rankresult["ADMIN"] == 1) {
                            if ($user_rank == $rank_x->id) {
                                ?>
                                <option value="<?=$rank_x->id?>" selected><?=$rank_x->name?></option>
                                <?php
                            } else {
                                ?>
                            <option value="<?=$rank_x->id?>"><?=$rank_x->name?></option>
                            <?php
                        }}
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="okeyForm" required>
                    <label class="form-check-label" for="okeyForm">
                        Kullanıcı bilgilerini değiştirmek istediğimi onaylıyorum.
                    </label>
                </div>
            </div>
            <button type="submit" name="submitForm" id="submitForm" class="btn btn-outline-warning">Güncelle</button>
        </fieldset>
    </form>
</div>



