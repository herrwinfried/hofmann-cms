<nav data-bs-theme="dark" class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/index"><?= $First_Inforesult["name"]; ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php
                if (isset($_SESSION['account'])) {
                    if ($_SESSION['account'] = "active") {
                        $sqlkont = "SELECT * FROM users WHERE id = :id";
                        $rankchk = $conn->prepare($sqlkont);
                        $rankchk->bindValue(':id', $_SESSION['user_id']);
                        $rankchk->execute();
                        $First_userresult = $rankchk->fetch(PDO::FETCH_ASSOC);

                        $rank_user = $First_userresult["rank"];
                        $sqlkont = "SELECT * FROM ranks WHERE id = :id";
                        $rankchk = $conn->prepare($sqlkont);
                        $rankchk->bindValue(':id', $rank_user);
                        $rankchk->execute();
                        $First_rankresult = $rankchk->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?=$First_userresult["username"] ?>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if ($First_rankresult["PANEL"] != 0 || $First_rankresult["ADMIN"] != 0 ) { ?>
                                <li><a class="dropdown-item" href="/admin/index">Admin Paneline Git</a></li>
                            <?php  }?>
                            <li><a class="dropdown-item" href="./logout.php">Oturumu Kapat</a></li>
                        </ul>

                        <li class="nav-item">
                            <a class="nav-link" href="/content" role="button" aria-expanded="false">
                                İçerikler
                            </a>
                        </li>
                        <?php
                    }
                } else {
                    ?>

                    <li class="nav-item">
                        <a class="nav-link" href="/content" role="button" aria-expanded="false">
                            İçerikler
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/login" role="button" aria-expanded="false">
                            Giriş Yap
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register" role="button" aria-expanded="false">
                            Kayıt Ol
                        </a>
                    </li>

                    <?php
                }
                ?>

            </ul>

        </div>
    </div>
</nav>
<br>
