<br>
<?php
$rank = $First_rankresult["rank"];

$sqlkont = "SELECT * FROM ranks WHERE id = :id";
$rankchk = $conn->prepare($sqlkont);
$rankchk->bindValue(':id', $rank);
$rankchk->execute();
$rankresult = $rankchk->fetch(PDO::FETCH_ASSOC);

$allowperm = $rankresult["USER_REMOVE"];

if ($allowperm != 1 && $rankresult["ADMIN"] != 1) {
    header("Location: ../../index?failrank");
}
?>


<?php

if(isset($_GET["pid"]))
{
    $check_data=$conn->prepare('SELECT id, username, email, rank FROM users WHERE id = :id');
    $check_data->bindValue(':id', $_GET["pid"]);
    $check_data->execute();
    $UserInfo = $check_data->fetch(PDO::FETCH_ASSOC);
    if ($UserInfo == false) {
        header("Location: /admin/users?error=invalidid");
    }
} else {
    header("Location: /admin/users?error=invalidlink");
}

$user_id = $UserInfo["id"];
$user_rank = $UserInfo["rank"];
if ($rankresult["ADMIN"] == 0 && $rank < $user_rank) {
    header("Location: /admin/users?error=insufficientperm");
}
elseif ($rankresult["ADMIN"] == 0 && $rank == $user_rank) {
    header("Location: /admin/users?error=insufficientperm");
}
elseif ($rankresult["ADMIN"] == 0 && $user_id == $First_rankresult["id"]) {
    header("Location: /admin/users?error=insufficientperm");
}
elseif ($rankresult["ADMIN"] == 1 && $user_id == $First_rankresult["id"]) {
    header("Location: /admin/users?error=insufficientperm");
}
else {
?>
<?php
$check_data=$conn->prepare('DELETE FROM users WHERE ID=?');
$check_data=$check_data->execute([$_GET['pid']]);
header("Location: /admin/users.php?successful=deleteusers");
}
?>
