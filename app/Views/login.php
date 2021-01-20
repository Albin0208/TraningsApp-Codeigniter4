<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>

<div class="col-12 col-sm-8 offset-sm-2 col-md-6 mt-3 offset-md-3 mt-5 pt-3 pb-3 login_form rounded-4">
  <div class="container">
    <div class="row">
      <ul class="tab-group">
        <li class="tab active"><a href="#login">Logga in</a></li>
        <li class="tab"><a href="#signup">Bli medlem</a></li>
      </ul>
    </div>
    <hr>
    <?php if (isset($validation)) : ?>
      <div class="text-warning">
        <?= $validation->listErrors() ?>
      </div>
    <?php endif; ?>

    <form id="login" method="post" novalidate>
      <div class="mb-3 input-group">
        <span class="input-group-text">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z" />
          </svg>
        </span>
        <input type="email" class="form-control" name="email" value="" placeholder="Email adress">
      </div>
      <div class="mb-3 input-group">
        <span class="input-group-text">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
          </svg>
        </span>
        <input type="password" class="form-control" name="password" value="" placeholder="Lösenord">
      </div>

      <div class="d-grid gap-2 col-6 mx-auto">
        <button type="button" onclick="submitForm('login')" class="btn btn-primary btn-lg mt-3 mb-4">Logga in</button>
      </div>
    </form>

    <form id="signup" method="post">
      <div class="row">
        <div class="col">
          <div class="mb-3 input-group">
            <span class="input-group-text">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
              </svg>
            </span>
            <input type="text" class="form-control" name="fname" value="" placeholder="Förnamn">
          </div>
          <div class="mb-3 input-group">
            <span class="input-group-text">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
              </svg>
            </span>
            <input type="text" class="form-control" name="lname" value="" placeholder="Efternamn">
          </div>
          <div class="mb-3 input-group col">
            <span class="input-group-text">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
              </svg>
            </span>
            <input type="text" class="form-control" name="uname" placeholder="Användarnamn" value="">
          </div>
        </div>
        <div class="col">
          <div class="mb-3 input-group">
            <span class="input-group-text">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z" />
              </svg>
            </span>
            <input type="email" class="form-control" name="email" value="" placeholder="Email adress">
          </div>
          <div class="mb-3 input-group">
            <span class="input-group-text">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
              </svg>
            </span>
            <input type="password" class="form-control" name="password" value="" placeholder="Lösenord">
          </div>
          <div class="mb-3 input-group">
            <span class="input-group-text">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
              </svg>
            </span>
            <input type="password" class="form-control" name="confirm_password" value="" placeholder="Bekräfta Lösenord">
          </div>
        </div>
      </div>

      <div class="d-grid gap-2 col-6 mx-auto">
        <button type="button" onclick="submitForm('signup')" class="btn btn-primary btn-lg mt-3 mb-4">Bli medlem</button>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.tab a').on('click', function(e) {
      e.preventDefault();

      $(this).parent().addClass('active');
      $(this).parent().siblings().removeClass('active');


      var href = $(this).attr('href');
      $('.container > form').hide();
      $(href).fadeIn(500);
    });
  });

  submitForm = function(id) {
    console.log(id);
    document.getElementById(id).submit();
  }
</script>

<?= $this->endSection() ?>