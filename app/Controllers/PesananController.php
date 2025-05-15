<?php
namespace App\Controllers;
use App\Models\AlatBeratModel;
use App\Models\StokHarianModel;
use App\Models\PesananModel;

class PesananController extends BaseController
{
    private function cekLogin()
{
    if (!session('user')) {
        $data = $this->request->getPost(); // ambil semua POST sebelum redirect

        if (!empty($data)) {
            session()->set('pending_post', $data); // simpan semua data form sementara
        }

        $redirectUrl = $this->request->getPost('redirect_url') ?? current_url();
        session()->set('redirect_after_login', $redirectUrl);

        return redirect()->to('/login')->with('error', 'Anda harus login terlebih dahulu.');
    }
}
    
    public function index()
    {
        return view('pesanan/index', [
            'tanggal' => null,
            'alatList' => []
        ]);
    }
    
    public function cekKetersediaan()
    {
        $tanggal = $this->request->getPost('tanggal');
    
        $stokModel = new StokHarianModel();
        $alatModel = new AlatBeratModel();
    
        $stokTersedia = $stokModel->where('tanggal', $tanggal)
                                  ->where('stok >', 0)
                                  ->findAll();
    
        $alatList = [];
        if (!empty($stokTersedia)) {
            $alatIds = array_column($stokTersedia, 'alat_berat_id');
            $stokById = array_column($stokTersedia, 'stok', 'alat_berat_id');
            $alatList = $alatModel->whereIn('id', $alatIds)->findAll();
    
            foreach ($alatList as &$alat) {
                $alat['stok'] = $stokById[$alat['id']] ?? 0;
            }
        }
    
        return view('pesanan/index', [
            'tanggal' => $tanggal,
            'alatList' => $alatList
        ]);
    }    
    
    public function form($id)
    {
        $tanggal = $this->request->getGet('tanggal');
    
        $alatModel = new AlatBeratModel();
        $stokModel = new StokHarianModel();
    
        $alat = $alatModel->find($id);
        $stok = $stokModel->where('tanggal', $tanggal)
                          ->where('alat_berat_id', $id)
                          ->first();
    
        $alat['stok'] = $stok['stok'] ?? 0;
    
        return view('pesanan/form', [
            'tanggal' => $tanggal,
            'alat' => $alat
        ]);
    }

    public function checkout()
    {
        if ($redirect = $this->cekLogin()) return $redirect;
        
        $data = $this->request->getPost();
    
        if (empty($data)) {
            $data = session('pending_post') ?? [];
            session()->remove('pending_post');
        }
    
        if (empty($data)) {
            return redirect()->to('/pesanan')->with('error', 'Data form tidak ditemukan.');
        }
    
        $durasi = (int)$data['durasi'];
        $hargaSatuan = (int)$data['harga']; // harga berdasarkan pilihan tipe_sewa
        $jumlah = (int)$data['jumlah'];
        $totalHarga = $hargaSatuan * $durasi * $jumlah;
        $submitType = $data['submit'];
    
        $user = session('user');
    
        $pesanan = [
            'alat_berat_id' => $data['alat_id'],
            'alat_nama' => $data['alat_nama'],
            'tanggal' => $data['tanggal'],
            'durasi' => $durasi,
            'satuan_waktu' => $data['satuan_waktu'],
            'jumlah' => $jumlah,
            'harga_satuan' => $hargaSatuan,
            'total_harga' => $totalHarga,
            'user_id' => $user['id'],
            'email' => $user['email'],
            'status_pembayaran' => 'menunggu pembayaran',
            'status_sewa' => 'berjalan'
        ];
    
        if ($submitType === 'keranjang') {
            $keranjang = session()->get('keranjang') ?? [];
            $keranjang[] = $pesanan;
            session()->set('keranjang', $keranjang);
            return redirect()->to('/pesanan')->with('success', 'Ditambahkan ke keranjang!');
        }
    
        return view('pesanan/konfirmasi', [
            'data' => $pesanan,
            'total_harga' => $totalHarga
        ]);
    }    

    public function finalize()
{
    $postData = $this->request->getPost();
    $data = json_decode($postData['data'], true);
    $totalHarga = $postData['total_harga'];
    $nama = $postData['nama'];
    $telepon = $postData['telepon'];
    $nik = $postData['nik'];
    $alamat = $postData['alamat'];

    $pesananModel = new \App\Models\PesananModel();
    $user = session('user');

    if (!$user) {
        return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
    }

    // Generate VA berdasarkan email user
    $email = $user['email'];
    $hash = hash('sha256', $email);
    $binary = hex2bin($hash);
    $unpack = unpack('N*', $binary);
    $numberString = implode('', $unpack);
    $vaNumber = '88' . substr($numberString, 0, 14);

    $pesananModel->insert([
        'alat_berat_id' => $data['alat_berat_id'],
        'alat_nama' => $data['alat_nama'],
        'tanggal' => $data['tanggal'],
        'durasi' => $data['durasi'],
        'satuan_waktu' => $data['satuan_waktu'],
        'jumlah' => $data['jumlah'],
        'harga_satuan' => $data['harga_satuan'],
        'total_harga' => $totalHarga,
        'nama' => $nama,
        'telepon' => $telepon,
        'email' => $email,
        'va' => $vaNumber,
        'user_id' => $user['id'],
        'nik' => $nik,
        'alamat' => $alamat,
        'status_pembayaran' => 'menunggu pembayaran',
        'status_sewa' => 'berjalan',
        'created_at' => date('Y-m-d H:i:s')
    ]);

    $pesananId = $pesananModel->getInsertID();

    return redirect()->to('/pesanan/pembayaran/' . $pesananId);
}

public function pembayaran($id)
{
    $pesananModel = new \App\Models\PesananModel();
    $user = session('user');

    if (!$user) {
        return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $pesanan = $pesananModel
        ->where('id', $id)
        ->where('user_id', $user['id'])
        ->first();

    if (!$pesanan) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    if ($pesanan['status_pembayaran'] !== 'menunggu pembayaran') {
        return redirect()->to('/pesanan')->with('error', 'Pesanan ini sudah dibayar atau tidak valid.');
    }

    return view('pesanan/pembayaran', [
        'pesanan' => $pesanan,
        'vaNumber' => $pesanan['va'] // ambil VA dari database
    ]);
}



public function keranjang()
{
    $keranjang = session()->get('keranjang') ?? [];
    return view('pesanan/keranjang', ['keranjang' => $keranjang]);
}

public function hapusKeranjang($index)
{
    $keranjang = session()->get('keranjang') ?? [];
    unset($keranjang[$index]);
    session()->set('keranjang', array_values($keranjang));
    return redirect()->to('/keranjang')->with('success', 'Item dihapus dari keranjang');
}

public function selesaikanPesanan()
{
    $postData = $this->request->getPost();
    $keranjang = session()->get('keranjang') ?? [];
    $nama = $postData['nama'];
    $telepon = $postData['telepon'];
    $nik = $postData['nik'];
    $alamat = $postData['alamat'];
    $user = session('user');

    if (!$user) {
        return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
    }

    if (empty($keranjang)) {
        return redirect()->to('/pesanan')->with('error', 'Keranjang kosong.');
    }

    $pesananModel = new \App\Models\PesananModel();

    // Generate VA
    $email = $user['email'];
    $hash = hash('sha256', $email);
    $binary = hex2bin($hash);
    $unpack = unpack('N*', $binary);
    $numberString = implode('', $unpack);
    $vaNumber = '88' . substr($numberString, 0, 14);

    foreach ($keranjang as $item) {
        $pesananModel->insert([
            'alat_berat_id' => $item['alat_berat_id'],
            'alat_nama' => $item['alat_nama'],
            'tanggal' => $item['tanggal'],
            'durasi' => $item['durasi'],
            'satuan_waktu' => $item['satuan_waktu'],
            'jumlah' => $item['jumlah'],
            'harga_satuan' => $item['harga_satuan'],
            'total_harga' => $item['total_harga'],
            'nama' => $nama,
            'telepon' => $telepon,
            'nik' => $nik,
            'alamat' => $alamat,
            'email' => $email,
            'va' => $vaNumber,
            'user_id' => $user['id'],
            'status_pembayaran' => 'menunggu pembayaran',
            'status_sewa' => 'berjalan',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    session()->remove('keranjang');

    return redirect()->to('/pesanan/pembayaran-keranjang');
}


public function pembayaranKeranjang()
{
    $user = session('user');

    if (!$user) {
        return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $pesananModel = new \App\Models\PesananModel();

    // Ambil semua pesanan user yang belum dibayar
    $pesanan = $pesananModel
        ->where('user_id', $user['id'])
        ->where('status_pembayaran', 'menunggu pembayaran')
        ->findAll();

    if (empty($pesanan)) {
        return redirect()->to('/pesanan')->with('error', 'Tidak ada pesanan yang perlu dibayar.');
    }

    $vaNumber = $pesanan[0]['va'];

    $total = 0;
    foreach ($pesanan as $p) {
        $total += $p['total_harga'];
    }

    return view('pesanan/pembayaran_keranjang', [
        'pesanan' => $pesanan,
        'total' => $total,
        'vaNumber' => $vaNumber,
        'nama' => $pesanan[0]['nama'] // Nama dari pesanan pertama
    ]);
}

public function upload_bukti()
{
    $user = session('user');
    if (!$user) {
        return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $pesananModel = new \App\Models\PesananModel();

    // Validasi file
    $file = $this->request->getFile('bukti');
    if (!$file->isValid() || $file->getError() !== UPLOAD_ERR_OK) {
        return redirect()->back()->with('error', 'Gagal upload bukti pembayaran.');
    }

    // Validasi ekstensi gambar
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $ext = strtolower($file->getClientExtension());

    if (!in_array($ext, $allowedExtensions)) {
        return redirect()->back()->with('error', 'Format file tidak didukung. Hanya JPG, PNG, GIF, WEBP.');
    }

    // Generate nama file unik
    $newName = $file->getRandomName();

    // Pindahkan file ke public/bukti
    $file->move('public/bukti', $newName);

    // Update semua pesanan user yang belum dibayar
    $pesananModel->where('user_id', $user['id'])
        ->where('status_pembayaran', 'menunggu pembayaran')
        ->set('bukti_pembayaran', $newName)
        ->update();

    return redirect()->to('/')->with('success', 'Bukti pembayaran berhasil diupload!');
}

public function daftarUser()
{
    $pesananModel = new \App\Models\PesananModel();
    $userId = session('user')['id'];

    $data['pesananList'] = $pesananModel->where('user_id', $userId)
                                        ->where('status_sewa !=', 'selesai')
                                        ->findAll();

    return view('pesanan/daftar_user', $data);
}

public function historyUser()
{
    $pesananModel = new \App\Models\PesananModel();
    $userId = session('user')['id'];

    $data['pesananList'] = $pesananModel->where('user_id', $userId)
                                        ->where('status_sewa', 'selesai')
                                        ->findAll();

    return view('pesanan/history_user', $data);
}

public function batal($id)
{
    $pesananModel = new \App\Models\PesananModel();
    $userId = session('user')['id'];

    // Cek apakah pesanan memang milik user dan statusnya menunggu pembayaran
    $pesanan = $pesananModel->where('id', $id)
                             ->where('user_id', $userId)
                             ->where('status_pembayaran', 'menunggu pembayaran')
                             ->first();

    if ($pesanan) {
        $pesananModel->delete($id);
        return redirect()->to('/pesanan/daftar-user')->with('success', 'Pesanan berhasil dibatalkan.');
    } else {
        return redirect()->to('/pesanan/daftar-user')->with('error', 'Pesanan tidak dapat dibatalkan.');
    }
}


}
