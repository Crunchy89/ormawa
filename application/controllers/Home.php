<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	// fungsi yang pertama kali akan di load
	public function index()
	{
		$data = [
			'title' => 'Ukm STMIK Lombok'
		];
		home('home/index', $data);
	}
}
