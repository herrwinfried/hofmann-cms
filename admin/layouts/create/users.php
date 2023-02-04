<br>
<?php
$rank = $First_rankresult["rank"];

$sqlkont = "SELECT * FROM ranks WHERE id = :id";
$rankchk = $conn->prepare($sqlkont);
$rankchk->bindValue(':id', $rank);
$rankchk->execute();
$rankresult = $rankchk->fetch(PDO::FETCH_ASSOC);

$allowperm = $rankresult["USER_ADD"];

if ($allowperm != 1 && $rankresult["ADMIN"] != 1) {
    header("Location: ../../index?failrank");
}
?>
<?php

if(isset($_POST['submitForm'])) {
    $username = $_POST["usernameForm"];
    $email = $_POST["emailForm"];
    $password = $_POST["passwordForm"];
    $rank = $_POST["rankForm"];

    $sqlkont = "SELECT * FROM users WHERE username = :username";
    $rankchk = $conn->prepare($sqlkont);
    $rankchk->bindValue(':username', $username);
    $rankchk->execute();
    $Sec_rankresult = $rankchk->fetch(PDO::FETCH_ASSOC);

    $sqlkont = "SELECT * FROM users WHERE email = :email";
    $rankchk = $conn->prepare($sqlkont);
    $rankchk->bindValue(':email', $email);
    $rankchk->execute();
    $Sec_mailresult = $rankchk->fetch(PDO::FETCH_ASSOC);

    if ($Sec_rankresult) {
        ?>
        <div class="alert alert-danger text-white" role="alert">
            <b> <?= $username ?> </b> adında kullanıcı hesabı zaten var.
        </div>
        <?php
    }
    elseif ($Sec_mailresult) {
        ?>
        <div class="alert alert-danger text-white" role="alert">
            <b> <?= $email ?> </b> eposta adresli kullanıcı hesabı zaten var.
        </div>
        <?php
    }
    else {

    $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));

    $stmt = $conn->prepare("INSERT INTO users (username, email, password, rank) VALUES(?,?,?,?)");
    $stmt->bindParam(1, $username, PDO::PARAM_STR);
    $stmt->bindParam(2, $email, PDO::PARAM_STR);
    $stmt->bindParam(3, $passwordHash, PDO::PARAM_STR);
    $stmt->bindParam(4, $rank, PDO::PARAM_STR);
    $stmt->execute();
    ?>
    <div class="alert alert-success text-white" role="alert">
        <b> <?= $username ?> </b> adında kullanıcı hesabı açılmıştır.
</div>
<?php
    }
}
?>

<div class="container-fluid gap-0">

<form method="POST" action="./users.php">
    <fieldset class="container-fluid gap-0">
        <legend>Kullanıcı Oluştur</legend>
        <div class="mb-3">
            <label for="usernameForm" class="form-label">Kullanıcı adı</label>
            <input type="text" name="usernameForm" id="usernameForm" class="form-control" placeholder="Kullanıcı adı Giriniz..." required>
        </div>
        <div class="mb-3">
            <label for="emailForm" class="form-label">E-mail</label>
            <input type="email" name="emailForm" id="emailForm" class="form-control" placeholder="E-mail Giriniz..." required>
        </div>
        <div class="mb-3">
            <label for="passwordForm" class="form-label">Parola</label>
            <input type="password" name="passwordForm" id="passwordForm" class="form-control" placeholder="Parola Giriniz..." required>
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
                    ?>
                    <option value="<?=$rank_x->id?>"><?=$rank_x->name?></option>
                <?php
                    } elseif ($rankresult["ADMIN"] == 1) {
                        ?>
                        <option value="<?=$rank_x->id?>"><?=$rank_x->name?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="okeyForm" required>
                <label class="form-check-label" for="okeyForm">
                    Kullanıcı oluşturmak istediğimi onaylıyorum.
                </label>
            </div>
        </div>
        <button type="submit" name="submitForm" id="submitForm" class="btn btn-outline-success">Oluştur</button>
    </fieldset>
</form>
</div>
