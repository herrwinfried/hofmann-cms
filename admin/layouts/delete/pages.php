<br>
<?php
$rank = $First_rankresult["rank"];

$sqlkont = "SELECT * FROM ranks WHERE id = :id";
$rankchk = $conn->prepare($sqlkont);
$rankchk->bindValue(':id', $rank);
$rankchk->execute();
$rankresult = $rankchk->fetch(PDO::FETCH_ASSOC);

$allowperm = $rankresult["PAGES_REMOVE"];

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
        header("Location: /admin/users?error=invalidid");
    }
} else {
    header("Location: /admin/users?error=invalidlink");
}

?>
<?php
$check_data=$conn->prepare('DELETE FROM pages WHERE ID=?');
$check_data=$check_data->execute([$_GET['pid']]);
header("Location: /admin/pages.php?successful=deletepages");

?>
