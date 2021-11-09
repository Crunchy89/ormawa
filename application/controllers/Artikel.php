<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Artikel extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$data = [
			'title' => 'Artike',
			'active' => 'artikel',
		];
		home('home/artikel', $data);
	}
}
