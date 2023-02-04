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
    $check_data=$conn->prepare('SELECT * FROM pages WHERE id = :id');
    $check_data->bindValue(':id', $_GET["pid"]);
    $check_data->execute();
    $PageInfo = $check_data->fetch(PDO::FETCH_ASSOC);
    if ($PageInfo == false) {
        header("Location: /admin/pages?error=invalidid");
    }
} else {
    header("Location: /admin/pages?error=invalidlink");
}
$page_id = $PageInfo["id"];
$page_title = $PageInfo["name"];
$page_url = $PageInfo["url"];
$page_text = $PageInfo["content"];

?>

<?php

if(isset($_POST['submitForm'])) {
    $Form_ID = $_GET["pid"];
    $title = $_POST["titleForm"];
    $url = $_POST["urlForm"];
    $text = $_POST["contentFform"];

        $update_data = $conn->prepare("UPDATE pages SET name = ?, url = ?, content = ? WHERE ID = ?");
    $update_data->bindParam(1, $title, PDO::PARAM_STR);
    $update_data->bindParam(2, $url, PDO::PARAM_STR);
    $update_data->bindParam(3, $text, PDO::PARAM_STR);
    $update_data->bindParam(4, $_GET["pid"], PDO::PARAM_STR);
        $update_data->execute();

   header("Location: /admin/pages.php?successful=pages");

}


?>
<link rel="stylesheet" href="../../../richtexteditor/rte_theme_default.css" />
<script type="text/javascript" src="../../../richtexteditor/rte.js"></script>
<script type="text/javascript" src='../../../richtexteditor/plugins/all_plugins.js'></script>
<script type="text/javascript" src='../../../richtexteditor/lang/rte-lang-tr.js'></script>

<div class="" >
    <div class="container-fluid gap-0">



        <form method="POST" action="./pages.php?pid=<?= $_GET["pid"] ?>">
            <fieldset class="container-fluid gap-0">
                <legend>Sayfa Oluştur</legend>
                <div class="mb-3">
                    <label for="titleForm" class="form-label">Başlık</label>
                    <input type="text" name="titleForm" id="titleForm" class="form-control" placeholder="Şok! şok! şok!" value="<?= $page_title ?>" required>
                </div>
                <div class="mb-3">
                    <label for="urlForm" class="form-label">URL</label>
                    <input type="text" name="urlForm" id="urlForm" class="form-control" placeholder="..." value="<?= $page_url ?>" required>
                </div>

                <div class="mb-3">
                    <label for="contentFform" class="form-label">İçerik</label>
                    <textarea name="contentFform" id="contentFform" class=" "><?= $page_text ?></textarea>
                    <script>
                        var editor1 = new RichTextEditor("#contentFform", {  galleryImages: [], imageItems: [] });
                    </script>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="okeyForm" required>
                        <label class="form-check-label" for="okeyForm">
                            Sayfa güncellemek istediğimi onaylıyorum.
                        </label>
                    </div>
                </div>
                <button type="submit" name="submitForm" id="submitForm" class="btn btn-outline-warning">Güncelle</button>
            </fieldset>
        </form>
    </div>
</div>
