<?php
if(isset($_GET["id"]))
{
    $check_data=$conn->prepare('SELECT * FROM contents WHERE id = :id');
    $check_data->bindValue(':id', $_GET["id"]);
    $check_data->execute();
    $ContentInfo = $check_data->fetch(PDO::FETCH_ASSOC);
    if ($ContentInfo == false) {
        header("Location: /content");
    }


$content_id = $ContentInfo["id"];
$content_title = $ContentInfo["title"];
$content_short = $ContentInfo["short"];
$content_text = $ContentInfo["content"];
$content_image = $ContentInfo["image"];
$content_category = $ContentInfo["category"];
$content_time = $ContentInfo["time"];
$content_author = $ContentInfo["author"];

    $categories_prepare = "SELECT id, name FROM categories WHERE id = :id";
    $categories = $conn->prepare($categories_prepare);
    $categories->bindValue(':id', $content_category);
    $categories->execute();
    $categoryname = $categories->fetch(PDO::FETCH_ASSOC);
    $categoryname = $categoryname["name"];

    $author_prepare = "SELECT id, username FROM users WHERE id = :id";
    $author = $conn->prepare($author_prepare);
    $author->bindValue(':id', $content_author);
    $author->execute();
    $authorname = $author->fetch(PDO::FETCH_ASSOC);
    $authorname = $authorname["username"];

$time_x = date_create("$content_time");
    $time_x = date_format($time_x, 'd-m-Y H:i');
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
                    <div class="bg-dark border rounded border-0 border-dark overflow-hidden">
                        <div class="row g-0">
                            <div class="col"><img class="w-100 h-100 fit-cover" src="<?= $content_image ?>" width="592" height="338"></div>
                        </div>
                    </div>
                </div>
                <h1 style="margin-top: 10px;"><?= $content_title ?></h1>
                <small class="text-capitalize"><b>Yazar: </b> <?= $authorname ?> </small>
                <div>
                    <small class="text-capitalize"><b>Kategori:</b> <?= $categoryname ?> </small>
                </div>
                <div>
                    <small class="text-capitalize"><b>Oluşturulma Zamanı:</b> <?= $time_x;?>
                    </small>
                </div>
                <hr>
            <div>
                <?= $content_text ?>

            </div>
            </section>
        </div>

    <?php
    } else {
    // ID YOKSA
    ?>

        <title>İçerikler - <?=$First_Inforesult["name"]; ?></title>
        <?php
        $content_check=$conn->query('SELECT * FROM contents ORDER BY ID DESC');
        ?>
        <body>
        <div class="container">
            <div class="row" style="padding-bottom: 0px;margin-bottom: 59px;">
                <div class="col-md-8" style="margin-top: 10px;">
                    <h3 style="margin-bottom: 20px;">İçerikler</h3>
                    <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
                        <?php
                        if ($content_check) {
                            while ($news = $content_check->fetch(PDO::FETCH_ASSOC)) {
                                $content_author = $news["author"];
                                $content_title = $news["title"];
                                $content_short = $news["short"];
                                $content_id = $news["id"];
                                $content_category = $news["category"];
                                $content_image = $news["image"];

                                $categories_prepare = "SELECT id, name FROM categories WHERE id = :id";
                                $categories = $conn->prepare($categories_prepare);
                                $categories->bindValue(':id', $content_category);
                                $categories->execute();
                                $categoryname = $categories->fetch(PDO::FETCH_ASSOC);
                                $categoryname = $categoryname["name"];
                                ?>
                                <div class="col">
                                    <div class="card"><img class="card-img-top w-100 d-block fit-cover" style="height: 200px;" src="<?= $content_image ?>">
                                        <div class="card-body p-4" style="padding-bottom: 0px;margin-bottom: 0px;">
                                            <p class="text-primary card-text mb-0"><?= $categoryname ?></p>
                                            <h4 class="card-title"><?= $content_title ?></h4>
                                            <p class="card-text"><?= $content_short ?></p>
                                            <div class="d-flex">
                                                <div></div>
                                                <a href="/content/<?= $content_id ?>" class="btn btn-primary" style="margin-right: 0px;margin-top: 0px;margin-left: 40px;"> Devamını Oku</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>



                    </div>
                </div>
                <?php
                // Go to ads.php
                ?>


        <?php
    }
    ?>

<?php
// Go to ads.php
?>