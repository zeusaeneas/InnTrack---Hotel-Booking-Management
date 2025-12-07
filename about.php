<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
  <title>InnTrack | About</title>
  <?php require('inc/links.php') ?>

  <style>
    :root {
      --primary: #3b38ad;
      --primary_hover: #3b37adc9;
    }

    @media screen and (max-width: 767.98px) {
      .mb-only-sm {
        margin-bottom: 1.5rem;
        /* same as mb-4 */
      }
    }

    .box {
      border-top-color: var(--primary) !important;
    }
  </style>
</head>

<body>

  <?php require('inc/header.php') ?>

  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">About Us</h2>
    <p class="text-center">
      Lorem ipsum, dolor sit amet consectetur adipisicing elit.
      Fugiat dolorum nostrum expedita illum debitis possimus
      blanditiis odit officia quos voluptas.
    </p>
  </div>

  <div class="container">
    <div class="row justify-content-between align-items-center">
      <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
        <h3 class="mb-3">Lorem ipsum dolor sit.</h3>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit.
          Nulla molestiae ut labore pariatur neque officiis repudiandae.
        </p>
      </div>
      <div class="col-lg-5 col-md-5 order-lg-2 order-md-2 order-1 mb-only-sm">
        <img src="images/about/about.jpg" class="w-100 rounded">
      </div>
    </div>
  </div>

  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded p-4 border-top border-4 text-center box">
          <img src="images/about/hotel.svg" width="70px">
          <h4 class="mt-3">100+ more</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded p-4 border-top border-4 text-center box">
          <img src="images/about/customers.svg" width="70px">
          <h4 class="mt-3">200k+ Customers</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded p-4 border-top border-4 text-center box">
          <img src="images/about/rating.svg" width="70px">
          <h4 class="mt-3">150k+ Reviews</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded p-4 border-top border-4 text-center box">
          <img src="images/about/hotel.svg" width="70px">
          <h4 class="mt-3">900+ Staffs</h4>
        </div>
      </div>
    </div>
  </div>

  <h3 class="my-5 fw-bold h-font text-center">Management Team</h3>

  <div class="container px-4">
    <div class="swiper mySwiper">
      <div class="swiper-wrapper mb-5">
        <?php
        $about_r = selectAll('team_details');
        $path = ABOUT_IMG_PATH;

        while ($row = mysqli_fetch_assoc($about_r)) {
          echo<<<data
          <div class="swiper-slide bg-white text-center overflow-hidden rounded">
            <img src="$path$row[picture]" class="w-100">
            <h5 class="mt-2">
              $row[name]
            </h5>
          </div>
          
          data;
        }
        ?>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>



  <?php require('inc/footer.php') ?>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <script>
    var swiper = new Swiper(".mySwiper", {
      spaceBetween: 40,
      pagination: {
        el: ".swiper-pagination",
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
        },
        640: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 3,
        },
        1024: {
          slidesPerView: 3,
        },
      }
    });
  </script>

</body>

</html>