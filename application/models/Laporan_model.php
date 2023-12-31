<?php
class Laporan_model extends CI_Model {

   public function add_laporan($data) {

        $this->db->insert('laporan_kasus', $data);
        return true; // Return true jika berhasil
}

    // Fungsi untuk mengambil data laporan kasus (Read)
    public function get_laporan() {
        return $this->db->get('laporan_kasus')->result();
    }

    // models/Laporan_model.php

    public function is_nomor_lp_exists($nomor_lp) {
        $this->db->where('nomor_lp', $nomor_lp);
        $query = $this->db->get('laporan_kasus');
        return $query->num_rows() > 0;
    }


    // Fungsi untuk mengambil data laporan kasus berdasarkan ID (Read)
    public function get_laporan_by_id($id) {
        return $this->db->get_where('laporan_kasus', array('id' => $id))->row();
    }

    // Fungsi untuk memperbarui data laporan kasus (Update)
    public function update_laporan($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('laporan_kasus', $data);
        return true;
    }

    // Fungsi untuk menghapus laporan kasus (Delete)
    public function delete_laporan($id) {
        $this->db->where('id', $id);
        $this->db->delete('laporan_kasus');
        return true;
    }

   public function getGrafik()
    {
        $this->db->select('COUNT(laporan_kasus.nomor_lp) as value, MONTHNAME(laporan_kasus.tanggal_laporan) as label');
        $this->db->from('laporan_kasus');
        $this->db->group_by('MONTHNAME(laporan_kasus.tanggal_laporan)'); // Menambahkan GROUP BY di sini
        $query = $this->db->get()->result();
        return $query;
    }

    public function grafikChart()
    {
        $this->db->select("YEAR(tanggal_laporan) as year, COUNT(*) as count");
        $this->db->from('laporan_kasus');
        $this->db->group_by("YEAR(tanggal_laporan)");
        $query = $this->db->get()->result();
        return $query;
    }


}
