<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Pelanggan;
use CodeIgniter\HTTP\ResponseInterface;

class PelangganController extends BaseController
{
    protected $pelanggan;
    public function __construct()
    {
        $this->pelanggan = new Pelanggan();
    }
    public function index()
    {
        return view('v_pelanggan');
    }
    public function tampil(){
        $plgn = $this->pelanggan->findAll();

        return $this->response->setJSON([
            'status' => 'success',
            'pelanggan'=>$plgn,
        ]);
    }
    public function simpan(){
        // $validation= \Config\Services::validation();
        // $validation->setRules([
        //     'nama_produk'=>'required',
        //     'harga'=>'required|decimal',
        //     'stok'=>'required|integer',
        // ]);

        // if (!$validation->withRequest($this->request)->run()) {
        //     return $this->response->setJSON([
        //         'status'=>'error',
        //         'errors'=>$validation->getErrors(),
        //     ]);
        // }
        $data=[
            'nama'=>$this->request->getVar('nama'),
            'alamat'=>$this->request->getVar('alamat'),
            'no_tlp'=>$this->request->getVar('no_tlp'),
        ];

        $this->pelanggan->save($data);

        return $this->response->setJSON([
            'status'=>'success',
            'message'=>'Data pelanggan berhasil di simpan',
        ]);
    }
    public function hapus(){
        $id= $this->request->getVar('id');
        $this->pelanggan->delete($id);
        return response()->setJSON([
            'message'=>'Data sudah dihapus'
        ]);
    }
    public function edit(){
        $data= $this->request->getVar();
        $this->pelanggan->update($data['id_pelanggan'],$data);
        return response()->setJSON(
            [
                "message"=>'data telah di update'
            ]
        );
    }
}
