<?php
class Subscriptions_model extends CI_Model {
	public $user;
	public $channel;

	public function __construct()
        {
        	parent::__construct();
            $this->load->database();
        }

    public function add_sub_for_user($user_id, $channel_id)
    {
    	$this->user = $user_id;
    	$this->channel = $channel_id;
    	$this->db->insert('subscriptions_table', $this);
    }

    public function delete_sub($channel_id, $user_id)
    {
    	$this->db->where('user', $user_id)->where('channel', $channel_id)->delete('subscriptions_table');
    }

    public function get_all_subscriptions_for_user($user_id)
    {
    	$result = $this->db->select()->where('user',$user_id)->get('subscriptions_table');
    	return $result->result_array();
    }

    public function get_all_subscribers_for_channel($channel_id)
    {
    	$result = $this->db->select('user')->where('channel',$channel_id)->get('subscriptions_table');
    	return $result->result_array();
    }
}