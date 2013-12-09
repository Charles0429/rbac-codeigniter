<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * PostManage Class
 *
 * Manage Posts.
 *
 * @package        	CodeIgniter
 * @subpackage    	Controller
 * @category    	Controller
 * @author        	Charles(xiezhenjiang@foxmail.com)
 * @license         http://www.gnu.org/licenses/gpl.html
 * @link			http://www.oserror.com
 */

class PostManage extends CI_Controller
{
	
	/**
	 * constructor for PostManage
	 * @access public
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * post search page
	 * @access public
	 */
	function search()
	{
		if($this->user->checkPrivilege('post_search') == false)
		{
			show_error("you have no privilege to access this page");
			return ;
		}
		
		$this->load->view('include/header');
		$this->load->view('include/nav');
		$this->load->view('post_search');
		$this->load->view('include/footer');
	}
	
	/**
	 * post edit page
	 * @access public
	 */
	function edit()
	{
		if($this->user->checkPrivilege('post_edit') == false)
		{
			show_error("you have no privilege to access this page");
			return ;
		}
	
		$this->load->view('include/header');
		$this->load->view('include/nav');
		$this->load->view('post_edit');
		$this->load->view('include/footer');
	}
	
	/**
	 * post add page
	 * @access public
	 */
	function add()
	{
		if($this->user->checkPrivilege('post_add') == false)
		{
			show_error("you have no privilege to access this page");
			return ;
		}
	
		$this->load->view('include/header');
		$this->load->view('include/nav');
		$this->load->view('post_add');
		$this->load->view('include/footer');
	}
	
	/**
	 * post delete page
	 * @access public
	 */
	function delete()
	{
		if($this->user->checkPrivilege('post_delete') == false)
		{
			show_error("you have no privilege to access this page");
			return ;
		}
	
		$this->load->view('include/header');
		$this->load->view('include/nav');
		$this->load->view('post_delete');
		$this->load->view('include/footer');
	}
}