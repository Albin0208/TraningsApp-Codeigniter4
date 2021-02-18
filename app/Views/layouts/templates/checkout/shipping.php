<div class="container p-3">
  <h4 class="mb-3">Fakturaadress</h4>
  <p>Redan kund? <a href="/login">Logga in</a></p>
  <hr>
  <form class="needs-validation" method="post" novalidate>
    <div class="row gx-2">
      <div class="mt-3 col-sm">
        <div class="form-floating w-100 me-auto">
          <input type="email" class="form-control border-custom overlay1 <?= isInvalid('email') ?>" name="email" value="<?= @$user['email'] ?? set_value('email') ?>" id="email" placeholder="Email" required>
          <label for="email">Email adress</label>
          <div class="invalid-feedback">
            Ange en giltig email adress.
          </div>
        </div>
      </div>
      <div class="mt-3 col-sm">
        <div class="form-floating w-100 me-auto">
          <input type="tel" class="form-control border-custom overlay1 <?= isInvalid('zipCode') ?>" name="zipCode" value="<?= @$user['zipCode'] ?? set_value('zipCode') ?>" id="zipCode" placeholder="Postnummer" required>
          <label for="zipCode">Postnummer</label>
          <div class="invalid-feedback">
            Ange ett giltig postnummer.
          </div>
        </div>
        <div class="invalid-feedback">
          Please choose a username.
        </div>
      </div>
    </div>
    <div class="row">
      <div class="mt-3 col-sm">
        <div class="form-floating w-100 me-auto">
          <input type="text" class="form-control border-custom overlay1 <?= isInvalid('socialNumber') ?>" name="socialNumber" value="<?= @$user['socialNumber'] ?? set_value('socialnumber') ?>" id="socialNumber" placeholder="Personnummer" required>
          <label for="socialNumber">Personnummer (ÅÅMMDDXXXX)</label>
          <div class="invalid-feedback">
            Ange ett giltig personnummer.
          </div>
        </div>
      </div>
    </div>
    <div class="row gx-2">
      <div class="mt-3 col-sm">
        <div class="form-floating w-100 me-auto">
          <input type="text" class="form-control border-custom overlay1 <?= isInvalid('firstname') ?>" name="firstname" value="<?= @$user['firstname'] ?? set_value('firstname') ?>" id="firstname" placeholder="Förnamn" required>
          <label for="firstname">Förnamn</label>
          <div class="invalid-feedback">
            Ange ett giltig förnamn.
          </div>
        </div>
      </div>
      <div class="mt-3 col-sm">
        <div class="form-floating w-100 me-auto">
          <input type="text" class="form-control border-custom overlay1 <?= isInvalid('lastname') ?>" name="lastname" value="<?= @$user['lastname'] ?? set_value('lastname') ?>" id="lastname" placeholder="Efternamn" required>
          <label for="lastname">Efternamn</label>
          <div class="invalid-feedback">
            Ange ett giltig efternamn.
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="mt-3 col-sm">
        <div class="form-floating w-100 me-auto">
          <input type="text" class="form-control border-custom overlay1 <?= isInvalid('address') ?>" name="address" value="<?= @$user['address'] ?? set_value('address') ?>" id="address" placeholder="adress" required>
          <label for="address">Adress</label>
          <div class="invalid-feedback">
            Ange en giltig adress.
          </div>
        </div>
      </div>
    </div>
    <div class="row gx-2">
      <div class="mt-3 col-sm">
        <div class="form-floating w-100 me-auto">
          <input type="text" class="form-control border-custom overlay1 <?= isInvalid('city') ?>" name="city" value="<?= @$user['city'] ?? set_value('city') ?>" id="city" placeholder="Stad" required>
          <label for="city">Stad</label>
          <div class="invalid-feedback">
            Ange en giltig stad.
          </div>
        </div>
      </div>
      <div class="mt-3 col-sm">
        <div class="form-floating w-100 me-auto">
          <input type="tel" class="form-control border-custom overlay1 <?= isInvalid('phone') ?>" name="phone" value="<?= @$user['phone'] ?? set_value('phone') ?>" id="phone" placeholder="Telefonnummer" required>
          <label for="phone">Telefonnummer</label>
          <div class="invalid-feedback">
            Ange ett giltig telefonnummer.
          </div>
        </div>
      </div>
    </div>

    <hr class="my-4">

    <h4 class="mb-3">Betalning</h4>
    <hr>

    <div class="row">
      <div class="mt-3 input-group flex-nowrap input-group-lg">
        <span class="input-group-text bg-dark border-custom border-end-0">
          <i class="bi bi-credit-card-fill text-white"></i>
        </span>
        <div class="form-floating w-100">
          <input type="tel" maxlength="19" class="form-control rounded-0 border-custom rounded-end overlay1 border-start-0 <?= isInvalid('cardNumber') ?>" name="cardNumber" value="<?= set_value('cardNumber') ?>" placeholder="Kortnummer" required>
          <label for="cardNumber">Kortnummer</label>
          <div class="invalid-feedback">
            Ange ett giltig kortnummer.
          </div>
        </div>
      </div>
    </div>
    <div class="row gx-2">
      <div class="mt-3 col-sm">
        <div class=" input-group flex-nowrap input-group-lg">
          <span class="input-group-text bg-dark border-custom border-end-0">
            <i class="bi bi-calendar-event-fill text-white"></i>
          </span>
          <div class="form-floating w-100 me-auto">
            <input type="tel" maxlength="5" class="form-control rounded-0 border-custom rounded-end overlay1 border-start-0 <?= isInvalid('expiration') ?>" maxlength="4" name="expiration" value="<?= set_value('expiration') ?>" id="expiration" placeholder="Förnamn" required>
            <label for="expiration">ÅÅ/MM</label>
            <div class="invalid-feedback">
              Ange ett giltig utgångsdatum.
            </div>
          </div>
        </div>
      </div>
      <div class="mt-3  col-sm">
        <div class="input-group flex-nowrap input-group-lg">
          <span class="input-group-text bg-dark border-custom border-end-0">
            <i class="bi bi-lock-fill text-white"></i>
          </span>
          <div class="form-floating w-100">
            <input type="tel" min="0" maxlength="4" class="form-control rounded-0 border-custom rounded-end overlay1 border-start-0 <?= isInvalid('cvc') ?>" name="cvc" value="<?= set_value('cvc') ?>" placeholder="CVC" required>
            <label for="cvc">CVC</label>
            <div class="invalid-feedback">
              Ange ett giltig CVC nummer.
            </div>
          </div>
        </div>
        <?= displayError('cvc') ?>
      </div>
    </div>

    <hr class="my-4">

    <button class="w-100 btn btn-primary btn-lg" type="submit">Slutför köp</button>
  </form>
</div>

<script src="/assets/js/form-validation.js"></script>