<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= @$title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/styles.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>

<body>
    <?php $uri = service('uri'); ?>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom bg-red sticky-top">
        <div class="container">
            <a class="navbar-brand brand" href="/">Elit-Träning</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= $uri->getSegment(1) == "" ? "active" : null ?>" href="/">Startsida</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $uri->getSegment(1) == "shop" ? "active" : null ?>" href="/shop">Butik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $uri->getSegment(1) == "about" ? "active" : null ?>" href="#">Om Elit-Träning</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <?php if (session()->get('isLoggedIn')) : ?>
                            <a href="/user" class="nav-link <?= $uri->getSegment(1) == "user" ? "active" : null ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-person-fill" viewBox="0 1 14 14">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg>
                                Mitt Konto</a>
                        <?php else : ?>
                            <a href="/login" class="nav-link <?= $uri->getSegment(1) == "login" ? "active" : null ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-person-fill" viewBox="0 1 14 14">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg>
                                Logga in</a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item">
                        <a href="/cart" class="nav-link  <?= $uri->getSegment(1) == "cart" ? "active" : null ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-cart3" viewBox="0 1 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>
                            Varukorg</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-md">
        <?php $this->renderSection("content") ?>
    </div>
    <!-- <footer class="bg-dark text-white pt-5 pb-4">This is a footer</footer> -->

</body>

</html>