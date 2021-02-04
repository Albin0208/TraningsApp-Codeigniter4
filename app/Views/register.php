<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>

<div class="row justify-content-center">


  <div class="col-sm-12 col-lg-6 login_form mt-3 mt-5 pt-3 pb-3 bg-red text-center">
    <h1>Bli medlem</h1>
    <hr>
    <form id="signup" method="post" novalidate>
      <div class="col-md">
        <div class="row g-1">
          <div class="mb-3 input-group col-sm h-25">
            <span class="input-group-text">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 14 14">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
              </svg></span>
            <input type="text" class="form-control <?= isInvalid('firstname') ?>" name="firstname" value="<?= set_value('firstname') ?>" placeholder="Förnamn">
            <?= displayError('firstname') ?>
          </div>
          <div class="mb-3 input-group col-sm h-25">
            <span class="input-group-text">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 14 14">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
              </svg></span>
            <input type="text" class="form-control <?= isInvalid('lastname') ?>" name="lastname" value="<?= set_value('lastname') ?>" placeholder="Efternamn">
            <?= displayError('lastname') ?>
          </div>
        </div>
        <div class="mb-3 input-group col h-25">
          <span class="input-group-text">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 14 14">
              <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
            </svg></span>
          <input type="text" class="form-control <?= isInvalid('username') ?>" name="username" value="<?= set_value('username') ?>" placeholder="Användarnamn">
          <?= displayError('username') ?>
        </div>
        <div class="mb-3 input-group h-25">
          <span class="input-group-text">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
              <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z" />
            </svg></span>
          <input type="email" class="form-control <?= isInvalid('email') ?>" name="email" value="<?= set_value('email') ?>" placeholder="Email adress">
          <?= displayError('email') ?>
        </div>
        <div class="row g-1">
          <div class="mb-3 input-group col-ms col-lg h-25">
            <span class="input-group-text">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
              </svg></span>
            <input type="password" class="form-control <?= isInvalidLogin('password') ? 'is-invalid' : null  ?>" name="password" value="" placeholder="Lösenord">
            <?= displayError('password') ?>
          </div>
          <div class="mb-3 input-group col-ms col-lg h-25">
            <span class="input-group-text">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
              </svg></span>
            <input type="password" class="form-control <?= isInvalidLogin('confirm_password') ? 'is-invalid' : null ?>" name="confirm_password" value="" placeholder="Bekräfta Lösenord">
            <?= displayError('confirm_password') ?>
          </div>
        </div>
      </div>
      <div class="d-grid gap-2 col-6 mx-auto">
        <button type="submit" class="btn btn-primary-custom rounded-pill btn-lg mt-3 mb-4">Bli medlem</button>
      </div>
    </form>
    <p class="text-white">Redan medlem? <a href="/login" class="btn btn-secondary-custom rounded-pill ms-1">Logga in</a></p>
  </div>
</div>

<?= $this->endSection() ?>