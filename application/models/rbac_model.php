<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Rbac model
 *
 * Manage Rbac model related table.
 *
 * @package        	CodeIgniter
 * @subpackage    	Model
 * @category    	Model
 * @author        	Charles(xiezhenjiang@foxmail.com)
 * @license         http://www.gnu.org/licenses/gpl.html
 * @link			http://www.oserror.com
 */

class rbac_model extends CI_Model
{

	/**
 	 * @access public
 	 * @param String $username username
 	 * @param String $password password
 	 * @return 1:username not match password 2:user has no privilege to login 100:successfully login
 	 */
	function validateUser($username, $password)
	{
		$this->db->where('user_name', $username);
		$this->db->where('user_pass', $password);
	
		$query = $this->db->get('user');
	
		if($query->num_rows() == 0)
		{
			return 1;
		}
		else
		{
			//get the privilege of this user
			$user = $query->first_row();
			$user_shortname = $this->_getUserPriviledge($user->role_id);
		
			if($user_shortname == 'admin' || $user_shortname == 'editor')
			{
				return 100;
			}
			else
			{
				return 2;
			}	
		}
	}

	/**
	 * get user priviledge
	 * @access private
	 * @param Integer $role_id role id
	 * @return role shortname
 	 */
	function _getUserPriviledge($role_id)
	{
		$this->db->where('role_id', $role_id);
	
		$query = $this->db->get('role');
		if($query->num_rows())
		{
			return $query->first_row()->role_shortname;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * get user information
	 * @param String $username username
	 * @return user information
 	 */
	function getUserByUsername($username)
	{
		$this->db->where('user_name', $username);
		
		$query =  $this->db->get('user');
		if($query->num_rows() > 0)
		{
			return $query->first_row();
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * get user submenu
	 * @param String $username username
	 * @return user menu
	 */
	function getUserSubMenuByUsername($username)
	{
		$sql = "select menu.* from user, role, role_privilege, privilege, menu
				where user.user_name= ? and 
				user.role_id = role.role_id and 
				role.role_id = role_privilege.role_id and 
				role_privilege.privilege_id = privilege.privilege_id and 
				privilege.menu_id = menu.menu_id";
		
		$query = $this->db->query($sql, array($username));
		
		
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $menu)
			{
				$menus[] = $menu;
			}
			return $menus;
		}
		else 
		{
			return false;
		}
		
	}
	
	/**
	 * get menu parent
	 * @param Integer $sub_menu_id submenu id
	 * @return parent menu info
	 */
	function getParentMenu($sub_menu_id)
	{
		$this->db->where('menu_id', $sub_menu_id);
		
		$parent = $this->db->get('menu');
		if($parent->num_rows() > 0)
		{
			$parent_id = $parent->first_row()->parent_id;
			
			$this->db->where('menu_id', $parent_id);
			$menu = $this->db->get('menu');
			
			return $menu->first_row();
		}
	}
	
	/**
	 * get user all menus
	 * @param String $username username
	 * @return user menus
	 */
	function getUserAllMenuByUsername($username)
	{
		$sub_menus = $this->getUserSubMenuByUsername($username);		
		
		foreach($sub_menus as $sub_menu)
		{
			$parent_menu = $this->getParentMenu($sub_menu->menu_id);
			if(!isset($all_menu[$parent_menu->menu_id]))
			{
				$all_menu[$parent_menu->menu_id] = array('parent_title' => $parent_menu->menu_title );
			}
			
			$sub_menu_item['title'] = $sub_menu->menu_title;
			$sub_menu_item['url'] = $sub_menu->menu_url;
			
			$all_menu[$parent_menu->menu_id][] = array('title' => $sub_menu_item['title'],
													   'url' => $sub_menu_item['url']
			);
		}
		
		return $all_menu;
	}
	
	/**
	 * check user privilege
	 * @access public
	 * @param String $username username
	 * @param String $action privilege action
	 * @return false or true
	 */
	function checkUserPrivilege($username, $action)
	{
		$sql = "select * from user, role, role_privilege, privilege
				where user.user_name = ? and
				user.role_id = role.role_id and
				role.role_id = role_privilege.role_id and
				role_privilege.privilege_id = privilege.privilege_id and
				privilege.action = ?";
		
		$query = $this->db->query($sql, array($username, $action));
		if($query->num_rows() > 0)
		{
			return true;
		}
		else 
		{
			return false;
		}
	}

}