<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>

<div class="card text-center mt-5 col-sm-12 col-lg-6 mx-auto bg-dark shadow rounded text-white">
  <div class="card-body">
    <h1 class="card-title">Bli medlem</h1>
    <hr>
    <form method="post" novalidate>
      <div class="col-md">
        <div class="row gx-2">
          <div class="mt-3 col-sm">
            <div class=" input-group flex-nowrap input-group-lg">
              <span class="input-group-text bg-dark border-custom border-end-0">
                <i class="bi bi-person-fill text-white"></i>
              </span>
              <div class="form-floating w-100 me-auto">
                <input type="text" class="form-control rounded-0 border-custom rounded-end overlay1 border-start-0 <?= isInvalid('firstname') ?>" name="firstname" value="<?= set_value('firstname') ?>" id="firstname" placeholder="Förnamn" required>
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
                <input type="text" class="form-control rounded-0 border-custom rounded-end overlay1 border-start-0 <?= isInvalid('lastname') ?>" name="lastname" value="<?= set_value('lastname') ?>" placeholder="Efternamn" required>
                <label for="lastname">Efternamn</label>
              </div>
            </div>
            <?= displayError('lastname') ?>
          </div>
        </div>
        <div class="row">
          <div class="mt-3 input-group flex-nowrap input-group-lg">
            <span class="input-group-text bg-dark border-custom border-end-0">
              <i class="bi bi-envelope-fill text-white"></i>
            </span>
            <div class="form-floating w-100">
              <input type="email" class="form-control rounded-0 border-custom rounded-end overlay1 border-start-0 <?= isInvalid('email') ?>" name="email" value="<?= set_value('email') ?>" placeholder="Email" required>
              <label for="email">Email adress</label>
            </div>
          </div>
          <?= displayError('email') ?>
        </div>
        <div class="row">
          <div class="mt-3 input-group flex-nowrap input-group-lg">
            <span class="input-group-text bg-dark border-custom border-end-0">
              <i class="bi bi-person-fill text-white"></i>
            </span>
            <div class="form-floating w-100">
              <input type="text" class="form-control rounded-0 border-custom rounded-end overlay1 border-start-0 <?= isInvalid('username') ?>" name="username" value="<?= set_value('username') ?>" placeholder="Användarnamn" required>
              <label for="username">Användarnamn</label>
            </div>
          </div>
          <?= displayError('username') ?>
        </div>
        <div class="row gx-2">
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
      <button type="submit" class="btn btn-outline-info btn-lg rounded-pill w-50 my-3">Bli medlem</button>
    </form>
    <p>Redan medlem? <a href="/login" class="btn btn-outline-success rounded-pill ms-1">Logga in</a></p>
  </div>
</div>

<?= $this->endSection() ?>