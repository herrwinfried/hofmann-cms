<?php
$rank = $First_rankresult["rank"];

$sqlkont = "SELECT * FROM ranks WHERE id = :id";
$rankchk = $conn->prepare($sqlkont);
$rankchk->bindValue(':id', $rank);
$rankchk->execute();
$rankresult = $rankchk->fetch(PDO::FETCH_ASSOC);

$allowperm = $rankresult["CATEGORIES_LIST"];

if ($allowperm != 1 && $rankresult["ADMIN"] != 1) {
    header("Location: ../../index?failrank");
}
?>

<?php
$page   = @ceil($_GET['page']);
if ($page < 1) { $page = 1;}
$Say   = $conn->query("select * from categories order by id DESC");
$AllResult   = $Say->rowCount();
$Limit	= 10;
$page_Sayisi	= ceil($AllResult/$Limit);
if($page > $page_Sayisi){$page = $page_Sayisi;}
$Goster   = $page * $Limit - $Limit;
$visiblepage   = 100;
if ($AllResult < 1) {
    $check_data	= $conn->query("select * from categories order by id DESC");
}
else {
    $check_data	= $conn->query("select * from categories order by id DESC limit $Goster,$Limit");
}$ranks = $check_data->fetchAll(PDO::FETCH_OBJ);
$q = $conn->prepare("DESCRIBE categories");
$q->execute();
$describe = $q->fetchAll(PDO::FETCH_COLUMN);
?>

<body>
<div class="container-fluid">
    <br>
    <div class="btn-group">
        <a href="./create/categories.php" class="btn btn-outline-primary btn-sm disabled">Kategori Oluştur</a>
    </div>
    <div class="btn-group">
        <a href="./contents.php" class="btn btn-outline-primary btn-sm">İçerikleri Görüntüle</a>
    </div>
    <br> <br>

    <div class="row justify-content-center">
        <div class="col">
            <table class="table table-bordered table-striped table-sm table-responsive text-center">
                <tr>
                    <?php
                    foreach ($describe as $d) {
                        ?>
                        <td><?= $d ?></td>
                    <?php
                    }
                    ?>
                    <td hidden="hidden">Eylemler</td>

                </tr>


                <?php
                foreach($ranks as $rank) {
                    foreach ($describe as $d) {
                        ?>
                        <td><?= $rank->$d; ?></td>
                        <?php
                    }
                    ?>
                        <td hidden="hidden">
                            <a href="./update/categories.php?pid=<?= $rank-> id ?>" class="btn btn-outline-warning disabled" >Güncelle</a>
                            <a href="./delete/categories.php?pid=<?= $rank-> id ?>" class="btn btn-outline-danger disabled">Sil</a>

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

