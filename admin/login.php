<?php

require_once("../bootstrap.php");

if(post('csrf')) {

  $auth = User::auth(post('username'), post('password'), 1);

  if($auth) {
  session('user', $auth);
  redirect_to('/admin/?page=home');
  } else {
    message('Fejl i loginoplysninger. <br> Prøv igen eller kontakt skolens IT-vejleder.','error');
    redirect_to('/admin/?page=login?error=1');
  }

}

?>

<!-- Custom styles for this template -->
<link href="<?php echo url('/assets/theme/css/signin.css') ?>" rel="stylesheet">

<main class="form-signin w-100 m-auto" style="background-color: white; box-shadow: 11px 30px 154px 2px rgb(0 0 0 / 34%); padding: 50px;">
  <form action="login.php" method="POST">
    <h1 class="h3 mb-3 fw-normal"><span style="color: #015ab3; font-size: 30px; font-weight: 600;">X</span>DB</h1>
    <h5>Medarbejder</h5>
    <?php check_messages(); ?>
    <input type="hidden" name="csrf" value="<?php echo csrf_token(); ?>">
    <div class="form-floating">
      <input type="text" name="username" class="form-control" id="floatingInput" autofocus="" autocomplete="off">
      <label for="floatingInput">Brugernavn</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword" autocomplete="off">
      <label for="floatingPassword">Adgangskode</label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Log ind</button>
    <br><br>
    <a style="color: #015ab3; font-size: 20px; font-weight: 600;" href="../">Tilbage</a>
  </form>
</main>