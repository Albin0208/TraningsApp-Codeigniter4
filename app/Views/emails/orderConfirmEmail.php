<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office"
  style="width: 100%;font-family: 'Roboto', sans-serif;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;padding: 0;margin: 0;">

<head>
  <meta charset="UTF-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <meta name="x-apple-disable-message-reformatting" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta content="telephone=no" name="format-detection" />
  <title>Din order är slutförd</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" />
</head>

<body
  style="font-family: 'Roboto', sans-serif;color: white;margin: 0;display: flex;flex-direction: column;text-align: center;">
  <div style="background-color: #303437;margin: auto;margin-top: 10px;border: 1px solid black;border-radius: 5px;">
    <h1>Elit-Träning</h1>
    <header style="background-color: #121212;width: 100%;padding: 20px 0;margin-bottom: 10px;text-align: center;">
      <h3 class="test">
        Din beställning är nu slutförd och skickas inom kort!
      </h3>
    </header>
    <div style="padding: 10px; margin: 20px; text-align: left">
      <p style="margin: 0">
        Hej
        <?= esc($firstname) ?>,<br /><br />

        Din beställning hos Elit-Träning är nu slutförd. Normal leveranstid är
        1-3 vardagar.
        <br /><br />
        Har du frågor om din beställning? Kontakta oss på
        <a style="color: #0d6efd" href="mailto:elittraning1@gmail.com" target="_blank">elittraning1@gmail.com</a>
      </p>
      <section style="margin-top: 20px">
        <table cellspacing="0" cellpadding="6"
          style="border: 1px solid black;text-align: center;width: 100%;border-spacing: 0;">
          <thead>
            <tr>
              <th scope="col" style="width: 60%;text-align: start;border: 1px solid black;padding: 20px;">
                Produkt
              </th>
              <th scope="col" style="border: 1px solid black; padding: 20px">
                Antal
              </th>
              <th scope="col" style="border: 1px solid black; padding: 20px">
                Pris
              </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($cart->contents() as $item) : ?>
            <tr>
              <td style="width: 60%;text-align: start;border: 1px solid black;padding: 20px;">
                <?= $item['name'] ?>
              </td>
              <td style="border: 1px solid black; padding: 20px">
                <?= $item['qty'] ?>
              </td>
              <td style="border: 1px solid black; padding: 20px">
                <?= $item['price'] ?> SEK
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <th style="width: 60%;text-align: start;border: 1px solid black;padding: 20px;" scope="row" colspan="2">
                Ordinarie pris:
              </th>
              <td style="border: 1px solid black; padding: 20px">
                <?= $cart->total() ?> SEK
              </td>
            </tr>
            <?php if ($cart->discountValue()) : ?>
            <tr>
              <th style="width: 60%;text-align: start;border: 1px solid black;padding: 20px;" scope="row" colspan="2">
                Rabatt:
              </th>
              <td style="border: 1px solid black; padding: 20px">-<?= $cart->discountValue() ?> SEK</td>
            </tr>
            <?php endif; ?>
            <tr>
              <th style="width: 60%;text-align: start;border: 1px solid black;padding: 20px;" scope="row" colspan="2">
                Totalt:
              </th>
              <td style="border: 1px solid black; padding: 20px">
                <?= $cart->total() - $cart->discountValue() ?> SEK
              </td>
            </tr>
          </tfoot>
        </table>
      </section>
      <section style="margin-top: 20px">
        <table cellspacing="0" cellpadding="0" style="width: 100%; margin-bottom: 40px; border: none">
          <tbody>
            <tr>
              <td width="50%" style="text-align: left; border: none; padding: 0">
                <h2 style="color: #0dcaf0;font-size: 18px;font-weight: bold;margin: 0 0 18px;">
                  Faktureringsadress
                </h2>
                <address style="padding: 12px;border: 1px solid #e5e5e5;background-color: #121212;">
                  <?= esc($firstname) ?>
                  <?= esc($lastname) ?><br />
                  <?= esc($address) ?><br />
                  <?= esc($zipCode) ?>
                  <?= esc($city) ?><br />
                  <a href="tel:+46761403625" style="color: #0dcaf0;font-weight: normal;text-decoration: underline;"
                    target="_blank"><?= esc($phone) ?></a><br />
                  <a style="color: #0d6efd" href="mailto:<?= esc($email) ?>" target="_blank"><?= esc($email) ?></a>
                </address>
              </td>
              <td valign="top" width="50%" style="text-align: left; padding: 0; border: none">
                <h2 style="color: #0dcaf0;font-size: 18px;font-weight: bold;margin: 0 0 18px;">
                  Leveransadress
                </h2>
                <address style="padding: 12px;border: 1px solid #e5e5e5;background-color: #121212;">
                  <?= esc($firstname) ?>
                  <?= esc($lastname) ?><br />
                  <?= esc($address) ?><br />
                  <?= esc($zipCode) ?>
                  <?= esc($city) ?><br />
                </address>
              </td>
            </tr>
          </tbody>
        </table>
      </section>
      <footer>Tack för att du handlat hos oss!</footer>
    </div>
  </div>
</body>

</html>