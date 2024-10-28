<?php

class Produk extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->library('upload');
    $this->load->model('Produk_model');
  }

  public function index()
  {
    $search = $this->input->get('search');
    $limit = 3;
    $offset = $this->input->get('page') ? ($this->input->get('page') - 1) * $limit : 0;
    $data['produk'] = $this->Produk_model->get_all_product($limit, $offset, $search);
    $data['total_produk'] = $this->Produk_model->count_all_product($search);
    $data['total_halaman'] = ceil($data['total_produk'] / $limit);
    $data['search'] = $search; 
    $data['offset'] = $offset;  


    $this->load->view('produk/index', $data);
  }

  public function tambah()
  {
    $this->load->view('produk/tambah');
  }

  public function simpan()
  {
    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = 2048;

    $this->upload->initialize($config);

    if($this->upload->do_upload('gambar')) {
      $upload_data = $this->upload->data();
      $data = [
        'nama_produk' => $this->input->post('nama_produk'),
        'harga' => $this->input->post('harga'),
        'stok' => $this->input->post('stok'),
        'deskripsi' => $this->input->post('deskripsi'),
        'gambar' => $upload_data['file_name']
      ];

      $this->Produk_model->insert_produk($data);
      redirect('produk');
    } else {
      $error = $this->upload->display_errors();
      echo $error;
    }
  }

  public function edit($id)
  {
    $data['produk'] = $this->Produk_model->get_data_by_id($id);
    $this->load->view('produk/edit', $data);
  }

  public function update($id)
  {

    $produk_lama = $this->Produk_model->get_data_by_id($id);
    $data = [
      'nama_produk' => $this->input->post('nama_produk'),
      'harga' => $this->input->post('harga'),
      'stok' => $this->input->post('stok'),
      'deskripsi' => $this->input->post('deskripsi'),
    ];

    if(!empty($_FILES['gambar']['name'])) {
      if (file_exists('./uploads/'. $produk_lama->gambar)) {
        unlink('./uploads/'.$produk_lama->gambar);
      }

      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size'] = 2048;

      $this->upload->initialize($config);

      if($this->upload->do_upload('gambar')) {
        $upload_data = $this->upload->data();
        $data['gambar'] = $upload_data['file_name'];
      } else {
        $error = $this->upload->display_errors();
        echo $error;
        return;
      }
    }
    $this->Produk_model->update_produk($id, $data);
    redirect('produk');
  }

  public function hapus($id)
  {
    $produk = $this->Produk_model->get_data_by_id($id);

    if ($produk) {
      $foto_path = './uploads/'.$produk->gambar;
      if(file_exists($foto_path)) {
        unlink($foto_path);
      }
    }
    $this->Produk_model->delete_produk($id);
    redirect('produk');

  }

  
}