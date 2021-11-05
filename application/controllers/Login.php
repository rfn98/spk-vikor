<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function index()
	{
		$this->load->view('Loginv');
	}

	public function auth(){
		$result = $this->db->get_where('login', ['nama_user' => $_POST['username'], 'password_user' => md5($_POST['password'])])->result();
		if (!count($result)) echo "
			<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
			<script type='text/javascript'>
				setTimeout(() => Swal.fire({
					title: 'Username Atau Password Salah!',
					icon: 'error'
				}).then((result) => {
					if (result.isConfirmed) window.location = 'http://localhost/spk_vikor/login'
				}), 500)
			</script>
		"; else return redirect('/');
	}	
}
?>