<?php
class Laporan extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Laporan_model');
    }

    public function laporanKasus() {
        $data['laporanKasus'] = $this->Laporan_model->get_laporan();
        $data['donat']        = $this->Laporan_model->getGrafik();
        $data['lineChart']        = $this->Laporan_model->grafikChart();
        $this->load->view('header');
        $this->load->view('menu');
        $this->load->view('laporanKasus/v_laporanKasus', $data);
        $this->load->view('footer');
    }

   public function add() {
        // Validasi nomor LP unik
        $nomor_lp = $this->input->post('nomor_lp');
        if ($this->Laporan_model->is_nomor_lp_exists($nomor_lp)) {
            // Nomor LP sudah ada dalam database, tampilkan pesan error
            $this->session->set_flashdata('error', 'Nomor LP sudah ada dalam sistem. Silahkan cek kembali Nomor LP yang Anda masukkan.');
        } else {
            // Validasi berhasil, lanjutkan dengan penyimpanan data
            $data = array(
                'nomor_lp'           => $nomor_lp,
                'nomor_kk'           => $this->input->post('nomor_kk'),
                'nama_pelapor'       => $this->input->post('nama_pelapor'),
                'tanggal_laporan'    => $this->input->post('tanggal_laporan'),
                'deskripsi_kasus'    => $this->input->post('deskripsi_kasus'),
                'status'             => 'Selesai'
            );

            if ($this->Laporan_model->add_laporan($data)) {
                // Data berhasil ditambahkan, tampilkan pesan sukses
                $this->session->set_flashdata('success', 'Data berhasil ditambahkan.');
            } else {
                // Data gagal ditambahkan, tampilkan pesan error
                $this->session->set_flashdata('error', 'Data gagal ditambahkan. Silakan cek koneksi database atau kesalahan dalam kode model.');
            }
        }

        redirect('laporan/laporanKasus');
    }

       public function edit($id) {
        // Ambil data dari formulir
        $data = array(
            'nomor_lp' => $this->input->post('nomor_lp'),
            'nomor_kk' => $this->input->post('nomor_kk'),
            'nama_pelapor' => $this->input->post('nama_pelapor'),
            'tanggal_laporan' => $this->input->post('tanggal_laporan'),
            'deskripsi_kasus' => $this->input->post('deskripsi_kasus')
        );

        if ($this->Laporan_model->update_laporan($id, $data)) {
            // Data berhasil diubah, tampilkan pesan sukses
            $this->session->set_flashdata('success', 'Data berhasil diubah.');
        } else {
            // Data gagal diubah, tampilkan pesan error
            $this->session->set_flashdata('error', 'Gagal mengubah data.');
        }
        redirect('laporan/laporanKasus');
    }



    // Fungsi untuk menghapus laporan kasus (Delete)
    public function delete($id) {
        if ($this->Laporan_model->delete_laporan($id)) {
            // Data berhasil dihapus, tampilkan pesan sukses
            $this->session->set_flashdata('success', 'Data berhasil dihapus.');
        } else {
            // Data gagal dihapus, tampilkan pesan error
            $this->session->set_flashdata('error', 'Gagal menghapus data.');
        }

        redirect('laporan/laporanKasus');
    }

}
