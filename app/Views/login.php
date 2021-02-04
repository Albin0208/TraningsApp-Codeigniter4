<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>

<div class="row justify-content-center">

  <div class="col-sm-12 col-lg-6 login_form mt-3 mt-5 pt-3 pb-3 bg-red text-center">
    <h1>Logga in</h1>
    <hr>
    <?php if (session()->get('success')) : ?>
      <div class="alert alert-success col-sm-10 ms-auto me-auto">
        <?= session()->get('success') ?>
      </div>
    <?php endif; ?>
    <form id="login" method="post" class="row justify-content-center" novalidate>
      <div class="col-sm-10">
        <div class="mb-3 input-group">
          <span class="input-group-text">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
              <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z" />
            </svg></span>
          <input type="email" class="form-control <?= isInvalidLogin('email') ? 'is-invalid' : null ?>" name="email" value="<?= set_value('email') ?>" placeholder="Email adress">
          <?= displayError('email') ?>
        </div>
        <div class="row g-2">
          <div class="mb-3 input-group">
            <span class="input-group-text">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
              </svg></span>
            <input type="password" class="form-control <?= isInvalidLogin('password') ? 'is-invalid' : null ?>" name="password" value="" placeholder="Lösenord">
            <?= displayError('password') ?>
          </div>
        </div>
      </div>
      <div class="d-grid gap-2 col-6">
        <button type="submit" class="btn btn-primary-custom rounded-pill btn-lg mt-3 mb-4">Logga in</button>
      </div>
    </form>
    <p>Inte medlem? <a href="/register" class="btn btn-secondary-custom rounded-pill ms-1">Bli medlem</a></p>
  </div>

</div>
<?= $this->endSection() ?>