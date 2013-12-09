<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * UserManage Class
 *
 * Manage Users.
 *
 * @package        	CodeIgniter
 * @subpackage    	Controller
 * @category    	Controller
 * @author        	Charles(xiezhenjiang@foxmail.com)
 * @license         http://www.gnu.org/licenses/gpl.html
 * @link			http://www.oserror.com
 */

class UserManage extends CI_Controller
{
	
	/**
	 * constructor for UserManage
	 * @access public
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * user search page
	 * @access public
	 */
	function search()
	{
		if($this->user->checkPrivilege('user_search') == false)
		{
			show_error("you have no privilege to access this page");
			return ;
		}
		
		$this->load->view('include/header');
		$this->load->view('include/nav');
		$this->load->view('user_search');
		$this->load->view('include/footer');
	}
	
	/**
	 * user edit page
	 * @access public
	 */
	function edit()
	{
		if($this->user->checkPrivilege('user_edit') == false)
		{
			show_error("you have no privilege to access this page");
			return ;
		}
	
		$this->load->view('include/header');
		$this->load->view('include/nav');
		$this->load->view('user_edit');
		$this->load->view('include/footer');
	}
	
	/**
	 * user add page
	 * @access public
	 */
	function add()
	{
		if($this->user->checkPrivilege('user_add') == false)
		{
			show_error("you have no privilege to access this page");
			return ;
		}
	
		$this->load->view('include/header');
		$this->load->view('include/nav');
		$this->load->view('user_add');
		$this->load->view('include/footer');
	}
	
	/**
	 * user delete page
	 * @access public
	 */
	function delete()
	{
		if($this->user->checkPrivilege('user_delete') == false)
		{
			show_error("you have no privilege to access this page");
			return ;
		}
	
		$this->load->view('include/header');
		$this->load->view('include/nav');
		$this->load->view('user_delete');
		$this->load->view('include/footer');
	}
}