<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kursus extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$data = [
			'title' => 'Kursus',
			'active' => 'kursus',
		];
		home('home/kursus', $data);
	}
}
