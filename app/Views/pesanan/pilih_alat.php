<h3>Alat Berat Tersedia Tanggal: <?= $tanggal ?></h3>
<?php foreach ($alatList as $alat): ?>
    <form method="post" action="/pesanan/pesan" class="border p-3 mb-2">
        <strong><?= esc($alat['nama']) ?></strong><br>
        <input type="hidden" name="alat_berat_id" value="<?= $alat['id'] ?>">
        <input type="hidden" name="tanggal" value="<?= $tanggal ?>">
        <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Pemesan" required>
        <input type="text" name="telepon" class="form-control mb-2" placeholder="No Telepon" required>
        <button class="btn btn-success">Pesan</button>
    </form>
<?php endforeach ?>
