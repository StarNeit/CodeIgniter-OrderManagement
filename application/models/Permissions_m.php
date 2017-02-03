<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Permissions_m extends MY_Model
{

	function get_items($role_code){
		$this->db->select()
			->from('admin_role_permissions')
		   	->where('role_code', $role_code);
		$query = $this->db->get();
		return $this->result_assoc($query, 'permission_code');
	}

	function save_permissions($role_code, $permissions){

		$this->db->delete('admin_role_permissions', array('role_code'=>$role_code));

		if($permissions){
			$insert = array();
			foreach($permissions as $permission){
				$insert[] = array(
								'role_code' => $role_code,
								'permission_code' => $permission
							);
			}

			return $this->db->insert_batch('admin_role_permissions', $insert);
		}
		return true;
	}

	function get_roles_links($admin_folder='admin'){

		$query = $this->db->from('admin_roles')
						->order_by('code')
						->get();
		$rows = $query->result();
		$result = array();
		foreach($rows as $row){
			$result["$admin_folder/permissions/index/$row->code"] = $row->name;
		}
		return $result;
	}
}


