<?php
class Main_ctrl extends CI_Controller {

	public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
                $this->load->library(array('session', 'template', 'migration','pagination'));
                $this->load->model('bvb_task/subscriptions_model');
                $this->load->model('bvb_task/users_model');
                $this->load->model('bvb_task/channels_model');
        }

    public function index($searched_name = "", $searched_user = "")
    	{
        	if ($this->migration->current() === FALSE)
                {
                        show_error($this->migration->error_string());
                }
            $main_page_data = array(); 
            if (isset($_SESSION['logged_in'])) {
                $subscription_ids = $this->subscriptions_model->get_all_subscriptions_for_user($_SESSION['logged_in']['id']);
                $main_page_data['subscribed_channels'] = $this->channels_model->get_channels_by_ids($subscription_ids, $searched_name, $searched_user);
                $main_page_data['nonsubscribed_channels'] = $this->channels_model->get_channels_by_ids_exclusively($subscription_ids, $_SESSION['logged_in']['id'], $searched_name, $searched_user);
            }

            $main_page_data['s_channel'] = $searched_name;
            $main_page_data['s_user'] = $searched_user;

        	$this->template->addSection("bvb_task/header", "header");
            $this->template->addSection("bvb_task/side_menu", "left");
		    $this->template->addSection("bvb_task/list", "center", $main_page_data);
            $this->template->addSection("bvb_task/scripts_view", "footer");
    		$this->template->render("Test application");
        }

    public function profile()
    {
    	$profile_data['user_channels'] = $this->channels_model->get_all_channels_of_user($_SESSION['logged_in']['id']);
    	$profile_data['subscribers'] = array();

        if (!empty($profile_data['user_channels'])) {
            foreach ($profile_data['user_channels'] as $channel) {
                $sub_ids = $this->subscriptions_model->get_all_subscribers_for_channel($channel['id']);
                if (!empty($sub_ids)) {
                    $subscribers = $this->users_model->get_user_list_by_ids($sub_ids);
                    $profile_data['subscribers'][] = $subscribers;
                }
                else
                {
                    $profile_data['subscribers'][] = array("No subscribers yet");
                }
            }
        }
    	$this->template->addSection("bvb_task/header", "header");
        $this->template->addSection("bvb_task/side_menu", "left");
		$this->template->addSection("bvb_task/profile_view", "center", $profile_data);
        $this->template->addSection("bvb_task/right_menu_view", "right");
        $this->template->addSection("bvb_task/scripts_view", "footer");
    	$this->template->render("Test application");
    }

    public function search()
    {
        $searched_name = $this->input->post('chan_name');
        $searched_user = $this->input->post('user_name');
        redirect('main_ctrl/index/'.$searched_name, 'refresh');
    } 
}
