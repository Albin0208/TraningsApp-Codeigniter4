<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>

<div class="container">

  <div class="login_form mt-3 mt-5 pt-3 pb-3">
    <div class="text-center">
      <h1>Bli medlem</h1>
      <hr>
      <?php if (isset($validation)) : ?>
        <div class="text-warning text-start">
          <?= $validation->listErrors() ?>
        </div>
      <?php endif; ?>

      <form id="signup" method="post" novalidate>
        <div class="col ms-4 me-4">
          <div class="row g-2">
            <div class="mb-3 input-group col">
              <span class="input-group-text">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 14 14">
                  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                </svg></span>
              <input type="text" class="form-control" name="fname" value="" placeholder="Förnamn">
            </div>
            <div class="mb-3 input-group col">
              <span class="input-group-text">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 14 14">
                  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                </svg></span>
              <input type="text" class="form-control" name="lname" value="" placeholder="Efternamn">
            </div>
          </div>
          <div class="mb-3 input-group col">
            <span class="input-group-text">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 14 14">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
              </svg></span>
            <input type="text" class="form-control" name="uname" placeholder="Användarnamn" value="">
          </div>
          <div class="mb-3 input-group">
            <span class="input-group-text">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z" />
              </svg></span>
            <input type="email" class="form-control" name="email" value="" placeholder="Email adress">
          </div>
          <div class="row g-2">
            <div class="mb-3 input-group col">
              <span class="input-group-text">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                  <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
                </svg></span>
              <input type="password" class="form-control" name="password" value="" placeholder="Lösenord">
            </div>
            <div class="mb-3 input-group col">
              <span class="input-group-text">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                  <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
                </svg></span>
              <input type="password" class="form-control" name="confirm_password" value="" placeholder="Bekräfta Lösenord">
            </div>
          </div>
        </div>

        <div class="d-grid gap-2 col-6 mx-auto">
          <button type="submit" class="btn btn-primary btn-lg mt-3 mb-4">Bli medlem</button>
        </div>
      </form>
      <p>Redan medlem? <a href="/login">Logga in</a></p>
    </div>
  </div>

</div>
<?= $this->endSection() ?>