<?php
class Dokumen_model extends CI_Model {

    public function add_dokumen($data) {
        $this->db->insert('dokumen_laporan_kasus', $data);
        return ($this->db->affected_rows() > 0) ? true : false;
    } 

    public function get_dokumen() {
       $this->db->select('dokumen_laporan_kasus.id,dokumen_laporan_kasus.id_laporan,dokumen_laporan_kasus.nomor_lp,dokumen_laporan_kasus.nomor_kk,
       	dokumen_laporan_kasus.file1,dokumen_laporan_kasus.file2,dokumen_laporan_kasus.file3,dokumen_laporan_kasus.file4,dokumen_laporan_kasus.file5, laporan_kasus.nama_pelapor');
       $this->db->from('dokumen_laporan_kasus');
       $this->db->join('laporan_kasus','dokumen_laporan_kasus.id_laporan=laporan_kasus.id');
       $query = $this->db->get();
        return $query->result();
    }

    public function update_dokumen($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('dokumen_laporan_kasus', $data);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function delete_dokumen($id) {
        $this->db->where('id', $id);
        $this->db->delete('dokumen_laporan_kasus');
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function is_nomor_lp_exists($nomor_lp) {
        $this->db->where('nomor_lp', $nomor_lp);
        $query = $this->db->get('dokumen_laporan_kasus');
        return $query->num_rows() > 0;
    }

}
?>
