<?= form_open(base_url() . '/cart/checkout', 'data-parsley-validate id="form_id" novalidate') ?>
<div>
  <h1>Fakturaadress</h1>
  <?php if (!session()->has('isLoggedIn')) : ?>
  <p class="mt-1">Redan Kund: <a href="/login">Logga in</a></p>
  <?php endif; ?>
  <hr>
  <div class="row gx-2">
    <div class="form-floating col-sm mt-3">
      <input type="email" class="form-control border-custom overlay1 <?= isInvalid('email') ?>" name="email"
        value="<?= @$user['email'] ?? set_value('email') ?>" id="email" placeholder="Email"
        data-parsley-errors-container="#invalidEmail" data-parsley-trigger="keyup change" required>
      <label for="email">Email adress</label>
      <div class="text-danger text-start" id="invalidEmail">
        <?= getError('email') ?>
      </div>
    </div>
    <div class="form-floating col-sm mt-3">
      <input type="tel" class="form-control border-custom overlay1 <?= isInvalid('zipCode') ?>" name="zipCode"
        value="<?= @$user['zipCode'] ?? set_value('zipCode') ?>" id="zipCode" placeholder="Postnummer"
        data-mask="000 00" data-parsley-errors-container="#invalidZipCode" data-parsley-trigger="keyup change" required>
      <label for="zipCode">Postnummer</label>
      <div class="text-danger text-start" id="invalidZipCode">
        <?= getError('zipCode') ?>
      </div>
    </div>
  </div>
  <div class="row gx-2">
    <div class="form-floating mt-3">
      <input type="text" class="form-control border-custom overlay1 <?= isInvalid('socialNumber') ?>"
        name="socialNumber" value="<?= @$user['socialNumber'] ?? set_value('socialNumber') ?>" data-mask="000000-0000"
        id="socialNumber" placeholder="Personnummer" data-parsley-length="[11,11]"
        data-parsley-length-message="Värdet måste vara exakt 10 siffror"
        data-parsley-errors-container="#invalidSocialNumber" data-parsley-trigger="keyup change" required>
      <label for="socialNumber">Personnummer (ÅÅMMDD-XXXX)</label>
      <div class="text-danger text-start" id="invalidSocialNumber">
        <?= getError('socialNumber') ?>
      </div>
    </div>
  </div>
  <div class="row gx-2">
    <div class="form-floating col-sm mt-3">
      <input type="text" class="form-control border-custom overlay1 <?= isInvalid('firstname') ?>" name="firstname"
        value="<?= @$user['firstname'] ?? set_value('firstname') ?>" id="firstname" placeholder="Förnamn"
        data-parsley-pattern="/^[A-ZÅÄÖåäö]+$/i" data-parsley-errors-container="#invalidFirstname"
        data-parsley-trigger="keyup change" required>
      <label for="firstname">Förnamn</label>
      <div class="text-danger text-start" id="invalidFirstname">
        <?= getError('firstname') ?>
      </div>
    </div>
    <div class="form-floating col-sm mt-3">
      <input type="text" class="form-control border-custom overlay1 <?= isInvalid('lastname') ?>" name="lastname"
        value="<?= @$user['lastname'] ?? set_value('lastname') ?>" id="lastname" placeholder="Efternamn"
        data-parsley-pattern="/^[A-ZÅÄÖåäö]+$/i" data-parsley-errors-container="#invalidLastname"
        data-parsley-trigger="keyup change" required>
      <label for="lastname">Efternamn</label>
      <div class="text-danger text-start" id="invalidLastname">
        <?= getError('lastname') ?>
      </div>
    </div>
  </div>
  <div class="row gx-2">
    <div class="form-floating mt-3">
      <input type="text" class="form-control border-custom overlay1 <?= isInvalid('address') ?>" name="address"
        value="<?= @$user['address'] ?? set_value('address') ?>" id="address" placeholder="adress"
        data-parsley-errors-container="#invalidAddress" data-parsley-trigger="keyup change" required>
      <label for="address">Adress</label>
      <div class="text-danger text-start" id="invalidAddress">
        <?= getError('address') ?>
      </div>
    </div>
  </div>
  <div class="row gx-2">
    <div class="form-floating col-sm mt-3">
      <input type="text" class="form-control border-custom overlay1 <?= isInvalid('city') ?>" name="city"
        value="<?= @$user['city'] ?? set_value('city') ?>" id="city" placeholder="Stad"
        data-parsley-pattern="/^[A-ZÅÄÖåäö ]+$/i" data-parsley-errors-container="#invalidCity"
        data-parsley-trigger="keyup change" required>
      <label for="city">Stad</label>
      <div class="text-danger text-start" id="invalidCity">
        <?= getError('city') ?>
      </div>
    </div>
    <div class="form-floating col-sm mt-3">
      <input type="tel" class="form-control border-custom overlay1 <?= isInvalid('phone') ?>" name="phone"
        value="<?= @$user['phone'] ?? set_value('phone') ?>" id="phone" placeholder="Telefonnummer"
        data-parsley-errors-container="#invalidphone" data-parsley-trigger="keyup change" data-parsley-length="[7,13]"
        required>
      <label for="phone">Telefonnummer</label>
      <div class="text-danger text-start" id="invalidphone">
        <?= getError('phone') ?>
      </div>
    </div>
  </div>
</div>
<hr>

<div>
  <h1>Betalning</h1>
  <hr>
  <div class="row">
    <div class="mt-3 input-group flex-nowrap input-group-lg">
      <span class="input-group-text bg-dark border-custom border-end-0">
        <i class="bi bi-credit-card-fill text-white"></i>
      </span>
      <div class="form-floating w-100">
        <input type="tel"
          class="form-control rounded-0 border-custom rounded-end overlay1 border-start-0 <?= isInvalid('cardNumber') ?>"
          name="cardNumber" value="<?= set_value('cardNumber') ?>" placeholder="Kortnummer"
          data-mask="0000 0000 0000 0000" data-parsley-errors-container="#invalidCardNumber"
          data-parsley-trigger="keyup change" data-parsley-length="[19,19]"
          data-parsley-length-message="Värdet måste vara exakt 16 siffror" required>
        <label for="cardNumber">Kortnummer</label>
      </div>
    </div>
    <div class="text-danger text-start" id="invalidCardNumber">
      <?= getError('cardNumber') ?>
    </div>
  </div>
  <div class="row gx-2">
    <div class="mt-3 col-sm">
      <div class=" input-group flex-nowrap input-group-lg">
        <span class="input-group-text bg-dark border-custom border-end-0">
          <i class="bi bi-calendar-event-fill text-white"></i>
        </span>
        <div class="form-floating w-100 me-auto">
          <input type="tel" id="dateField" data-mask="00/00"
            class="form-control rounded-0 border-custom rounded-end overlay1 border-start-0 <?= isInvalid('expiration') ?>"
            name="expiration" value="<?= set_value('expiration') ?>" id="expiration" placeholder="Förnamn"
            data-parsley-errors-container="#invalidExpiration" data-parsley-trigger="keyup change" required>
          <label for="expiration">MM/ÅÅ</label>
        </div>
      </div>
      <div class="text-danger text-start" id="invalidExpiration">
        <?= getError('expiration') ?>
      </div>
    </div>
    <div class="mt-4 col-sm mt-sm-3">
      <div class="input-group flex-nowrap input-group-lg">
        <span class="input-group-text bg-dark border-custom border-end-0">
          <i class="bi bi-lock-fill text-white"></i>
        </span>
        <div class="form-floating w-100">
          <input type="tel"
            class="form-control rounded-0 border-custom rounded-end overlay1 border-start-0 <?= isInvalid('cvc') ?>"
            name="cvc" value="<?= set_value('cvc') ?>" data-mask="000" placeholder="CVC" data-parsley-type="digits"
            data-parsley-errors-container="#invalidCVC" data-parsley-trigger="keyup change" required>
          <label for="cvc">CVC</label>
        </div>
      </div>
      <div class="text-danger text-start" id="invalidCVC">
        <?= getError('cvc') ?>
      </div>
    </div>
  </div>
  <hr class="my-4">
</div>
<?= form_close() ?>