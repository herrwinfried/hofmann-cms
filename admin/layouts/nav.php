<?php

if($First_rankresult === false){
    header("Location: ./login.php?requirelogin");
}
$rank = $First_rankresult["rank"];



?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/admin/index">Anasayfa</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php
                $sqlkont = "SELECT * FROM ranks WHERE id = :id";
                $rankchk = $conn->prepare($sqlkont);
                $rankchk->bindValue(':id', $rank);
                $rankchk->execute();
                $rankresult = $rankchk->fetch(PDO::FETCH_ASSOC);
                if ($rankresult["PANEL"] != 0 && $rankresult["ADMIN"] != 0) {
                header("/index");
                }
                ?>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $_SESSION['username'] ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/index">Admin Panelden Çık</a></li>
                            <li><a class="dropdown-item" href="./logout.php">Oturumu Kapat</a></li>
                        </ul>
                    </li>





                <?php
                if ($rankresult["PAGES_LIST"] != 0 || $rankresult["ADMIN"] != 0) {
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="/admin/pages" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Sayfalar
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/admin/pages">Sayfalar</a></li>
                        <?php
                        if ($rankresult["PAGES_ADD"] != 0 || $rankresult["ADMIN"] != 0) {
                        ?>
                        <li><a class="dropdown-item" href="/admin/create/pages">Sayfa Oluştur</a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </li>

                <?php
                }
                ?>
                <?php
                if ($rankresult["CONTENTS_LIST"] != 0 || $rankresult["ADMIN"] != 0) {
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="/admin/contents" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        İçerikler
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/admin/contents">İçerikler</a></li>
                        <?php
                        if ($rankresult["CONTENTS_ADD"] != 0 || $rankresult["ADMIN"] != 0) {
                        ?>
                        <li><a class="dropdown-item" href="/admin/create/contents">İçerik Oluştur</a></li>
                            <?php
                        }
                        ?>
                        <?php
                        if ($rankresult["CATEGORIES_LIST"] != 0 || $rankresult["ADMIN"] != 0) {
                            ?>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/admin/categories">Kategoriler</a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>

                    <?php
                }
                ?>

                <?php
                if ($rankresult["USER_LIST"] != 0 || $rankresult["ADMIN"] != 0) {
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="/admin/users" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Kullanıcılar
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/admin/users">Kullanıcılar</a></li>
                        <?php
                        if ($rankresult["USER_ADD"] != 0 || $rankresult["ADMIN"] != 0) {
                        ?>
                        <li><a class="dropdown-item" href="/admin/create/users">Kullanıcı Oluştur</a></li>
                            <?php
                        }
                        ?>
                        <?php
                        if ($rankresult["RANK_LIST"] != 0 || $rankresult["ADMIN"] != 0) {
                        ?>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/admin/ranks">Yetkiler</a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </li>
                    <?php
                }
                ?>
            </ul>

        </div>
    </div>
</nav>
</div>
