<?php
if(isset($_GET["error"])) {
    if ($_GET["error"] == "invalidlink") {
        ?>
        <br>
        <div class="alert alert-danger text-white" role="alert">
            Girmeye çalıştığın sayfa mevcut değil. Kaldırılmış olabilir.
        </div>
        <?php
    }
    if ($_GET["error"] == "invalidid") {
        ?>
        <br>
        <div class="alert alert-danger text-white" role="alert">
           Kullanıcı Kimliği ile eşleşen veri bulunamadı. Silinmiş Olabilir mi?
        </div>
        <?php
    }
    ?>
    <?php
    if ($_GET["error"] == "insufficientperm") {
        ?>
        <br>
        <div class="alert alert-danger text-white" role="alert">
            Yetkin Yetmiyor...
        </div>
        <?php
    }
    ?>

    <?php
}

if (isset($_GET["successful"])) {
 ?>
    <?php
    if ($_GET["successful"] == "users") {

        ?>
        <br>
        <div class="alert alert-success text-white" role="alert">
           Başarıyla kullanıcı güncellendi
        </div>
            <?php
    }
    ?>
    <?php
    if ($_GET["successful"] == "deleteusers") {

        ?>
        <br>
        <div class="alert alert-success text-white" role="alert">
            Başarıyla kullanıcı silindi
        </div>
        <?php
    }
    ?>
    <?php
    if ($_GET["successful"] == "unban") {

        ?>
        <br>
        <div class="alert alert-success text-white" role="alert">
            Başarıyla kullanıcının yasağı kaldırıldı.
        </div>
        <?php
    }
    ?>
    <?php
    if ($_GET["successful"] == "ban") {

        ?>
        <br>
        <div class="alert alert-success text-white" role="alert">
            Başarıyla kullanıcı yasaklandı.
        </div>
        <?php
    }
    ?>

    <?php
    if ($_GET["successful"] == "deletecontents") {

        ?>
        <br>
        <div class="alert alert-success text-white" role="alert">
            Başarıyla içerik silindi.
        </div>
        <?php
    }
    ?>

    <?php
    if ($_GET["successful"] == "contents") {

        ?>
        <br>
        <div class="alert alert-success text-white" role="alert">
            Başarıyla içerik düzenlendi.
        </div>
        <?php
    }
    ?>

    <?php
    if ($_GET["successful"] == "deletepages") {

        ?>
        <br>
        <div class="alert alert-success text-white" role="alert">
            Başarıyla sayfa silindi.
        </div>
        <?php
    }
    ?>

    <?php
    if ($_GET["successful"] == "pages") {

        ?>
        <br>
        <div class="alert alert-success text-white" role="alert">
            Başarıyla sayfa düzenlendi.
        </div>
        <?php
    }
    ?>

    <?php
}
?>