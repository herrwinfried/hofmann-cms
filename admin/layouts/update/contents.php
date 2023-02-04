<br>
<?php
$rank = $First_rankresult["rank"];

$sqlkont = "SELECT * FROM ranks WHERE id = :id";
$rankchk = $conn->prepare($sqlkont);
$rankchk->bindValue(':id', $rank);
$rankchk->execute();
$rankresult = $rankchk->fetch(PDO::FETCH_ASSOC);

$allowperm = $rankresult["CONTENTS_UPDATE"];

if ($allowperm != 1 && $rankresult["ADMIN"] != 1) {
    header("Location: ../../index?failrank");
}
?>


<?php

if(isset($_GET["pid"]))
{
    $check_data=$conn->prepare('SELECT * FROM contents WHERE id = :id');
    $check_data->bindValue(':id', $_GET["pid"]);
    $check_data->execute();
    $ContentInfo = $check_data->fetch(PDO::FETCH_ASSOC);
    if ($ContentInfo == false) {
        header("Location: /admin/contents?error=invalidid");
    }
} else {
    header("Location: /admin/contents?error=invalidlink");
}

    $content_id = $ContentInfo["id"];
    $content_title = $ContentInfo["title"];
    $content_short = $ContentInfo["short"];
    $content_text = $ContentInfo["content"];
    $content_image = $ContentInfo["image"];
    $content_category = $ContentInfo["category"];


?>

<?php

if(isset($_POST['submitForm'])) {
    $Form_ID = $_GET["pid"];

    $title = $_POST["titleForm"];
    $short = $_POST["shortForm"];
    $image = $_POST["imageForm"];
    $text = $_POST["contentFform"];
    $category = $_POST["ctgForm"];

        $update_data = $conn->prepare("UPDATE contents SET title = ?, short = ?, image = ?, content = ?, category = ? WHERE ID = ?");
        $update_data->bindParam(1, $title, PDO::PARAM_STR);
        $update_data->bindParam(2, $short, PDO::PARAM_STR);
        $update_data->bindParam(3, $image, PDO::PARAM_STR);
        $update_data->bindParam(4, $text, PDO::PARAM_STR);
        $update_data->bindParam(5, $category, PDO::PARAM_STR);
        $update_data->bindParam(6, $_GET["pid"], PDO::PARAM_STR);
        $update_data->execute();

   header("Location: /admin/contents.php?successful=contents");

}


?>
<link rel="stylesheet" href="../../../richtexteditor/rte_theme_default.css" />
<script type="text/javascript" src="../../../richtexteditor/rte.js"></script>
<script type="text/javascript" src='../../../richtexteditor/plugins/all_plugins.js'></script>
<script type="text/javascript" src='../../../richtexteditor/lang/rte-lang-tr.js'></script>

<div class="" >
    <div class="container-fluid gap-0">



        <form method="POST" action="./contents.php?pid=<?= $_GET["pid"] ?>">
            <fieldset class="container-fluid gap-0">
                <legend>İçerik Oluştur</legend>
                <div class="mb-3">
                    <label for="titleForm" class="form-label">Başlık</label>
                    <input type="text" name="titleForm" id="titleForm" class="form-control" placeholder="Şok! şok! şok!"  value="<?= $content_title ?>" required>
                </div>
                <div class="mb-3">
                    <label for="shortForm" class="form-label">Kısa Açıklama</label>
                    <input type="text" name="shortForm" id="shortForm" class="form-control" placeholder="..." value="<?= $content_short ?>" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Resim URL</label>
                    <input class="form-control" type="text" id="imageForm" name="imageForm" value="<?= $content_image ?>" required>
                </div>

                <div class="mb-3">
                    <label for="contentFform" class="form-label">İçerik</label>
                    <textarea name="contentFform" id="contentFform" class=" "><?= $content_text ?></textarea>
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
                        if ($content_category == $ctg_x->id) {
                            ?>
                            <option value="<?=$ctg_x->id ?>" selected><?=$ctg_x->name ?></option>
                            <?php
                        } else {
                            ?>
                            <option value="<?=$ctg_x->id ?>" ><?=$ctg_x->name ?></option>

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
                            İçerik güncellemek istediğimi onaylıyorum.
                        </label>
                    </div>
                </div>
                <button type="submit" name="submitForm" id="submitForm" class="btn btn-outline-warning">Güncelle</button>
            </fieldset>
        </form>
    </div>
</div>
