<?= $this->extend("userAccount") ?>
<?= $this->section('userPage') ?>

<?php if (session()->get('success')) : ?>
  <div class="alert alert-success" role="alert">
    <?= session()->get('success') ?>
  </div>
<?php endif; ?>
<script src="assets/js/main.js"></script>

<form method="post" class="text-white text-center" novalidate>
  <div class="col-md">
    <div class="row">
      <div class="mt-3 input-group flex-nowrap input-group-lg">
        <span class="input-group-text bg-dark border-custom border-end-0">
          <i class="bi bi-envelope-fill text-white"></i>
        </span>
        <div class="form-floating w-100">
          <input type="email" class="form-control rounded-0 border-custom rounded-end overlay1 border-start-0 <?= isInvalid('email') ?>" name="email" value="<?= $user['email'] ?>" disabled placeholder="Email" required>
          <label for="email">Email adress</label>
        </div>
      </div>
      <?= displayError('email') ?>
    </div>
    <div class="row gx-2">
      <div class="col-sm">
        <div class="mt-3 col-sm">
          <div class=" input-group flex-nowrap input-group-lg">
            <span class="input-group-text bg-dark border-custom border-end-0">
              <i class="bi bi-person-fill text-white"></i>
            </span>
            <div class="form-floating w-100 me-auto">
              <input type="text" class="form-control rounded-0 border-custom rounded-end overlay1 border-start-0 <?= isInvalid('firstname') ?>" name="firstname" value="<?= $user['firstname'] ?>" id="firstname" placeholder="Förnamn" required>
              <label for="firstname">Förnamn</label>
            </div>
          </div>
          <?= displayError('firstname') ?>
        </div>
        <div class="mt-3  col-sm">
          <div class="input-group flex-nowrap input-group-lg">
            <span class="input-group-text bg-dark border-custom border-end-0">
              <i class="bi bi-person-fill text-white"></i>
            </span>
            <div class="form-floating w-100">
              <input type="text" class="form-control rounded-0 border-custom rounded-end overlay1 border-start-0 <?= isInvalid('lastname') ?>" name="lastname" value="<?= $user['lastname'] ?>" placeholder="Efternamn" required>
              <label for="lastname">Efternamn</label>
            </div>
          </div>
          <?= displayError('lastname') ?>
        </div>
        <div class="mt-3 col-sm">
          <div class="input-group flex-nowrap input-group-lg">
            <span class="input-group-text bg-dark border-custom border-end-0">
              <i class="bi bi-person-fill text-white"></i>
            </span>
            <div class="form-floating w-100">
              <input type="text" class="form-control rounded-0 border-custom rounded-end overlay1 border-start-0 <?= isInvalid('username') ?>" name="username" value="<?= $user['username'] ?>" placeholder="Användarnamn" required>
              <label for="username">Användarnamn</label>
            </div>
          </div>
          <?= displayError('username') ?>
        </div>
      </div>
      <div class="col-sm">
        <div class="mt-3 col-sm">
          <div class=" input-group flex-nowrap input-group-lg">
            <span class="input-group-text bg-dark border-custom border-end-0">
              <i class="bi bi-lock-fill text-white"></i>
            </span>
            <div class="form-floating w-100 me-auto">
              <input type="password" class="form-control rounded-0 border-custom rounded-end overlay1 border-start-0 <?= isInvalidLogin('current_password') ? 'is-invalid' : null ?>" name="current_password" placeholder="Lösenord" required>
              <label for="current_password">Nuvarande Lösenord</label>
            </div>
          </div>
          <?= displayError('current_password') ?>
        </div>
        <div class="mt-3 col-sm">
          <div class=" input-group flex-nowrap input-group-lg">
            <span class="input-group-text bg-dark border-custom border-end-0">
              <i class="bi bi-lock-fill text-white"></i>
            </span>
            <div class="form-floating w-100 me-auto">
              <input type="password" class="form-control rounded-0 border-custom rounded-end overlay1 border-start-0 <?= isInvalidLogin('password') ? 'is-invalid' : null ?>" name="password" placeholder="Lösenord" required>
              <label for="password">Lösenord</label>
            </div>
          </div>
          <?= displayError('password') ?>
        </div>
        <div class="mt-3 col-sm">
          <div class=" input-group flex-nowrap input-group-lg">
            <span class="input-group-text bg-dark border-custom border-end-0">
              <i class="bi bi-lock-fill text-white"></i>
            </span>
            <div class="form-floating w-100 me-auto">
              <input type="password" class="form-control rounded-0 border-custom rounded-end overlay1 border-start-0 <?= isInvalidLogin('confirm_password') ? 'is-invalid' : null ?>" name="confirm_password" placeholder="Lösenord" required>
              <label for="confirm_password">Bekräfta Lösenord</label>
            </div>
          </div>
          <?= displayError('confirm_password') ?>
        </div>
      </div>
    </div>
  </div>
  <div class="my-5 ms-auto w-100 d-flex justify-content-around">
    <button type="submit" class="btn btn-outline-success btn-lg rounded-pill w-25">Spara</button>
    <button type="reset" class="btn btn-outline-danger rounded-pill w-25">Återställ</button>
  </div>
</form>


<script>
  var forms = document.querySelectorAll('.needs-validation');

  Array.prototype.slice.call(forms).forEach(function(form) {
    form.addEventListener('submit', function(event) {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation();
      }

      form.classList.add('was-validated');
    }, false);
  });
</script>
<?= $this->endSection() ?>