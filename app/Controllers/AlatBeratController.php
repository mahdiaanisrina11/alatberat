<?php
namespace App\Controllers;
use App\Models\AlatBeratModel;
use App\Models\StokHarianModel;

class AlatBeratController extends BaseController {

    private function cekAksesAdmin()
{
    $user = session('user');
    if (!$user || $user['role'] !== 'admin') {
        return redirect()->to('/login')->with('error', 'Akses ditolak. Anda harus login sebagai admin.')->send();
    }
}

    public function index() {
        $akses = $this->cekAksesAdmin();
        if ($akses) {
            return $akses; // kalau bukan admin, langsung redirect
        }    

        $model = new AlatBeratModel();
        $data['alatberat'] = $model->findAll();
        return view('alatberat/index', $data);
    }

    public function lihatAlatBerat()
    {
        $model = new AlatBeratModel();
        $data['alatberat'] = $model->findAll();
        return view('alatberat/lihat_alat', $data);
    }

    public function create() {
        $akses = $this->cekAksesAdmin();
        if ($akses) {
            return $akses; // kalau bukan admin, langsung redirect
        }    
        return view('alatberat/create');
    }

    public function store() {
        $akses = $this->cekAksesAdmin();
        if ($akses) {
            return $akses; // kalau bukan admin, langsung redirect
        }
    
        try {
            $model = new \App\Models\AlatBeratModel();
    
            // ambil file gambar
            $gambar = $this->request->getFile('gambar');
    
            // Pastikan file gambar tidak null
            if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
                // generate nama random untuk menghindari bentrok
                $namaGambar = $gambar->getRandomName();
                // simpan gambar ke folder public/uploads/
                $gambar->move('public/uploads', $namaGambar);
            } else {
                $namaGambar = null; // jika tidak ada gambar atau ada masalah
            }
    
            $data = [
                'nama' => $this->request->getPost('nama'),
                'stok_default' => $this->request->getPost('stok_default'),
                'harga_jaman' => $this->request->getPost('harga_jaman'),
                'harga_harian' => $this->request->getPost('harga_harian'),
                'harga_mingguan' => $this->request->getPost('harga_mingguan'),
                'harga_bulanan' => $this->request->getPost('harga_bulanan'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'gambar' => $namaGambar, // simpan nama file gambar
            ];
    
            log_message('debug', 'Data to insert: ' . print_r($data, true));
            $model->insert($data);
    
            return redirect()->to('/alatberat');
        } catch (\Exception $e) {
            log_message('error', 'Error inserting alat berat: ' . $e->getMessage());
            return $e->getMessage(); // sementara tampilkan error
        }
    }    
    
    public function edit($id) {
        $akses = $this->cekAksesAdmin();
        if ($akses) {
            return $akses; // kalau bukan admin, langsung redirect
        }    
        $model = new AlatBeratModel();
        $data['alat'] = $model->find($id);
        return view('alatberat/edit', $data);
    }
    public function detail($id){
        $model = new AlatBeratModel();
        $alat = $model->find($id);
        if (!$alat){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        return view('alatberat/detail' , ['alat' => $alat]);
        //$this->load->view("alatberat/detail", $data);
    }

    public function update($id) {
        $akses = $this->cekAksesAdmin();
        if ($akses) {
            return $akses; // kalau bukan admin, langsung redirect
        }
    
        $model = new AlatBeratModel();
        $alat = $model->find($id);
    
        if (!$alat) {
            throw new \Exception('Data tidak ditemukan');
        }
    
        $gambar = $this->request->getFile('gambar');
        $namaGambar = $alat['gambar']; // default: gambar lama
    
        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            // Kalau ada gambar baru diupload
            $namaGambar = $gambar->getRandomName();
            $gambar->move('public/uploads', $namaGambar);
    
            // (Optional) Hapus gambar lama kalau perlu
            if (!empty($alat['gambar']) && file_exists('public/uploads/' . $alat['gambar'])) {
                unlink('public/uploads/' . $alat['gambar']);
            }
        }
      
        $data = [
            'nama' => $this->request->getPost('nama'),
            'stok_default' => $this->request->getPost('stok_default'),
            'harga_jaman' => $this->request->getPost('harga_jaman'),
            'harga_harian' => $this->request->getPost('harga_harian'),
            'harga_mingguan' => $this->request->getPost('harga_mingguan'),
            'harga_bulanan' => $this->request->getPost('harga_bulanan'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'gambar' => $namaGambar, // simpan nama file gambar
        ];
    
        $model->update($id, $data);
    
        return redirect()->to('/alatberat');
    }
    
    public function delete($id) {
        $akses = $this->cekAksesAdmin();
        if ($akses) {
            return $akses; // kalau bukan admin, langsung redirect
        }    
        $model = new AlatBeratModel();
        $model->delete($id);
        return redirect()->to('/alatberat');
    }

    public function show($id) {
        $akses = $this->cekAksesAdmin();
        if ($akses) {
            return $akses; // kalau bukan admin, langsung redirect
        }    
        $alatModel = new AlatBeratModel();
        $stokModel = new StokHarianModel();

        $data['alat'] = $alatModel->find($id);
        $data['stok_harian'] = $stokModel->where('alat_berat_id', $id)->findAll();

        return view('alatberat/show', $data);
    }

    public function stok($id)
    {
        $akses = $this->cekAksesAdmin();
        if ($akses) {
            return $akses; // kalau bukan admin, langsung redirect
        }    
        $stokModel = new StokHarianModel();
        $tanggalAwal = $this->request->getPost('tanggal');
        $stok = $this->request->getPost('stok');
        $tipe = $this->request->getPost('tipe');
    
        $tanggal = new \DateTime($tanggalAwal);
    
        switch ($tipe) {
            case 'harian':
                $this->upsertStok($stokModel, $id, $tanggal->format('Y-m-d'), $stok);
                break;
    
            case 'mingguan':
                for ($i = 0; $i < 7; $i++) {
                    $tgl = clone $tanggal;
                    $tgl->modify("+$i day");
                    $this->upsertStok($stokModel, $id, $tgl->format('Y-m-d'), $stok);
                }
                break;
    
            case 'bulanan':
                $daysInMonth = (int) $tanggal->format('t');
                for ($i = 0; $i < $daysInMonth; $i++) {
                    $tgl = clone $tanggal;
                    $tgl->modify("+$i day");
                    $this->upsertStok($stokModel, $id, $tgl->format('Y-m-d'), $stok);
                }
                break;
        }
    
        return redirect()->to("/alatberat/show/$id");
    }
    
    private function upsertStok($model, $alatBeratId, $tanggal, $stok)
    {
        $akses = $this->cekAksesAdmin();
        if ($akses) {
            return $akses; // kalau bukan admin, langsung redirect
        }    
        $existing = $model->where([
            'alat_berat_id' => $alatBeratId,
            'tanggal' => $tanggal
        ])->first();
    
        if ($existing) {
            $model->update($existing['id'], ['stok' => $stok]);
        } else {
            $model->insert([
                'alat_berat_id' => $alatBeratId,
                'tanggal' => $tanggal,
                'stok' => $stok
            ]);
        }
    }

    public function updateDeleteStok($id)
{
    $akses = $this->cekAksesAdmin();
    if ($akses) {
        return $akses; // kalau bukan admin, langsung redirect
    }    
    $stokModel = new StokHarianModel();
    $action = $this->request->getPost('action');

    if ($action === 'update') {
        $stokData = $this->request->getPost('stok');
        foreach ($stokData as $stokId => $value) {
            $stokModel->update($stokId, ['stok' => $value]);
        }
    }

    if ($action === 'delete') {
        $deleteIds = $this->request->getPost('delete_ids');
        if ($deleteIds) {
            foreach ($deleteIds as $stokId) {
                $stokModel->delete($stokId);
            }
        }
    }

    return redirect()->to("/alatberat/show/$id");
}

public function daftar()
{
    $akses = $this->cekAksesAdmin();
    if ($akses) {
        return $akses; // kalau bukan admin, langsung redirect
    }

    $pesananModel = new \App\Models\PesananModel();

    $pesananList = $pesananModel
        ->orderBy("
            CASE 
                WHEN status_pembayaran = 'sudah dibayar' AND status_sewa = 'berjalan' THEN 1
                WHEN status_pembayaran = 'menunggu pembayaran' AND status_sewa = 'berjalan' THEN 2
                WHEN status_pembayaran = 'sudah dibayar' AND status_sewa = 'selesai' THEN 3
                ELSE 4
            END, created_at DESC
        ", '', false)
        ->findAll();

    return view('alatberat/daftar', ['pesananList' => $pesananList]);
}

public function updateStatus()
{
    $akses = $this->cekAksesAdmin();
    if ($akses) {
        return $akses; // kalau bukan admin, langsung redirect
    }    
    $pesananModel = new \App\Models\PesananModel();

    $id = $this->request->getPost('id');
    $status_pembayaran = $this->request->getPost('status_pembayaran');
    $status_sewa = $this->request->getPost('status_sewa');

    $pesananModel->update($id, [
        'status_pembayaran' => $status_pembayaran,
        'status_sewa' => $status_sewa,
    ]);

    return redirect()->to('/pesanan/daftar')->with('success', 'Status berhasil diperbarui.');
}


    
}
