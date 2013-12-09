<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Manage Class
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
class Manage extends CI_Controller
{
	/**
	 * index page for manage
	 * @access public
	 */
	function index()
	{
		$this->load->view('include/header');
		$this->load->view('include/nav');
		$this->load->view('manage_index');
		$this->load->view('include/footer');
	}
}