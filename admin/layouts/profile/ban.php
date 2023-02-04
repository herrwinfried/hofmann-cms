<br>
<?php
$rank = $First_rankresult["rank"];

$sqlkont = "SELECT * FROM ranks WHERE id = :id";
$rankchk = $conn->prepare($sqlkont);
$rankchk->bindValue(':id', $rank);
$rankchk->execute();
$rankresult = $rankchk->fetch(PDO::FETCH_ASSOC);

$allowperm = $rankresult["USER_BAN"];

if ($allowperm != 1 && $rankresult["ADMIN"] != 1) {
    header("Location: ../../index?failrank");
}
?>


<?php

if(isset($_GET["pid"]))
{
    $check_data=$conn->prepare('SELECT id, username, email, rank, ban FROM users WHERE id = :id');
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
$user_ban = $UserInfo["ban"];
if ($rank < $user_rank || $rank == $user_rank || $user_id == $First_rankresult["id"]) {
    header("Location: /admin/users?error=insufficientperm");
} else {
?>

<?php

$check_data=$conn->prepare('UPDATE users SET ban = :bool WHERE id = :id');
if ($user_ban == 1) {
    $check_data->bindValue(':bool', "0");
    header("Location: /admin/users?successful=unban");
} else {
    $check_data->bindValue(':bool', "1");
    header("Location: /admin/users?successful=ban");
}
$check_data->bindValue(':id', $_GET["pid"]);
$check_data->execute();
}

?>


