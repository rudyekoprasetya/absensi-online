<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_absensi extends CI_Model {

    public function insert($table, $data) {
        return $this->db->insert($table, $data);
    }

    public function get_all($table) {
        return $this->db->get($table);
    }

    public function get_where($table, $where) {
        return $this->db->get_where($table, $where);
    }

    public function get_filter($table, $where, $order_by, $select = '*') {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where);
        $this->db->order_by($order_by);
        return $this->db->get();
    }

    public function update($table, $data, $where) {
        $this->db->set($data, null);
        $this->db->where($where);
        $this->db->update($table);
        return $this->db->affected_rows();
    }

    public function delete($table, $where) {
        $this->db->where($where);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }

    public function total_rows($table) {
        return $this->db->count_all_results($table);
    }

    public function maxdata($id, $table) {
        $data = $this->db->select_max($id, 'lastid');
        $data = $this->db->get($table);
        return $data;
    }

    public function get_limit($table, $from, $to) {
        return $data = $this->db->get($table, $from, $to);
    }

    public function cek($email,$pass) { 
		 $this->db->where('email',$email);
		 $this->db->where('password',$pass);
		 $data=$this->db->get('tb_user');
		 if ($data->num_rows() > 0) {
		 	return TRUE;		
		 	}
		 else {
			return FALSE;	 	
		 	}
	}

	public function cek_admin($admin,$password) {
		 $this->db->where('admin',$admin);
		 $this->db->where('password',$password);
		 $data=$this->db->get('tb_admin');
		 if ($data->num_rows() > 0) {
		 	return TRUE;		
		 } else {
			return FALSE;	 	
		 }
	}

    public function cari_user($key) {
        $query="SELECT a.id_user, a.email, a.nama, a.gender, a.hp, a.is_login, b.jenis, a.is_aktif FROM tb_user a JOIN tb_jenis b ON a.id_jenis=b.id_jenis WHERE a.is_aktif='no' AND a.email LIKE '%$key%'";
        return $this->db->query($query);
    }

    public function lapAbsenByUser($id_user=null){
        $query="SELECT a.id_absen, a.id_user, b.nama, c.tipe_absen, d.status, DATE_FORMAT(a.tanggal, '%W') AS hari, d.set_waktu AS default_waktu, a.tanggal, a.waktu, a.lng, a.lat, a.is_valid FROM tb_absensi a JOIN tb_user b ON a.id_user=b.id_user JOIN tb_tipe c ON a.id_tipe=c.id_tipe JOIN tb_status d ON a.id_status=d.id_status WHERE a.id_user='$id_user' ORDER BY a.tanggal DESC";
        return $this->db->query($query);
    }

    public function lapAbsenRange($awal,$akhir,$id_user){
        $query="SELECT a.id_absen, a.id_user, b.nama, c.tipe_absen, d.status, DATE_FORMAT(a.tanggal, '%W') AS hari, d.set_waktu AS default_waktu, a.tanggal, a.waktu, a.lng, a.lat, a.is_valid FROM tb_absensi a JOIN tb_user b ON a.id_user=b.id_user JOIN tb_tipe c ON a.id_tipe=c.id_tipe JOIN tb_status d ON a.id_status=d.id_status WHERE DATE_FORMAT(a.tanggal,'%Y-%m-%d')>='$awal' AND DATE_FORMAT(a.tanggal,'%Y-%m-%d')<='$akhir' AND a.id_user='$id_user'";
        return $this->db->query($query);
    }

    public function lapIzinByUser($id_user=null) {
        $query="SELECT a.id_izin, a.id_user, b.nama, a.tanggal, a.alasan FROM tb_izin a JOIN tb_user b ON a.id_user=b.id_user WHERE a.id_user='$id_user' ORDER BY a.tanggal DESC";
        return $this->db->query($query);
    }

    public function lapIzinRange($awal,$akhir,$id_user) {
        $query="SELECT a.id_izin, a.id_user, b.nama, a.tanggal, a.alasan FROM tb_izin a JOIN tb_user b ON a.id_user=b.id_user WHERE DATE_FORMAT(a.tanggal,'%Y-%m-%d')>='$awal' AND DATE_FORMAT(a.tanggal,'%Y-%m-%d')<='$akhir' AND a.id_user='$id_user' ORDER BY a.tanggal DESC";
        return $this->db->query($query);
    }
}
