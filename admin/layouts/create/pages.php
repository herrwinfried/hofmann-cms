<br>
<?php
$rank = $First_rankresult["rank"];

$sqlkont = "SELECT * FROM ranks WHERE id = :id";
$rankchk = $conn->prepare($sqlkont);
$rankchk->bindValue(':id', $rank);
$rankchk->execute();
$rankresult = $rankchk->fetch(PDO::FETCH_ASSOC);

$allowperm = $rankresult["PAGES_ADD"];

if ($allowperm != 1 && $rankresult["ADMIN"] != 1) {
    header("Location: ../../index?failrank");
}
?>
<?php

if(isset($_POST['submitForm'])) {


    $title = $_POST["titleForm"];
    $url = $_POST["urlForm"];
    $text = $_POST["contentFform"];
    $author = $First_rankresult["id"];

    $stmt = $conn->prepare("INSERT INTO pages (name, url, content) VALUES(?,?,?)");
    $stmt->bindParam(1, $title, PDO::PARAM_STR);
    $stmt->bindParam(2, $url, PDO::PARAM_STR);
    $stmt->bindParam(3, $text, PDO::PARAM_STR);
    $stmt->execute();
    ?>
    <div class="alert alert-success text-white" role="alert">
        <b> <?= $title ?> </b> adındaki sayfa oluşturulmuştur.
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


    <form method="POST" action="./pages.php">
        <fieldset class="container-fluid gap-0">
            <legend>Sayfa Oluştur</legend>
            <div class="mb-3">
                <label for="titleForm" class="form-label">Başlık</label>
                <input type="text" name="titleForm" id="titleForm" class="form-control" placeholder="Şok! şok! şok!" required>
            </div>
            <div class="mb-3">
                <label for="urlForm" class="form-label">URL</label>
                <input type="text" name="urlForm" id="urlForm" class="form-control" placeholder="..." required>
            </div>

            <div class="mb-3">
                <label for="contentFform" class="form-label">İçerik</label>
                <textarea name="contentFform" id="contentFform" class=" "></textarea>
                <script>
                    var editor1 = new RichTextEditor("#contentFform", {  galleryImages: [], imageItems: [] });
                </script>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="okeyForm" required>
                    <label class="form-check-label" for="okeyForm">
                        Sayfa oluşturmak istediğimi onaylıyorum.
                    </label>
                </div>
            </div>
            <button type="submit" name="submitForm" id="submitForm" class="btn btn-outline-success">Oluştur</button>
        </fieldset>
    </form>
</div>
</div>
