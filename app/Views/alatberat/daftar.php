<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/alatberat.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
</head>
<body class="form-page">

<div class="table-container">
    <h2 class="text-center mb-4">📋 Daftar Pesanan</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <table class="table table-bordered table-striped align-middle text-center">
    <div class="mb-4">

<div class="d-flex justify-content-center mb-2 gap-3 flex-wrap">
    <select id="monthFilter" class="form-select w-auto">
        <option value="">Semua Bulan</option>
        <option value="01">Januari</option>
        <option value="02">Februari</option>
        <option value="03">Maret</option>
        <option value="04">April</option>
        <option value="05">Mei</option>
        <option value="06">Juni</option>
        <option value="07">Juli</option>
        <option value="08">Agustus</option>
        <option value="09">September</option>
        <option value="10">Oktober</option>
        <option value="11">November</option>
        <option value="12">Desember</option>
    </select>

    <input type="text" id="searchInput" class="form-control w-auto" style="min-width: 300px;" placeholder="Cari nama customer, alat, atau VA...">
</div>

<div class="d-flex justify-content-center gap-2 mb-4">
    <a href="<?= base_url('/alatberat') ?>" class="btn btn-success btn-sm">
        <i class="bi bi-house-door me-2"></i> Home
    </a>

    <button class="btn btn-primary btn-sm w-auto" onclick="downloadExcel()">
    <i class="bi bi-download me-2"></i> Download Excel
</button>
</div>

        <thead class="table-light">
            <tr>
                <th>Nama</th>
                <th>Telepon</th>
                <th>NIK</th>
                <th>Alamat</th>
                <th>VA</th>
                <th>Alat</th>
                <th>Tanggal</th>
                <th>Jumlah alat</th>
                <th>Durasi</th>
                <th>Total Harga</th>
                <th>Status Pembayaran</th>
                <th>Status Sewa</th>
                <th>Bukti</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($pesananList as $pesanan): ?>
                <tr class="pesanan-item">
                    <td><?= esc($pesanan['nama']) ?></td>
                    <td><?= esc($pesanan['telepon']) ?></td>
                    <td><?= esc($pesanan['nik']) ?></td>
                    <td><?= esc($pesanan['alamat']) ?></td>
                    <td><?= esc($pesanan['va']) ?></td>
                    <td><?= esc($pesanan['alat_nama']) ?></td>
                    <td><?= esc($pesanan['tanggal']) ?></td>
                    <td><?= esc($pesanan['jumlah']) ?></td>
                    <td><?= esc($pesanan['durasi']) . ' ' . ucfirst(esc($pesanan['satuan_waktu'])) ?></td>
                    <td>Rp<?= number_format($pesanan['total_harga']) ?></td>
                    <td>
                        <span class="badge <?= $pesanan['status_pembayaran'] == 'sudah dibayar' ? 'bg-success' : 'bg-warning' ?>">
                            <?= esc(ucwords($pesanan['status_pembayaran'])) ?>
                        </span>
                    </td>
                    <td>
                        <span class="badge <?= $pesanan['status_sewa'] == 'selesai' ? 'bg-success' : 'bg-primary' ?>">
                            <?= esc(ucwords($pesanan['status_sewa'])) ?>
                        </span>
                    </td>
                    <td class="text-center">
                <?php if (!empty($pesanan['bukti_pembayaran'])): ?>
                    <button class="btn btn-sm btn-primary view-bukti" data-bukti="<?= base_url('public/bukti/' . $pesanan['bukti_pembayaran']) ?>">
                        <i class="bi bi-eye"></i> View
                    </button>
                <?php else: ?>
                    <span class="text-muted">-</span>
                <?php endif; ?>
            </td>
                    <td>
                        <form method="post" action="<?= base_url('pesanan/update_status') ?>">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" value="<?= $pesanan['id'] ?>">

                            <select name="status_pembayaran" class="form-select form-select-sm mb-2">
                                <option value="menunggu pembayaran" <?= $pesanan['status_pembayaran'] == 'menunggu pembayaran' ? 'selected' : '' ?>>Menunggu Pembayaran</option>
                                <option value="sudah dibayar" <?= $pesanan['status_pembayaran'] == 'sudah dibayar' ? 'selected' : '' ?>>Sudah Dibayar</option>
                            </select>

                            <select name="status_sewa" class="form-select form-select-sm mb-2">
                                <option value="berjalan" <?= $pesanan['status_sewa'] == 'berjalan' ? 'selected' : '' ?>>Berjalan</option>
                                <option value="selesai" <?= $pesanan['status_sewa'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                            </select>

                            <button class="btn btn-sm btn-success w-100" type="submit">
                                <i class="bi bi-check-circle me-1"></i> Update
                            </button>
                            <button type="button" class="btn btn-sm btn-danger w-100 mt-1 download-pdf"
                                data-nama="<?= esc($pesanan['nama']) ?>"
                                data-telepon="<?= esc($pesanan['telepon']) ?>"
                                data-nik="<?= esc($pesanan['nik']) ?>"
                                data-alamat="<?= esc($pesanan['alamat']) ?>"
                                data-va="<?= esc($pesanan['va']) ?>"
                                data-alat="<?= esc($pesanan['alat_nama']) ?>"
                                data-tanggal="<?= esc($pesanan['tanggal']) ?>"
                                data-jumlah="<?= esc($pesanan['jumlah']) ?>"
                                data-durasi="<?= esc($pesanan['durasi']) . ' ' . ucfirst(esc($pesanan['satuan_waktu'])) ?>"
                                data-total="<?= number_format($pesanan['total_harga']) ?>"
                                data-status-bayar="<?= esc(ucwords($pesanan['status_pembayaran'])) ?>"
                                data-status-sewa="<?= esc(ucwords($pesanan['status_sewa'])) ?>"
                            >
                            <i class="bi bi-file-earmark-pdf"></i> PDF
</button>

                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="modal fade" id="buktiModal" tabindex="-1" aria-labelledby="buktiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="buktiModalLabel">Bukti Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body text-center">
        <img id="buktiImage" src="" alt="Bukti Pembayaran" class="img-fluid rounded shadow">
      </div>
    </div>
  </div>
</div>

    <script>
function filterTable() {
    const keyword = document.getElementById('searchInput').value.toLowerCase();
    const selectedMonth = document.getElementById('monthFilter').value;
    const pesananItems = document.querySelectorAll('.pesanan-item');

    pesananItems.forEach(function(item) {
        const text = item.innerText.toLowerCase();
        const tanggalCell = item.querySelector('td:nth-child(5)');
        const tanggalText = tanggalCell ? tanggalCell.innerText : '';

        const bulan = tanggalText.split('-')[1]; // Ini cocok untuk "2025-05-01"

        const matchKeyword = text.includes(keyword);
        const matchMonth = selectedMonth === '' || bulan === selectedMonth;

        if (matchKeyword && matchMonth) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
}

document.getElementById('searchInput')?.addEventListener('input', filterTable);
document.getElementById('monthFilter')?.addEventListener('change', filterTable);

document.getElementById('searchInput')?.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
    }
});
</script>

<script>
document.querySelectorAll('.view-bukti').forEach(function(button) {
    button.addEventListener('click', function() {
        const buktiUrl = this.getAttribute('data-bukti');
        document.getElementById('buktiImage').src = buktiUrl;
        const modal = new bootstrap.Modal(document.getElementById('buktiModal'));
        modal.show();
    });
});
</script>

<script>
function downloadExcel() {
    const table = document.querySelector("table");
    const workbook = XLSX.utils.table_to_book(table, { sheet: "Pesanan" });
    XLSX.writeFile(workbook, "daftar_pesanan.xlsx");
}
</script>

<script>
document.querySelectorAll('.download-pdf').forEach(button => {
    button.addEventListener('click', () => {
        
        document.getElementById('pdfNama').textContent = button.dataset.nama;
        document.getElementById('pdfTelepon').textContent = button.dataset.telepon;
        document.getElementById('pdfNIK').textContent = button.dataset.nik;
        document.getElementById('pdfAlamat').textContent = button.dataset.alamat;
        document.getElementById('pdfVA').textContent = button.dataset.va;
        document.getElementById('pdfAlat').textContent = button.dataset.alat;
        document.getElementById('pdfTanggal').textContent = button.dataset.tanggal;
        document.getElementById('pdfJumlah').textContent = button.dataset.jumlah;
        document.getElementById('pdfDurasi').textContent = button.dataset.durasi;
        document.getElementById('pdfTotal').textContent = button.dataset.total;
        document.getElementById('pdfStatusBayar').textContent = button.dataset.statusBayar;
        document.getElementById('pdfStatusSewa').textContent = button.dataset.statusSewa;

        const element = document.getElementById('pdfTemplate');
        element.style.display = 'block';

        setTimeout(() => {
            html2pdf().set({
                margin: 0.5,
                filename: `pesanan-${button.dataset.nama}.pdf`,
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
            }).from(element).save().then(() => {
                element.style.display = 'none'; 
            });
        }, 300);
    });
});
</script>

</div>

<div id="pdfTemplate" style="display: none; padding: 20px; font-family: Arial;">
    <h2>Detail Pesanan</h2>
    <p><strong>Nama:</strong> <span id="pdfNama"></span></p>
    <p><strong>Telepon:</strong> <span id="pdfTelepon"></span></p>
    <p><strong>NIK:</strong> <span id="pdfNIK"></span></p>
    <p><strong>Alamat:</strong> <span id="pdfAlamat"></span></p>
    <p><strong>VA:</strong> <span id="pdfVA"></span></p>
    <p><strong>Alat:</strong> <span id="pdfAlat"></span></p>
    <p><strong>Tanggal:</strong> <span id="pdfTanggal"></span></p>
    <p><strong>Jumlah Alat:</strong> <span id="pdfJumlah"></span></p>
    <p><strong>Durasi:</strong> <span id="pdfDurasi"></span></p>
    <p><strong>Total Harga:</strong> Rp<span id="pdfTotal"></span></p>
    <p><strong>Status Pembayaran:</strong> <span id="pdfStatusBayar"></span></p>
    <p><strong>Status Sewa:</strong> <span id="pdfStatusSewa"></span></p>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</html>
