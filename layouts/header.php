<!DOCTYPE html>
<html lang="tr" >
<?php
$sqlkont = "SELECT * FROM config WHERE id = :id";
$infochk = $conn->prepare($sqlkont);
$infochk->bindValue(':id', "1");
$infochk->execute();
$First_Inforesult = $infochk->fetch(PDO::FETCH_ASSOC);
?>

<head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if ($First_Inforesult["favicon_isEnabled"]) {
    ?>
        <link rel="icon" type="image/x-icon" href="<?= $First_Inforesult["favicon"] ?>">
        <?php
    }
    ?>
    <?php
    if ($First_Inforesult["desc_isEnabled"]) {
        ?>
        <meta name="description" content="<?= $First_Inforesult["description"] ?>">
    <?php
    }
    ?>
        <meta name="author" content="Winfried">
        <!-- https://github.com/herrwinfried -->

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

        <link rel="stylesheet" href="/assets/css/Articles-Cards-images.css">
        <link rel="stylesheet" href="/assets/css/Footer-Dark-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</head>
<style>
    /* width */
    ::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>

