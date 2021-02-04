<?= $this->extend("userAccount") ?>
<?= $this->section('userPage') ?>

<form class="edit-profile" method="POST">
  <div class="row g-2">
    <div class="mb-3 col-sm h-25">
      <label for="email">
        <h4>Email Adress</h4>
      </label>
      <span class="input-group col-sm-6">
        <span class="input-group-text">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z" />
          </svg></span>
        <input type="email" class="form-control" name="email" value="<?= $user['email'] ?>" readonly placeholder="Email">
      </span>
    </div>
  </div>
  <div class="row">
    <div class="col-sm">
      <div class="mb-3 col-sm h-25">
        <label for="firstname">
          <h4>Förnamn</h4>
        </label>
        <span class="input-group col-sm-6">
          <span class="input-group-text">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 14 14">
              <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
            </svg></span>
          <input type="text" class="form-control <?= isInvalid('firstname') ?>" name="firstname" value="<?= $user['firstname'] ?>" placeholder="Förnamn">
          <?= displayError('firstname') ?>
        </span>
      </div>
      <div class="mb-3 col-sm h-25">
        <label for="lastname">
          <h4>Efternamn</h4>
        </label>
        <span class="input-group col-sm-6">
          <span class="input-group-text">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 14 14">
              <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
            </svg></span>
          <input type="text" class="form-control <?= isInvalid('lastname') ?>" name="lastname" value="<?= $user['lastname'] ?>" placeholder="Efternamn">
          <?= displayError('lastname') ?>
        </span>
      </div>
      <div class="mb-3 col-sm h-25">
        <label for="username">
          <h4>Användarnamn</h4>
        </label>
        <span class="input-group col-sm-6">
          <span class="input-group-text">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 14 14">
              <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
            </svg></span>
          <input type="text" class="form-control <?= isInvalid('username') ?>" name="username" value="<?= $user['username'] ?>" placeholder="Användarnamn">
          <?= displayError('username') ?>
        </span>
      </div>
    </div>
    <div class="col-sm">
      <div class="mb-3 col-sm h-25">
        <label for="current_password">
          <h4>Nuvarande Lösenord</h4>
        </label>
        <span class="input-group col-sm-6">
          <span class="input-group-text">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
              <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
            </svg></span>
          <input type="password" class="form-control <?= isInvalidLogin('current_password') ? 'is-invalid' : null  ?>" name="current_password" placeholder="Nuvarande Lösenord">
          <?= displayError('password') ?>
        </span>
      </div>
      <div class="mb-3 col-sm h-25">
        <label for="password">
          <h4>Nytt Lösenord</h4>
        </label>
        <span class="input-group col-sm-6">
          <span class="input-group-text">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
              <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
            </svg></span>
          <input type="password" class="form-control <?= isInvalidLogin('password') ? 'is-invalid' : null  ?>" name="password" placeholder="Nytt Lösenord">
          <?= displayError('password') ?>
        </span>
      </div>
      <div class="mb-3 col-sm h-25">
        <label for="confirm_password">
          <h4>Bekräfta Lösenord</h4>
        </label>
        <span class="input-group col-sm-6">
          <span class="input-group-text">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
              <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
            </svg></span>
          <input type="passowrd" class="form-control <?= isInvalidLogin('password') ? 'is-invalid' : null  ?>" name="confirm_password" placeholder="Bekräfta Lösenord">
          <?= displayError('confirm_password') ?>
        </span>
      </div>
    </div>
  </div>
  <div class="d-grid gap-2 col-6 mx-auto">
    <button type="submit" class="btn btn-primary-custom rounded-pill btn-lg mt-3 mb-4">Spara</button>
  </div>
</form>

<?= $this->endSection() ?>