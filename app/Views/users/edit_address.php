<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>

<div class="bg-dark text-white shadow p-3">
  <?= form_open(current_url(), 'data-parsley-validate id="form_id" novalidate') ?>
  <div>
    <div class="row">
      <h1 class="col"><?= $editTitle ?></h1>
      <a href="<?= base_url('/user/addresses') ?>" class="btn p-0 col-2 col-md-1"><i
          class="bi bi-arrow-left text-white fs-2"></i></a>
    </div>
    <hr>
    <div class="row gx-2">
      <div class="form-floating col-sm mt-3">
        <input type="text" class="form-control border-custom overlay1 <?= isInvalid('firstname') ?>" name="firstname"
          value="<?= $addressDetails['firstname'] ?? set_value('firstname') ?>" id="firstname" placeholder="Förnamn"
          data-parsley-pattern="/^[A-Za-zÀ-ÿ]+$/" data-parsley-errors-container="#invalidFirstname"
          data-parsley-trigger="keyup change" required>
        <label for="firstname">Förnamn</label>
        <div class="text-danger text-start" id="invalidFirstname">
          <?= getError('firstname') ?>
        </div>
      </div>
      <div class="form-floating col-sm mt-3">
        <input type="text" class="form-control border-custom overlay1 <?= isInvalid('lastname') ?>" name="lastname"
          value="<?= $addressDetails['lastname'] ?? set_value('lastname') ?>" id="lastname" placeholder="Efternamn"
          data-parsley-pattern="/^[A-Za-zÀ-ÿ]+$/" data-parsley-errors-container="#invalidLastname"
          data-parsley-trigger="keyup change" required>
        <label for="lastname">Efternamn</label>
        <div class="text-danger text-start" id="invalidLastname">
          <?= getError('lastname') ?>
        </div>
      </div>
    </div>
    <?php if (service('uri', current_url())->getSegment(4) == 'billing') : ?>
    <div class="row gx-2">
      <div class="form-floating col-sm mt-3">
        <input type="email" class="form-control border-custom overlay1 <?= isInvalid('email') ?>" name="email"
          value="<?= $addressDetails['email'] ?? set_value('email') ?>" id="email" placeholder="Email"
          data-parsley-errors-container="#invalidEmail" data-parsley-trigger="keyup change" required>
        <label for="email">Email adress</label>
        <div class="text-danger text-start" id="invalidEmail">
          <?= getError('email') ?>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <div class="row gx-2">
      <div class="form-floating col-sm mt-3">
        <input type="text" class="form-control border-custom overlay1 <?= isInvalid('city') ?>" name="city"
          value="<?= $addressDetails['city'] ?? set_value('city') ?>" id="city" placeholder="Stad"
          data-parsley-pattern="/^[A-Za-zÀ-ÿ]+$/" data-parsley-errors-container="#invalidCity"
          data-parsley-trigger="keyup change" required>
        <label for="city">Stad</label>
        <div class="text-danger text-start" id="invalidCity">
          <?= getError('city') ?>
        </div>
      </div>
      <div class="form-floating col-sm mt-3">
        <input type="tel" class="form-control border-custom overlay1 <?= isInvalid('zipCode') ?>" name="zipCode"
          value="<?= $addressDetails['zip_code'] ?? set_value('zipCode') ?>" id="zipCode" placeholder="Postnummer"
          data-mask="000 00" data-parsley-errors-container="#invalidZipCode" data-parsley-trigger="keyup change"
          required>
        <label for="zipCode">Postnummer</label>
        <div class="text-danger text-start" id="invalidZipCode">
          <?= getError('zipCode') ?>
        </div>
      </div>
    </div>
    <div class="row gx-2">
      <div class="form-floating col-sm mt-3">
        <input type="text" class="form-control border-custom overlay1 <?= isInvalid('address') ?>" name="address"
          value="<?= $addressDetails['address'] ?? set_value('address') ?>" id="address" placeholder="adress"
          data-parsley-errors-container="#invalidAddress" data-parsley-trigger="keyup change" required>
        <label for="address">Adress</label>
        <div class="text-danger text-start" id="invalidAddress">
          <?= getError('address') ?>
        </div>
      </div>
      <?php if (service('uri', current_url())->getSegment(4) == 'billing') : ?>
      <div class="form-floating col-sm mt-3">
        <input type="tel" class="form-control border-custom overlay1 <?= isInvalid('phone') ?>" name="phone"
          value="<?= $addressDetails['phone'] ?? set_value('phone') ?>" id="phone" placeholder="Telefonnummer"
          data-parsley-errors-container="#invalidphone" data-parsley-trigger="keyup change" data-parsley-length="[7,13]"
          required>
        <label for="phone">Telefonnummer</label>
        <div class="text-danger text-start" id="invalidphone">
          <?= getError('phone') ?>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>
  <div class="row">
    <button type="submit" class="btn btn-outline-info btn-lg rounded-pill w-50 mt-5 mb-3 mx-auto">
      Spara adress</button>
  </div>
  <?= form_close() ?>
</div>

<?= $this->endSection() ?>