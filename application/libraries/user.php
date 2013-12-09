<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * user class
 *
 * Manage logged user information.
 *
 * @package        	CodeIgniter
 * @subpackage    	Library
 * @category    	Library
 * @author        	Charles(xiezhenjiang@foxmail.com)
 * @license         http://www.gnu.org/licenses/gpl.html
 * @link			http://www.oserror.com
 */

class User
{
	
	/**
	 *@access private
	 */
	private $_CI;
	
	/**
	 * construct of user class
	 * @access public
	 */
	function __construct()
	{
		$this->_CI = &get_instance();
	}

	/**
	 * set user session
 	* @access public
 	* @param String $username username
 	*/
	function set_user_session($username)
	{
		$user['username'] = $username;
		$session = array('user'=>$user);
		
		$this->_CI->session->set_userdata($session);
	}
	
	/**
	 * delete user session
	 * @access public
	 */
	function delete_user_session()
	{
		$this->_CI->session->sess_destroy();
	}
	
	/**
	 * get user name
	 * @return username
	 */
	function getUserName()
	{
		$user = $this->_CI->session->userdata('user');
		$username = $user['username'];
		return $username;
	}
	
	/**
	 * get user menu
	 * @access public
	 * @return user menus
	 */
	function getUserMenus()
	{
		$this->_CI->load->model('rbac_model');
		$username = $this->getUserName();
		$menus = $this->_CI->rbac_model->getUserAllMenuByUsername($username);
		return $menus;
	}
	
	/**
	 * check user privilege
	 * @access public
	 * @param String $action action
	 * @return true or false
	 */
	function checkPrivilege($action)
	{
		$this->_CI->load->model('rbac_model');
		$username = $this->getUsername();
		$privilege = $this->_CI->rbac_model->checkUserPrivilege($username, $action);
		
		return $privilege;
	}
	
}