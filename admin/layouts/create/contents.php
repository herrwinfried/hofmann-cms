<br>
<?php
$rank = $First_rankresult["rank"];

$sqlkont = "SELECT * FROM ranks WHERE id = :id";
$rankchk = $conn->prepare($sqlkont);
$rankchk->bindValue(':id', $rank);
$rankchk->execute();
$rankresult = $rankchk->fetch(PDO::FETCH_ASSOC);

$allowperm = $rankresult["CONTENTS_ADD"];

if ($allowperm != 1 && $rankresult["ADMIN"] != 1) {
    header("Location: ../../index?failrank");
}
?>
<?php

if(isset($_POST['submitForm'])) {


    $title = $_POST["titleForm"];
    $short = $_POST["shortForm"];
    $image = $_POST["imageForm"];
    $text = $_POST["contentFform"];
    $category = $_POST["ctgForm"];
    $author = $First_rankresult["id"];

    $stmt = $conn->prepare("INSERT INTO contents (title, short, image, content, category, author) VALUES(?,?,?,?,?,?)");
    $stmt->bindParam(1, $title, PDO::PARAM_STR);
    $stmt->bindParam(2, $short, PDO::PARAM_STR);
    $stmt->bindParam(3, $image, PDO::PARAM_STR);
    $stmt->bindParam(4, $text, PDO::PARAM_STR);
    $stmt->bindParam(5, $category, PDO::PARAM_STR);
    $stmt->bindParam(6, $author, PDO::PARAM_STR);
    $stmt->execute();
    ?>
    <div class="alert alert-success text-white" role="alert">
        <b> <?= $title ?> </b> adındaki içerik oluşturulmuştur.
    </div>
<?php
}
?>

<link rel="stylesheet" href="../../../richtexteditor/rte_theme_default.css" />
<script type="text/javascript" src="../../../richtexteditor/rte.js"></script>
<script type="text/javascript" src='../../../richtexteditor/plugins/all_plugins.js'></script>
<script type="text/javascript" src='../../../richtexteditor/lang/rte-lang-tr.js'></script>

<div class="" >
<div class="container-fluid gap-0">



<form method="POST" action="./contents.php" enctype = "multipart/form-data">
    <fieldset class="container-fluid gap-0">
        <legend>İçerik Oluştur</legend>
        <div class="mb-3">
            <label for="titleForm" class="form-label">Başlık</label>
            <input type="text" name="titleForm" id="titleForm" class="form-control" placeholder="Şok! şok! şok!" required>
        </div>
        <div class="mb-3">
            <label for="shortForm" class="form-label">Kısa Açıklama</label>
            <input type="text" name="shortForm" id="shortForm" class="form-control" placeholder="..." required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Resim URL</label>
            <input class="form-control" type="text" id="imageForm" name="imageForm" required>
        </div>

        <div class="mb-3">
            <label for="contentFform" class="form-label">İçerik</label>
            <textarea name="contentFform" id="contentFform" class=" "></textarea>
            <script>
                var editor1 = new RichTextEditor("#contentFform", {  galleryImages: [], imageItems: [] });
            </script>
        </div>
        <div class="mb-3">
            <label for="ctgForm" class="form-label">Kategori Seçiniz</label>
            <select name="ctgForm" id="ctgForm"  class="form-select" required>
                <?php
                $sqlkont = "SELECT * FROM categories";
                $ctgchk = $conn->prepare($sqlkont);
                $ctgchk->execute();
                $categoriesresult = $ctgchk->fetchAll(PDO::FETCH_OBJ);
                foreach ($categoriesresult as $ctg_x) {
                    ?>
                    <option value="<?=$ctg_x->id ?>"><?=$ctg_x->name ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="okeyForm" required>
                <label class="form-check-label" for="okeyForm">
                    İçerik oluşturmak istediğimi onaylıyorum.
                </label>
            </div>
        </div>
        <button type="submit" name="submitForm" id="submitForm" class="btn btn-outline-success">Oluştur</button>
    </fieldset>
</form>
</div>
</div>
