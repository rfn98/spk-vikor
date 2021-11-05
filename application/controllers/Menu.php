<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
    public function index()
	{
		$this->load->view('main');
		/*$this->load->view('Headerv');
		$this->load->view('Menuv');
		$this->load->view('Footerv');*/
	}
}
?>