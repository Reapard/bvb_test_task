<?php
class Subscriptions extends CI_Controller {
	public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url', 'file'));
                $this->load->library(array('session', 'template', 'migration','pagination'));
                $this->load->model('bvb_task/subscriptions_model');
                $this->load->model('bvb_task/users_model');
                $this->load->model('bvb_task/channels_model');
        }

    public function subscribe($channel_id)
    {
    	$this->subscriptions_model->add_sub_for_user($_SESSION['logged_in']['id'], $channel_id);
    	redirect('main_ctrl', 'refresh');
    }

    public function unsubscribe($channel_id)
    {
    	$this->subscriptions_model->delete_sub($channel_id, $_SESSION['logged_in']['id']);
    	redirect('main_ctrl', 'refresh');
    }
}