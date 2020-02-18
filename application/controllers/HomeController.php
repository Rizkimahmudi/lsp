<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends MY_HomeController {
	private $limit = 25;
	private $page = 1;
	private $search = [];
	
	function __construct(){
		parent::__construct();
		$this->load->model([
			'lsp_mahasiswa',
			'lsp_asesor',
			'lsp_tuk',
			'lsp_skema',
			'lsp_detail_skema',
			'lsp_kompetensi',
			'lsp_dtl_kompetensi'
		]);
		$this->load->library(['tables','form_validation']);
		$this->checkLogin(['admin', 'manager', 'peserta']);
	}
	
	public function index(){
		$data = [
			'title'				=> 'Dashboard LSP',
			'header_title'		=> 'Dashboard LSP',
			'header_sub'		=> 'Start Here!',
			'active_menu'		=> ['dashboard'],
			'breadcrumbs'		=> [
				[
					'url'	=> url(),
					'text'	=> 'Dashboard',
					'class'	=> 'fa fa-home'
				],
			],
		];
		
		$this->render('blank', $data);
	}
	
}