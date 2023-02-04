<?php
$rank = $First_rankresult["rank"];

$sqlkont = "SELECT * FROM ranks WHERE id = :id";
$rankchk = $conn->prepare($sqlkont);
$rankchk->bindValue(':id', $rank);
$rankchk->execute();
$rankresult = $rankchk->fetch(PDO::FETCH_ASSOC);

$allowperm = $rankresult["CONTENTS_LIST"];

if ($allowperm != 1 && $rankresult["ADMIN"] != 1) {
   header("Location: ../../index?failrank");
}
?>

<?php
$page   = @ceil($_GET['page']);
if ($page < 1) { $page = 1;}
$Say   = $conn->query("select * from contents order by id DESC");
$AllResult   = $Say->rowCount();
$Limit	= 10;
$page_Sayisi	= ceil($AllResult/$Limit);
if($page > $page_Sayisi){$page = $page_Sayisi;}
$Goster   = $page * $Limit - $Limit;
$visiblepage   = 100;
if ($AllResult < 1) {
	$check_data	= $conn->query("select * from contents order by id DESC");
}
else {
	$check_data	= $conn->query("select * from contents order by id DESC limit $Goster,$Limit");
}
$contents = $check_data->fetchAll(PDO::FETCH_OBJ);
?>
<body>
<div class="container-fluid">
    <br>
    <div class="btn-group">
        <a href="./create/contents" class="btn btn-outline-primary btn-sm">İçerik Oluştur</a>
    </div>
    <div class="btn-group">
        <a href="./categories" class="btn btn-outline-primary btn-sm">Kategorileri Görüntüle</a>
    </div>
    <br> <br>

    <div class="row justify-content-center">
        <div class="col">
            <table class="table table-bordered table-striped table-sm table-responsive text-center">
                <tr>
                    <td>ID</td>
                    <td>Başlık</td>
                   <td>Kısa açıklama</td>
                    <td>Yazar</td>
                    <td>Kategori</td>
                    <td>Oluşturulma zamanı</td>
                    <td>Eylemler</td>
                </tr>

                <?php
                foreach($contents as $content) {
                    $categories_prepare = "SELECT id, name FROM categories WHERE id = :id";
                    $categories = $conn->prepare($categories_prepare);
                    $categories->bindValue(':id', $content->category);
                    $categories->execute();
                    $categoryname = $categories->fetch(PDO::FETCH_ASSOC);

                    $author_prepare = "SELECT id, username FROM users WHERE id = :id";
                    $author = $conn->prepare($author_prepare);
                    $author->bindValue(':id', $content->author);
                    $author->execute();
                    $authorname = $author->fetch(PDO::FETCH_ASSOC);

                    if ($authorname["username"]) {
                        $authorname = $authorname["username"];
                    } else {
                        $authorname = "BILINMIYOR...";
                    }
                    ?>
                    <tr>
                        <td><?= $content->id ?></td>
                        <td><?= $content->title ?></td>
                    <td><?= $content->short ?></td>
                        <td><?= $authorname ?></td>
                        <td><?= $categoryname["name"] ?></td>
                        <td><?= $content->time ?></td>
                        <td>
                            <a href="./update/contents.php?pid=<?= $content->id ?>" class="btn btn-outline-warning">Güncelle</a>
                            <a href="./delete/contents.php?pid=<?= $content->id ?>" class="btn btn-outline-danger">Sil</a>
                        </td>

                    </tr>
                <?php }?>

            </table>
        </div>
    </div>
</div>
</div>
<?php
?>

<nav>
    <div class="container-fluid gap-0">
    <ul class="pagination">
        <?php if($page > 1){?>
            <li class="page-item bg-dark">
                <a class="page-link bg-dark" href="?page=<?=$page - 1?>" aria-label="Önceki">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

        <?php } ?>

        <?php

        for($i = $page - $visiblepage; $i < $page + $visiblepage +1; $i++){


            if($i > 0 and $i <= $page_Sayisi){

                if($i == $page){
                    ?>
                    <li class="page-item active bg-dark" aria-current="page">
                        <a class="page-link bg-dark" href="#"><?=$i ?></a>
                    </li>
                    <?php

                }else{
                    ?>
                    <li class="page-item bg-dark"><a class="page-link bg-dark" href="?page=<?=$i?>"> <?= $i ?> </a></li>
                    <?php
                }

            }

        }
        ?>
        <?php if($page != $page_Sayisi){?>
            <li class="page-item bg-dark">
                <a class="page-link bg-dark" href="?page=<?=$page + 1?>" aria-label="Sonraki">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <?php } ?>
    </ul>
    </div>
</nav>

</body>
<div class="bg-dark">
</div>
</html>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</div>

