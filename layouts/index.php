<title>Anasayfa - <?=$First_Inforesult["name"]; ?></title>
<?php
$content_check=$conn->query('SELECT * FROM contents ORDER BY ID DESC LIMIT 15');
?>
<body>
<div class="container">
    <div class="row" style="padding-bottom: 0px;margin-bottom: 59px;">
        <div class="col-md-8" style="margin-top: 10px;">
            <h3 style="margin-bottom: 20px;">Son Yazılan İçerikler</h3>
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