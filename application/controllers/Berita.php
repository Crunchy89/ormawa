<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$data = [
			'title' => 'Berita',
			'active' => 'berita',
		];
		home('home/berita', $data);
	}
}
