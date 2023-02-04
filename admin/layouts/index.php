<br>
<div class="container">
<div class="card">
    <div class="card-header">
        Nasılsın, <?php echo $_SESSION["username"]; ?> ?
    </div>
    <div class="card-body">
        <h5 class="card-title">Yönetim Paneline Hoşgeldin</h5>
        <p class="card-text">Burası, web sitesinin iskelet sistemi gibidir, dikkatli olun, bir şey ararken yanlış bir şey yapmak istemezsiniz.</p>
        <?php
        $rank = $First_rankresult["rank"];

        $sqlkont = "SELECT * FROM ranks WHERE id = :id";
        $rankchk = $conn->prepare($sqlkont);
        $rankchk->bindValue(':id', $rank);
        $rankchk->execute();
        $rankresult = $rankchk->fetch(PDO::FETCH_ASSOC);

        if ($rankresult["ADMIN"] != 0) {
            ?>
            <a class="btn btn-danger disabled">Yönetici yetkiniz var!</a>
        <?php
        }
        ?>
            <a class="btn btn-warning disabled">Yetki Adı: <?= $rankresult["name"] ?></a>

    </div>
</div>
</div>
<br>
<br>
<br>