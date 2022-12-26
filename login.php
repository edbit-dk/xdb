<?php

require_once("bootstrap.php");

if(post('csrf')) {

  $auth = User::auth(post('user_name'));

  if($auth) {
  session('user', $auth);
  redirect_to('?page=records');
  } else {
    message('Fejl i loginoplysninger. <br> Prøv igen eller kontakt skolens IT-vejleder.','error');
    redirect_to('?page=login?error=1');
  }

}

?>

<!-- Custom styles for this template -->
<link href="<?php echo WEB_ROOT; ?>/theme/css/signin.css" rel="stylesheet">

<main class="form-signin w-100 m-auto" style="background-color: white; box-shadow: 11px 30px 154px 2px rgb(0 0 0 / 34%); padding: 50px;">
  <form action="login.php" method="POST">
    <h1 class="h3 mb-3 fw-normal"><span style="color: #015ab3; font-size: 30px; font-weight: 600;">Uni</span>login</h1>
    <h5>Elev</h5>
    <p><?php check_message(); ?></p>
    <input type="hidden" name="csrf" value="<?php echo csrf_token(); ?>">
    <div class="form-floating">
      <input type="text" name="user_name" class="form-control" id="floatingInput" autofocus="" autocomplete="off">
      <label for="floatingInput">Brugernavn</label>
    </div>
    <br>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Log ind</button>
    <a href="?page=home">Hjem</a>
  </form>
</main>