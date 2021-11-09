<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$data = [
			'title' => 'Kegiatan',
			'active' => 'kegiatan',
		];
		home('home/kegiatan', $data);
	}
}
