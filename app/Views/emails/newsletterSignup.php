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

  <div
    style="background-color: #303437;margin: auto;margin-top: 10px;border: 1px solid black;border-radius: 5px;padding-bottom: 20px;width: 70%;">
    <h1>Elit-Träning</h1>
    <header style="background-color: #121212;width: 100%;padding: 20px 0;margin-bottom: 10px;text-align: center;">
      <h3 style="margin: 10px;">
        Tack för att du registrerade dig för vårt nyhetsbrev
      </h3>
    </header>
    Vill inte prenumerera längre
    <a style="color: #0dcaf0;" href="<?= base_url() ?>/Home/unsubscribe/<?= $delete_key ?>">avregistrera dig här</a>
  </div>
</body>

</html>