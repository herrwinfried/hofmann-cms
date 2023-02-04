<?php
if (isset($_SESSION['account'])) {
    if ($_SESSION['account'] = "active") {
        header('Location:./index.php');
    }
}
?>
<?php
    if(isset($_POST['submit'])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $rank = "1";
        $ip_address=$_SERVER["REMOTE_ADDR"];

    $sqlkont = "SELECT * FROM users WHERE username = :username";
    $rankchk = $conn->prepare($sqlkont);
    $rankchk->bindValue(':username', $username);
    $rankchk->execute();
    $Sec_rankresult = $rankchk->fetch(PDO::FETCH_ASSOC);

    $sqlkont = "SELECT * FROM users WHERE email = :email";
    $rankchk = $conn->prepare($sqlkont);
    $rankchk->bindValue(':email', $email);
    $rankchk->execute();
    $Sec_mailresult = $rankchk->fetch(PDO::FETCH_ASSOC);

    if ($Sec_rankresult) {
    ?>
    <div class="alert alert-danger text-white" role="alert">
        <b> <?= $username ?> </b> adında kullanıcı hesabı zaten var.
    </div>
<?php
}
elseif ($Sec_mailresult) {
        ?>
    <div class="alert alert-danger text-white" role="alert">
        <b> <?= $email ?> </b> eposta adresli kullanıcı hesabı zaten var.
    </div>
<?php
    }
    else {

    $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));

    $stmt = $conn->prepare("INSERT INTO users (username, email, password, rank, ip_address) VALUES(?,?,?,?,?)");
    $stmt->bindParam(1, $username, PDO::PARAM_STR);
    $stmt->bindParam(2, $email, PDO::PARAM_STR);
    $stmt->bindParam(3, $passwordHash, PDO::PARAM_STR);
    $stmt->bindParam(4, $rank, PDO::PARAM_STR);
    $stmt->bindParam(5, $ip_address, PDO::PARAM_STR);
    $stmt->execute();
    ?>
    <div class="alert alert-success text-white" role="alert">
        <b> <?= $username ?> </b> adında kullanıcı hesabı açılmıştır. <a href="/login.php">Giriş yapmak için tıklayın.</a>
    </div>
    <?php
}
}
?>
<title>Kayıt Ol - <?= $First_Inforesult["name"]; ?></title>

<link href="/assets/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>


    <!-- Custom styles for this template -->
    <link href="/assets/css/sign-in.css" rel="stylesheet">
  </head>
  <body class="text-center">

<main class="form-signin w-100 m-auto">
    <form method="post" action="./register.php">
    <img class="mb-4" src="<?= $First_Inforesult["favicon"] ?>" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Kayıt Ol</h1>

    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" placeholder="root" name="username" id="username" required>
      <label for="floatingInput">Kullanıcı Adınız</label>
    </div>
        <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" placeholder="root" name="email" id="email" required>
            <label for="floatingInput">E-posta</label>
        </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Parola"  name="password" id="password" required>
      <label for="floatingPassword">Parola</label>
    </div>

    <div class="checkbox mb-3">

    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit" id="submit">Giriş Yap</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2023 Tüm telif hakkı saklıdır.</p>
  </form>
</main>



  </body>
</html>
