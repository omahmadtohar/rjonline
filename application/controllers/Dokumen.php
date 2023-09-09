<?php
class Dokumen extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Dokumen_model');
        $this->load->model('Laporan_model');
    }

    // Fungsi untuk menampilkan daftar dokumen
    public function dokumenKasus() {
        $data['dokumenKasus'] = $this->Dokumen_model->get_dokumen();
         $data['laporanKasus'] = $this->Laporan_model->get_laporan();
        $this->load->view('header');
        $this->load->view('menu');
        $this->load->view('dokumenLaporan/v_dokumenLaporanKasus', $data);
        $this->load->view('footer');
    }

 // Di dalam controller Anda
public function add() {
    $this->load->library('upload');

    $config['upload_path'] = './images/';
    $config['allowed_types'] = 'pdf';
    $config['max_size'] = 5120; // Maksimal 5 MB

    $this->upload->initialize($config);

    // Set aturan validasi untuk form
    $this->form_validation->set_rules('nomor_lp', 'Nomor LP', 'required');

    // Tambahkan aturan validasi untuk file
    for ($i = 1; $i <= 5; $i++) {
        $this->form_validation->set_rules('file' . $i, 'File ' . $i, 'callback_validate_pdf_upload');
    }

    if ($this->form_validation->run() == false) {
        // Validasi form gagal, tampilkan pesan error
        $this->session->set_flashdata('error', validation_errors());
        redirect('dokumen/dokumenKasus');
    } else {
        // Validasi form berhasil, cek unggahan file
        $file_names = array();
        $upload_failed = false;

        for ($i = 1; $i <= 5; $i++) {
            if (!empty($_FILES['file' . $i]['name'])) {
                if (!$this->upload->do_upload('file' . $i)) {
                    // Unggahan file gagal, tandai bahwa unggahan gagal
                    $upload_failed = true;
                    break;
                } else {
                    // Unggahan file berhasil, simpan nama file
                    $file_names['file' . $i] = $_FILES['file' . $i]['name'];
                }
            }
        }

        if ($upload_failed) {
            // Ada kesalahan dalam unggahan file, tampilkan pesan error
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('dokumen/dokumenKasus');
        } else {
            // Unggahan file berhasil
            $data = array(
                'nomor_lp' => $this->input->post('nomor_lp'),
                'nomor_kk' => $this->input->post('nomor_kk'),
                'id_laporan' => $this->input->post('id_laporan'),
            );

            // Tambahkan nama file ke dalam data jika file diunggah
            foreach ($file_names as $field_name => $file_name) {
                $data[$field_name] = $file_name;
            }

            if ($this->Dokumen_model->add_dokumen($data)) {
                // Data berhasil ditambahkan, tampilkan pesan sukses
                $this->session->set_flashdata('success', 'Dokumen berhasil ditambahkan.');
                redirect('dokumen/dokumenKasus');
            } else {
                // Data gagal ditambahkan, tampilkan pesan error
                $this->session->set_flashdata('error', 'Gagal menambahkan dokumen.');
                redirect('dokumen/dokumenKasus');
            }
        }
    }
}

public function validate_pdf_upload($str) {
    if (empty($_FILES[$str]['name'])) {
        // File tidak diunggah, abaikan validasi
        return true;
    }

    // Validasi file PDF
    $config['upload_path'] = './images/';
    $config['allowed_types'] = 'pdf';
    $config['max_size'] = 5120; // Maksimal 5 MB

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload($str)) {
        // Validasi file PDF gagal, atur pesan kesalahan
        $this->form_validation->set_message('validate_pdf_upload', $this->upload->display_errors());
        return false;
    }

    return true;
}




    // Fungsi untuk mengedit dokumen
    public function edit($id) {
        // Proses pengeditan dokumen

        if ($this->Dokumen_model->update_dokumen($id, $data)) {
            // Data berhasil diubah, tampilkan pesan sukses
            $this->session->set_flashdata('success', 'Dokumen berhasil diubah.');
        } else {
            // Data gagal diubah, tampilkan pesan error
            $this->session->set_flashdata('error', 'Gagal mengubah dokumen.');
        }

        redirect('dokumen');
    }

    // Fungsi untuk menghapus dokumen
    public function delete($id) {
        if ($this->Dokumen_model->delete_dokumen($id)) {
            // Data berhasil dihapus, tampilkan pesan sukses
            $this->session->set_flashdata('success', 'Dokumen berhasil dihapus.');
        } else {
            // Data gagal dihapus, tampilkan pesan error
            $this->session->set_flashdata('error', 'Gagal menghapus dokumen.');
        }

        redirect('dokumen/dokumenKasus');
    }
}
?>
