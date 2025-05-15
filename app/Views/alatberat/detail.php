<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Alat Berat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/alatberat.css">
    <style>
       .card-img-top {
        width: 100%;
        height: auto;
        max-height: 400px; /* opsional: kasih batas biar gak terlalu tinggi */
        object-fit: contain; /* atau contain, terserah efek yang kamu mau */
        background-color: #f8f9fa; 
    }
    </style>
</head>

<body >

    
<div class="container mt-5">
    <h2 class="text-center mb-4">Detail Alat Berat</h2>

    <div class="d-flex justify-content-center mb-4">
        <input type="text" id="searchInput" class="form-control w-auto" style="min-width: 300px;" placeholder="Cari nama alat...">
        <a href="<?= base_url('/') ?>" class="btn btn-outline-success">
            <i class="bi bi-house-fill"></i> Home
        </a>
        <a href="/pesanan" class="btn btn-outline-primary d-flex align-items-center ms-2">
    <i class="bi bi-cart-plus-fill me-1"></i> Pesan Alat
</a>
    </div>
    <h2 class="text-center mt-0 mb-1"><?= esc($alat['nama']) ?></h2>

</div>

<section class="pt-3 pb-5">
      <div class="container px-4 px-lg-5 mt-0">
        <div class="row justify-content-center">
          <div class="col-lg-8 mb-5">
            <div class="card h-100">
              <!-- Product image-->
              <img
                class="card-img-top p-3"
                src="<?= base_url('public/uploads/' . $alat['gambar']) ?>"
                alt="<?= esc($alat['nama']) ?>"
              />
              <!-- Product details-->
              <div class="card-body card-body-custom pt-4">
                <div>
                  <!-- Product name-->
                  <h3 class="fw-bolder text-primary">Deskripsi</h3>
                  <p>
                    <?= esc($alat['deskripsi']) ?>
                  </p>
                  
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-5">
            <div class="card">
              <!-- Product details-->
              <div class="card-body card-body-custom pt-4">
                <div class="text-center">
                  <!-- Product name-->
                   
                  <div
                    class="d-flex justify-content-between align-items-center"
                  >
                    <h5 class="fw-bolder">Harga Sewa</h5>
                    <div class="rent-price mb-3">
                      <span style="font-size: 1rem" class="text-primary"
                        >Rp. <?= number_format($alat['harga_jaman'], 0, ',', '.') ?>/</span
                      >jam
                    </div>
                  </div>
                  
                  <ul class="list-unstyled list-style-group">
                    <li
                      class="border-bottom p-2 d-flex justify-content-between"
                    >
                      <span>Sewa Harian</span>
                    <div class="rent-price mb-3"> 
                      <span style="font-size: 1rem" class="text-primary">Rp. <?= number_format($alat['harga_harian'], 0, ',', '.') ?>/
                    </span>hari
                    </div>
                    </li>
                    <li
                      class="border-bottom p-2 d-flex justify-content-between"
                    >
                      <span>Sewa Mingguan</span>
                    <div class="rent-price mb-3"> 
                      <span style="font-size: 1rem" class="text-primary">
                        Rp. <?= number_format($alat['harga_mingguan'], 0, ',', '.') ?>/
                      </span>minggu
                    </div>
                    </li>
                    <li
                      class="border-bottom p-2 d-flex justify-content-between"
                    >
                      <span>Sewa Bulanan</span>
                    <div class="rent-price mb-3"> 
                      <span style="font-size: 1rem" class="text-primary">
                        Rp. <?= number_format($alat['harga_bulanan'], 0, ',', '.') ?>/
                      </span>bulan
                    </div>
                    </li>
                    
                    <li
                      class="border-bottom p-2 d-flex justify-content-between"
                    >
                      <span>Stok</span>
                      <span style="font-weight: 600">
                        <?= esc($alat['stok_default']) ?>
                      </span>
                    </li>
                  </ul>
                </div>
              </div>
              <!-- Product actions-->
              <div class="card-footer border-top-0 bg-transparent">
                <div class="text-center">
                  <a
                    class="btn d-flex align-items-center justify-content-center mt-auto"
                    href="https://wa.me/628977750564"
                    style="column-gap: 0.4rem; background-color: #128c7e; color: white"
                    >WhatsApp Kami <i class="ri-whatsapp-line"></i
                  ></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</body>
</html>
