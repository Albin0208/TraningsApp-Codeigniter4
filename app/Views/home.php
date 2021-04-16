<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>

<div id="carousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true"
      aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000">
      <div class="container text-center p-3 text-white">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="10000">
      <div class="container text-center p-3 text-white">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="10000">
      <div class="container text-center p-3 text-white">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div class="bg-dark w-100 text-white mt-5">
  <div class="row row-cols-1 row-cols-md-3 text-center p-3">
    <div class="col">
      <i class="bi bi-check-circle me-1"></i>
      <span class="align-middle">Leverans inom 1-3 arbetsdagar</span>
    </div>
    <div class="col">
      <i class="bi bi-check-circle me-1"></i>
      <span class="align-middle">Fri frakt vid köp över 500 SEK</span>
    </div>
    <div class="col">
      <i class="bi bi-check-circle me-1"></i>
      <span class="align-middle">Fria byten</span>
    </div>
  </div>
</div>



<?= $this->endSection() ?>