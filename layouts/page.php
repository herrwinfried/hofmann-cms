<?php
if(isset($_GET["url"]))
{
    $check_data=$conn->prepare('SELECT * FROM pages WHERE url = :url');
    $check_data->bindValue(':url', $_GET["url"]);
    $check_data->execute();
    $ContentInfo = $check_data->fetch(PDO::FETCH_ASSOC);
    if ($ContentInfo == false) {
   header("Location: /index");
    }


$content_id = $ContentInfo["id"];
$content_title = $ContentInfo["name"];
$content_url = $ContentInfo["url"];
$content_text = $ContentInfo["content"];
?>
    <title><?= $content_title ?> - <?= $First_Inforesult["name"]; ?></title>
        <?php
    // ID varsa


?>

<body>
<div class="container">
    <div class="row" style="padding-bottom: 0px;margin-bottom: 59px;">
        <div class="col-md-8" style="margin-top: 10px;">
            <section class="py-4 py-xl-5">
                <div class="container">


                <h1 style="margin-top: 10px;"><?= $content_title ?></h1>
                <hr>
            <div>
                <?= $content_text ?>

            </div>
            </section>
        </div>

    <?php
    } else {
    header("Location: /index");
}

    ?>

<?php
// Go to ads.php
?>