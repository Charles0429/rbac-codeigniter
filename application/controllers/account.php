<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Account Class
 *
 * Manage Rbac account related issues.
 *
 * @package        	CodeIgniter
 * @subpackage    	Controller
 * @category    	Controller
 * @author        	Charles(xiezhenjiang@foxmail.com)
 * @license         http://www.gnu.org/licenses/gpl.html
 * @link			http://www.oserror.com
 */

class Account extends CI_Controller
{
	
	
	/**
	 * construct
	 * @access public
	 */
	function __construct()
	{
		parent::__construct();
		
		//load the rbac model
		$this->load->model('rbac_model');
		
		//load user library
		$this->load->library('user');
	}
	
	/**
	 * login page
	 * @access public
	 */
	function index()
	{
		$this->load->view('include/header');
		$this->load->view('login_index');
		$this->load->view('include/footer');
	}
	
	/**
	 * check username, password and privilege
	 * @access public
	 */
	function validate()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		$md5_password = md5($password);
		
		$ret = $this->rbac_model->validateUser($username, $md5_password);
		$ret = intval($ret);
		switch($ret)
		{
			case 1:
				show_error("invalid username or password");
				return;
			case 2:
				show_error('you have not access privilege');
				return;
		}
		
		if($ret == 100)
		{
			$this->user->set_user_session($username);
			
			$user_search = base_url('manage/index');
			redirect($user_search);
		}
	}
	
	/**
	 * logout:destory session
	 * @access public
	 */
	function logout()
	{
		$this->user->delete_user_session();
		$this->index();
	}
}