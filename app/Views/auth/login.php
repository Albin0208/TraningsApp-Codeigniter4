<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>

<div class="card text-center mt-5 col-sm-12 col-lg-6 mx-auto bg-dark shadow rounded text-white">
  <div class="card-body">
    <h1 class="card-title">Logga in</h1>
    <hr>
    <?php if (session()->has('success')) : ?>
    <div class="alert alert-success col-sm-10 ms-auto me-auto">
      <?= session()->get('success') ?>
    </div>
    <?php endif; ?>
    <?= form_open(base_url('/login')) ?>
    <div class="mb-3 input-group input-group-lg">
      <span class="input-group-text ms-auto bg-dark border-custom border-end-0">
        <i class="bi bi-envelope-fill text-white"></i>
      </span>
      <div class="form-floating w-75 me-auto">
        <input type="email"
          class="form-control rounded-0 border-custom rounded-end overlay1 border-start-0 <?= isInvalidLogin('email') ? 'is-invalid' : null ?>"
          name="email" value="<?= set_value('email') ?>" placeholder="name@example.com">
        <label for="email">Email adress</label>
      </div>
    </div>
    <div class="mb-3 input-group input-group-lg">
      <span class="input-group-text ms-auto bg-dark border-custom border-end-0">
        <i class="bi bi-lock-fill text-white"></i>
      </span>
      <div class="form-floating w-75 me-auto">
        <input type="password"
          class="form-control rounded-0 border-custom rounded-end overlay1 border-start-0 <?= isInvalidLogin('password') ? 'is-invalid' : null ?>"
          name="password" placeholder="Lösenord">
        <label for="password">Lösenord</label>
      </div>
    </div>
    <?php if (isset($validation)) : ?>
    <div class="alert alert-danger col-10 mx-auto">
      Användaren finns inte
    </div>
    <?php endif; ?>
    <button type="submit" class="btn btn-outline-info btn-lg rounded-pill w-50 my-3">Logga in</button>
    <?= form_close() ?>
    <p>Inte medlem? <a href="/register" class="btn btn-outline-success rounded-pill ms-1">Bli medlem</a></p>
  </div>
</div>

<?= $this->endSection() ?>