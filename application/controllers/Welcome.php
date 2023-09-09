<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		 // Fungsi untuk menampilkan daftar laporan kasus (Read)
        $this->load->view('header');
        $this->load->view('menu');
        $this->load->view('index');
        $this->load->view('footer');
    }
	
}
