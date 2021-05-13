<?= $this->extend("users/account") ?>
<?= $this->section('userPage') ?>

<?php if (session()->has('success')) : ?>
<div class="alert alert-success" role="alert">
  <?= session()->get('success') ?>
</div>
<?php endif; ?>

<?= form_open(current_url(), 'data-parsley-validate data-parsley-exclude="[type=reset]" id="form_id" novalidate') ?>
<div>
  <div class="row gx-2">
    <div class="form-floating col-sm mt-3">
      <input type="email" class="form-control border-custom overlay1 <?= isInvalid('email') ?>" name="email"
        value="<?= $user['email'] ?? set_value('email') ?>" id="email" placeholder="Email" disabled required>
      <label for="email">Email adress</label>
      <div class="text-danger text-start" id="invalidEmail">
        <?= getError('email') ?>
      </div>
    </div>
  </div>
  <div class="row row-cols-1 row-cols-sm-2 gx-2">
    <div class="col">
      <div class="form-floating mt-3">
        <input type="text" class="form-control border-custom overlay1 <?= isInvalid('firstname') ?>" name="firstname"
          value="<?= $user['firstname'] ?? set_value('firstname') ?>" id="firstname" placeholder="Förnamn"
          data-parsley-pattern="/^[A-Za-zÀ-ÿ]+$/" data-parsley-errors-container="#invalidFirstname"
          data-parsley-trigger="keyup change" required>
        <label for="firstname">Förnamn</label>
        <div class="text-danger text-start" id="invalidFirstname">
          <?= getError('firstname') ?>
        </div>
      </div>
      <div class="form-floating mt-3">
        <input type="text" class="form-control border-custom overlay1 <?= isInvalid('lastname') ?>" name="lastname"
          value="<?= $user['lastname'] ?? set_value('lastname') ?>" id="lastname" placeholder="Efternamn"
          data-parsley-pattern="/^[A-Za-zÀ-ÿ]+$/" data-parsley-errors-container="#invalidLastname"
          data-parsley-trigger="keyup change" required>
        <label for="lastname">Efternamn</label>
        <div class="text-danger text-start" id="invalidLastname">
          <?= getError('lastname') ?>
        </div>
      </div>
      <div class="form-floating mt-3">
        <input type="text" class="form-control border-custom overlay1 <?= isInvalid('username') ?>" name="username"
          value="<?= $user['username'] ?? set_value('username') ?>" placeholder="Användarnamn"
          data-parsley-pattern="/^[A-Za-zÀ-ÿ0-9_]+$/" data-parsley-errors-container="#invalidUsername"
          data-parsley-trigger="keyup change" required>
        <label for="username">Användarnamn</label>
        <div class="text-danger text-start" id="invalidUsername">
          <?= getError('username') ?>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="form-floating mt-3">
        <input type="password"
          class="form-control border-custom overlay1 <?= isInvalidLogin('password') ? 'is-invalid' : null ?>"
          name="current_password" id="current_password" placeholder="Nuvarande Lösenord">
        <label for="current_password">Nuvarande Lösenord</label>
        <div class="text-danger text-start">
          <?= getError('current_password') ?>
        </div>
      </div>
      <div class="form-floating mt-3">
        <input type="password"
          class="form-control border-custom overlay1 <?= isInvalidLogin('password') ? 'is-invalid' : null ?>"
          name="password" id="password" placeholder="Lösenord">
        <label for="password">Lösenord</label>
        <div class="text-danger text-start">
          <?= getError('password') ?>
        </div>
      </div>
      <div class="form-floating mt-3">
        <input type="password"
          class="form-control border-custom overlay1 <?= isInvalidLogin('confirm_password') ? 'is-invalid' : null ?>"
          name="confirm_password" id="confirm_password" placeholder="Lösenord">
        <label for="confirm_password">Bekräfta Lösenord</label>
        <div class="text-danger text-start">
          <?= getError('confirm_password') ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="my-5 ms-auto w-100 d-flex justify-content-around">
  <button type="submit" class="btn btn-outline-success btn-lg rounded-pill">Spara</button>
  <button type="reset" class="btn btn-outline-danger btn-lg rounded-pill">Återställ</button>
</div>
<?= form_close() ?>

<?= $this->endSection() ?>