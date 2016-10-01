<?php
class Channels_model extends CI_Model {
	public $user;
    public $channel_name;
    public $channel_description;

	public function __construct()
        {
        	parent::__construct();
            $this->load->database();
        }

    public function create_channel($channel_data)
    {
    	$check = $this->db->select()->where("channel_name", $channel_data["name"])->from('channels_table')->count_all_results();
    	if (($check == 0)&&($channel_data["name"] != "")) {
    		$this->user = $channel_data["user"];
    		$this->channel_name = $channel_data["name"];
    		$this->channel_description = $channel_data["description"];
    		$this->db->insert('channels_table', $this);
            return TRUE;
    	}
        else 
        {
            return FALSE;
        }
    }

    public function update_channel($id_channel_to_change, $new_data)
    {
    	$check = $this->db->select()->where("channel_name", $new_data["name"])->where("id !=", $id_channel_to_change)->from('channels_table')->count_all_results();
    	if (($check == 0) && ($new_data["name"] != "")) {
    		$data = array(
				'channel_name' => $new_data["name"],
				'channel_description' => $new_data["description"]
				);
    		$this->db->update('channels_table', $data, array('id' => $id_channel_to_change));
            return TRUE;
    	}
        else
        {
            return FALSE;
        }
    }

    public function get_channel_info($id)
    {
        $result = $this->db->select()->where('id', $id)->get('channels_table');
        return $result->result_array();
    }

    public function get_all_channels_of_user($user_id)
    {
        $result = $this->db->select()->where('user', $user_id)->get('channels_table');
        return $result->result_array();
    }

    public function get_channels_by_ids($subs, $searched_array)
    {
        $id_batch = array();
        foreach ($subs as $sub) {
            $id_batch[] = $sub['channel'];
        }
        if (empty($id_batch)) {
            return null;
        }
        else 
        {
            $this->db->select()->where_in('id', $id_batch);
            if ($searched_array !== "") {
                $this->db->like('channel_name', $searched_array);
            }
            $this->db->order_by('channel_name DESC, user DESC');
            $result = $this->db->get('channels_table');
            return $result->result_array();
        }   
    }

    public function get_channels_by_ids_exclusively($subs, $current_user, $searched_array)
    {
        $id_batch = array();
        foreach ($subs as $sub) {
            $id_batch[] = $sub['channel'];
        }
        $this->db->select()->where('user !=', $current_user);
        if (!empty($id_batch)) 
        {
            $this->db->where_not_in('id', $id_batch);
        }

        if ($searched_array !== "") {
            $this->db->like('channel_name', $searched_array);
        }

        $this->db->order_by('channel_name DESC, user DESC');
        $result = $this->db->get('channels_table');

        return $result->result_array();
    }

    public function get_all_nonuser_channels()
    {
        $result = $this->db->select()->where('user !=', $user_id)->get('channels_table');
        return $result->result_array();
    }

    public function get_all_channels()
    {
        $check = $this->db->get('channels_table');
    }

    public function delete_channel($id)
    {
    	$this->db->where('id', $id)->delete('channels_table');
    }
}