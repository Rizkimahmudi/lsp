<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends MY_HomeController {
	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model([
			'lsp_admin'
		]);
	}
	
	public function login(){
		$error = false; 
		
		// 2. jika sudah di isi username dan password
		if (isPost()){
			// 3. melakukan validasi terhadap input 
			$this->form_validation->set_rules('user', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			
			// 4. jika validasi lolos
			if ($this->form_validation->run() != false){
				// 5. mengecek apakah pada tabel admin terdapat data dengan user dan password yg diinputkan
				$user = lsp_admin::where('id_admin', $this->input->post('user',TRUE))
								->where('password', md5($this->input->post('password', TRUE)))
								->first();
				
				// 6. jika terdapat data pada tabel, mengisikan data tersebut kedalam session login
				if ($user){
					
					$this->session->set_userdata('login', $user->toArray());
					
					$this->login = $user->toArray();
					
					// 7. melakukan redirect kembali ke halaman awal setelah sukses login
					
					redirect(site_url());	
				} else {

					// 8. jika gagal login / data tidak ditemukan, kembali ke halaman login beserta peringatan error
					$error = [
						'system'	=> 'User atau password anda salah'
					];
				}
			} 
			
		}
		
		$data = [
			'errors'	=> $error,
		];
		// 1. menampilkan halaman login/ form
		$this->load->view('login', $data);
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect(url());
	}
	
}

