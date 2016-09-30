<?php
class Users_model extends CI_Model {
	public $email;
    public $password;

	public function __construct()
        {
        	parent::__construct();
            $this->load->database();
        }

        public function register_user($registration_form_data)
        {
        	$check = $this->db->select()->where("email", $registration_form_data["email"])->from('users_table')->count_all_results();
        	if (($check == 0) && ($registration_form_data["email"] != "") && ($registration_form_data["password"] != "")) {
        		
					$this->email = $registration_form_data["email"];
					$this->password = md5($registration_form_data["password"]);

					$this->db->insert('users_table', $this);
					if ($this->db->affected_rows() > 0) {
							return true;
						}
			} else {
				return false;
			}
        }

        public function login_user($credentials)
		{
			$mail = $credentials["email"];
			$pass = md5($credentials["password"]);

			$check = $this->db->select()->where("email",$mail)->where("password",$pass)->from("users_table")->count_all_results();
			if ($check > 0) {
				$result =  $this->db->select("id")->where("email",$mail)->where("password",$pass)->get("users_table");
				return $result->result_array();
			}
			else
			{
				return 0;
			}
		}

		public function get_all_users()
		{
			$result = $this->db->select('id,email')->get('users_table');
        	return $result->result_array();
		}

		public function get_user_list_by_ids($ids)
		{
			//var_dump($ids);
			$id_list = array();
			$result = array();
			foreach ($ids as $id) {
				var_dump($id);
				$id_list = $id['user'];
			}
			$query = $this->db->select('email')->where_in('id', $id_list)->get('users_table');
        	//$query->result_array();
        	foreach ($query->result_array() as $query_unit) {
        		var_dump($query_unit);
        		$result[] = $query_unit['email'];
        	}
        	return $result;
		}
}