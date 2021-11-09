<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tutorial extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$data = [
			'title' => 'Tutorial',
			'active' => 'tutorial',
		];
		home('home/tutorial', $data);
	}
}
