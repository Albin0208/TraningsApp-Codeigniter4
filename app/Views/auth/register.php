<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>

<div class="card text-center mt-4 col-sm-12 col-lg-6 mx-auto bg-dark shadow rounded text-white">
  <div class="card-body">
    <h1 class="card-title">Bli medlem</h1>
    <hr>
    <?php if (session()->has('error')) : ?>
    <div class="alert alert-danger col-sm-10 ms-auto me-auto">
      <?= session()->get('error') ?>
    </div>
    <?php endif; ?>
    <?= form_open(base_url('/register'), 'data-parsley-validate') ?>
    <div class="col-md">
      <div class="row gx-2 mt-3">
        <div class="form-floating col-sm">
          <input type="text" class="form-control border-custom overlay1 <?= isInvalid('firstname') ?>" name="firstname"
            value="<?= set_value('firstname') ?>" id="firstname" placeholder="Förnamn"
            data-parsley-pattern="/^[A-Za-zÀ-ÿ]+$/" data-parsley-errors-container="#invalidFirstname"
            data-parsley-trigger="keyup change" required>
          <label for="firstname">Förnamn</label>
          <div class="text-danger text-start" id="invalidFirstname">
            <?= getError('firstname') ?>
          </div>
        </div>
        <div class="form-floating col-sm">
          <input type="text" class="form-control border-custom overlay1 <?= isInvalid('lastname') ?>" name="lastname"
            value="<?= set_value('lastname') ?>" placeholder="Efternamn" data-parsley-pattern="^[A-Za-zÀ-ÿ]+$"
            data-parsley-errors-container="#invalidLastname" data-parsley-trigger="keyup" required>
          <label for="lastname">Efternamn</label>
          <div class="text-danger text-start" id="invalidLastname">
            <?= getError('lastname') ?>
          </div>
        </div>
      </div>
      <div class="row gx-2 mt-3">
        <div class="form-floating">
          <input type="email" class="form-control border-custom overlay1 <?= isInvalid('email') ?>" name="email"
            value="<?= set_value('email') ?>" placeholder="Email" data-parsley-errors-container="#invalidEmail"
            data-parsley-trigger="keyup" required>
          <label for="email">Email adress</label>
          <div class="text-danger text-start" id="invalidEmail">
            <?= getError('email') ?>
          </div>
        </div>
      </div>
      <div class="row gx-2 mt-3">
        <div class="form-floating">
          <input type="text" class="form-control border-custom overlay1 <?= isInvalid('username') ?>" name="username"
            value="<?= set_value('username') ?>" placeholder="Användarnamn" data-parsley-pattern="/^[A-Za-zÀ-ÿ0-9_]+$/"
            data-parsley-errors-container="#invalidUsername" data-parsley-trigger="keyup" required>
          <label for="username">Användarnamn</label>
          <div class="text-danger text-start" id="invalidUsername">
            <?= getError('username') ?>
          </div>
        </div>
      </div>
      <div class="row gx-2 mt-3">
        <div class="form-floating col-sm">
          <input type="password"
            class="form-control border-custom overlay1 <?= isInvalidLogin('password') ? 'is-invalid' : null ?>"
            name="password" id="password" minlength="6" placeholder="Lösenord"
            data-parsley-errors-container="#invalidPassword" data-parsley-trigger="keyup" required>
          <label for="password">Lösenord</label>
          <div class="text-danger text-start" id="invalidPassword">
            <?= getError('password') ?>
          </div>
        </div>
        <div class="form-floating col-sm">
          <input type="password"
            class="form-control border-custom overlay1 <?= isInvalidLogin('confirm_password') ? 'is-invalid' : null ?>"
            name="confirm_password" id="confirm_password" placeholder="Lösenord" data-parsley-equalto="#password"
            data-parsley-errors-container="#invalidConfirmPassword" data-parsley-trigger="keyup" required>
          <label for="confirm_password">Bekräfta Lösenord</label>
          <div class="text-danger text-start" id="invalidConfirmPassword">
            <?= getError('confirm_password') ?>
          </div>
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-outline-info btn-lg rounded-pill w-50 mt-5 mb-3">Bli medlem</button>
    <?= form_close() ?>
    <p>Redan medlem? <a href="/login" class="btn btn-outline-success rounded-pill ms-1">Logga in</a></p>
  </div>
</div>

<?= $this->endSection() ?>