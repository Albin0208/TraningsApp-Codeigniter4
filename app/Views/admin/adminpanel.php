<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>

<div class="bg-dark p-3 text-white">
  <h1 style="font-size: 4em;">Admin panelen</h1>
  <hr>
  <div class="row row-cols-4 gx-3">
    <div class="col">
      <div class="card overlay2 text-white shadow">
        <div class="card-body">
          <h1 class="card-title">12</h1>
          <h5 class="card-subtitle">Antal kunder</h5>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card overlay2 text-white shadow">
        <div class="card-body">
          <h1 class="card-title">12</h1>
          <h5 class="card-subtitle">Antal beställningar</h5>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card overlay2 text-white shadow">
        <div class="card-body">
          <h1 class="card-title">700 SEK</h1>
          <h5 class="card-subtitle">Totala intäkter</h5>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card overlay2 text-white shadow">
        <div class="card-body">
          <h1 class="card-title">6</h1>
          <h5 class="card-subtitle">Antal produkter</h5>
        </div>
      </div>
    </div>
  </div>

  <div class="row row-cols-2 gx-3 mt-4">
    <div class="col-7">
      <div class="card overlay2 text-white shadow">
        <div class="card-body">
          <h2 class="card-title">Senaste beställningarna</h2>
          <table class="table text-white table-responsive border">
            <thead>
              <tr>
                <th scope="col">Order</th>
                <th scope="col">Datum</th>
                <th scope="col">Summa</th>
                <th scope="col" class="text-end">Åtgärder</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row" class="align-middle"><a class="text-decoration-none text-info"
                    href="view-order/">#1654654</a>
                </th>
                <td class="align-middle">2021-04-16</td>
                <td class="align-middle">100 SEK för 3 artiklar</td>
                <td class="text-end"><a class="btn btn-outline-info" href="view-order/">Visa</a>
                </td>
              </tr>
              <tr>
                <th scope="row" class="align-middle"><a class="text-decoration-none text-info"
                    href="view-order/">#1654654</a>
                </th>
                <td class="align-middle">2021-04-16</td>
                <td class="align-middle">100 SEK för 3 artiklar</td>
                <td class="text-end"><a class="btn btn-outline-info" href="view-order/">Visa</a>
                </td>
              </tr>
              <tr>
                <th scope="row" class="align-middle"><a class="text-decoration-none text-info"
                    href="view-order/">#1654654</a>
                </th>
                <td class="align-middle">2021-04-16</td>
                <td class="align-middle">100 SEK för 3 artiklar</td>
                <td class="text-end"><a class="btn btn-outline-info" href="view-order/">Visa</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-5">
      <div class="card overlay2 text-white shadow">
        <div class="card-body">
          <h2 class="card-title">Nyaste kunderna</h2>
          <table class="table text-white table-responsive border">
            <thead>
              <tr>
                <th scope="col">Namn</th>
                <th scope="col">Användarnamn</th>
                <th scope="col">Gick med</th>
                <th scope="col" class="text-end">Åtgärder</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row" class="align-middle">Albin Dahlén</th>
                <td class="align-middle">Albin</td>
                <td class="align-middle">2021-04-16</td>
                <td class="text-end"><a class="btn btn-outline-info" href="view-order/">Visa</a>
                </td>
              </tr>
              <tr>
                <th scope="row" class="align-middle">Albin Dahlén</th>
                <td class="align-middle">Albin</td>
                <td class="align-middle">2021-04-16</td>
                <td class="text-end"><a class="btn btn-outline-info" href="view-order/">Visa</a>
                </td>
              </tr>
              <tr>
                <th scope="row" class="align-middle">Albin Dahlén</th>
                <td class="align-middle">Albin</td>
                <td class="align-middle">2021-04-16</td>
                <td class="text-end"><a class="btn btn-outline-info" href="view-order/">Visa</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row gx-3 mt-4">
    <div class="col">
      <div class="card overlay2 text-white shadow">
        <div class="card-body">
          <div class="row mb-2">
            <h2 class="card-title col-8">Produkter</h2>
            <div class="col-4 text-end">
              <a href="" class="btn btn-outline-info">Lägg till produkt</a>
            </div>
          </div>
          <table class="table text-white table-responsive border">
            <thead>
              <tr>
                <th scope="col">Namn</th>
                <th scope="col">Pris</th>
                <th scope="col">Kategori</th>
                <th scope="col">Rabatt</th>
                <th scope="col" class="text-end">Åtgärder</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row" class="align-middle">Styrketräning</th>
                <td class="align-middle">200 SEK</td>
                <td class="align-middle">Bok</td>
                <td class="align-middle"><span class="text-danger">-100</span> SEK</td>
                <td class="text-end">
                  <a class="btn btn-outline-info" href="view-order/">Visa</a>
                  <a class="btn btn-outline-info" href="view-order/">Redigera</a>
                </td>
              </tr>
              <tr>
                <th scope="row" class="align-middle">Styrketräning</th>
                <td class="align-middle">200 SEK</td>
                <td class="align-middle">Bok</td>
                <td class="align-middle"><span class="text-danger">-100</span> SEK</td>
                <td class="text-end">
                  <a class="btn btn-outline-info" href="view-order/">Visa</a>
                  <a class="btn btn-outline-info" href="view-order/">Redigera</a>
                </td>
              </tr>
              <tr>
                <th scope="row" class="align-middle">Styrketräning</th>
                <td class="align-middle">200 SEK</td>
                <td class="align-middle">Bok</td>
                <td class="align-middle"><span class="text-danger">-100</span> SEK</td>
                <td class="text-end">
                  <a class="btn btn-outline-info" href="view-order/">Visa</a>
                  <a class="btn btn-outline-info" href="view-order/">Redigera</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?= $this->endSection() ?>