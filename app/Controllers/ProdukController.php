<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProdukController extends BaseController
{
    protected $produk;
    public function __construct()
    {
        $this->produk = new ProdukModel();
    }
    public function index()
    {
        return view('v_produk');
    }

    public function tampil(){
        $prdk= $this->produk->findAll();

        return $this->response->setJSON([
            'status'=>'success',
            'produk'=>$prdk
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
            'nama_produk'=>$this->request->getVar('nama_produk'),
            'harga'=>$this->request->getVar('harga'),
            'stok'=>$this->request->getVar('stok'),
        ];

        $this->produk->save($data);

        return $this->response->setJSON([
            'status'=>'success',
            'message'=>'Data produk berhasil di simpan',
        ]);
    }

    public function hapus(){
        $id= $this->request->getVar('id');
        $this->produk->delete($id);
        return response()->setJSON([
            'message'=>'Data sudah dihapus'
        ]);
    }

    public function edit(){
        $data= $this->request->getVar();
        $this->produk->update($data['produk_id'],$data);
        return response()->setJSON(
            [
                "message"=>'data telah di update'
            ]
        );
    }
}
