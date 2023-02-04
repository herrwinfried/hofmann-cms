<?php
if (isset($_SESSION['account'])) {
    if ($_SESSION['account'] = "active") {
        header('Location:./index.php');
    }
}
if(isset($_POST['submit'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT id, username, password FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user === false){
        header("Location: ./login?message=failedlogin");
    } else{
        $validPassword = password_verify($password, $user['password']);
        if($validPassword){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['logged_in'] = time();
            $_SESSION['account'] = "active";
            $date_date = date("Y-m-d H:i:s");
            $update_data = $conn->prepare("UPDATE users SET lastlogin = ? WHERE ID = ?");
            $update_data->bindParam(1, $date_date, PDO::PARAM_STR);
            $update_data->bindParam(2, $user['id'], PDO::PARAM_STR);
            $update_data->execute();
            return header('Location:./index.php');
            exit;
        }else{
            return header("Location:./login?message=failedlogin");
            exit;
        }
    }
}
?>
<title>Giriş Yap - <?= $First_Inforesult["name"]; ?></title>

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
    <form method="post" action="./login.php">
    <img class="mb-4" src="<?= $First_Inforesult["favicon"] ?>" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Lütfen giriş yap</h1>

    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" placeholder="root" name="username" id="username" required>
      <label for="floatingInput">Kullanıcı Adınız</label>
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
