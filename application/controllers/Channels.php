<?php
class Channels extends CI_Controller {
	public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
                $this->load->library(array('session', 'template'));

                $this->load->model('bvb_task/subscriptions_model');
                $this->load->model('bvb_task/users_model');
                $this->load->model('bvb_task/channels_model');
        }

    public function edit_chan_view($channel_id)
    {
        $channel_info['info'] = $this->channels_model->get_channel_info($channel_id);
        $this->template->addSection("bvb_task/header", "header");
        $this->template->addSection("bvb_task/side_menu", "left");
        $this->template->addSection("bvb_task/edit_channel", "center", $channel_info);
        $this->template->addSection("bvb_task/scripts_view", "footer");
        $this->template->render("Test application");
    }

    public function add_channel()
    {
       $this->load->library('form_validation');
     
       $this->form_validation->set_rules('chan_name', 'Channel name', 'required');
       $this->form_validation->set_rules('chan_desc', 'Description', 'callback_check_channel_on_create');
       if($this->form_validation->run() == FALSE)
       {
        $message = array(
            'message_type' => 'bg-danger',
            'message_body' => 'Invalid channel name'
            );
        $this->session->set_flashdata('channel_creation_message', $message);
        redirect('main_ctrl/profile', 'refresh');
       }
       else
       {
        $message = array(
            'message_type' => 'bg-success',
            'message_body' => 'Channel successfully added'
            );
        $this->session->set_flashdata('channel_creation_message', $message);
        redirect('main_ctrl/profile', 'refresh');
       }
    }

    public function check_channel_on_create()
    {
        $data = array(
            'user' => $_SESSION['logged_in']['id'],
            'name' => $this->input->post('chan_name'),
            'description' => $this->input->post('chan_desc'),
        );

        $result = $this->channels_model->create_channel($data);

        if ($result) {
        $this->form_validation->set_message('check_channel_on_create', 'Channel succesfully created');
        return TRUE;
        }
        else
       {
         $this->form_validation->set_message('check_channel_on_create', 'Channel with this name already exists');
         return FALSE;
       }
    }

    public function edit_channel($channel_id)
    {
       $this->load->library('form_validation');

       $this->session->set_userdata("edited_channel", $channel_id);
     
       $this->form_validation->set_rules('chan_name', 'Channel name', 'required|callback_check_channel_on_edit');

       if($this->form_validation->run() == FALSE)
       {
        $message = array(
            'message_type' => 'bg-danger',
            'message_body' => 'Invalid channel name'
            );
        $this->session->set_flashdata('channel_edit_message', $message);
        redirect('channels/edit_chan_view/'.$channel_id);
       }
       else
       {
        $message = array(
            'message_type' => 'bg-success',
            'message_body' => 'Channel successfully edited'
            );
        $this->session->set_flashdata('channel_edit_message', $message);
        $this->session->unset_userdata('edited_channel');
        redirect('main_ctrl/profile', 'refresh');
       }
    }

    public function check_channel_on_edit()
    {
        $data = array(
            'name' => $this->input->post('chan_name'),
            'description' => $this->input->post('chan_desc'),
        );

        $result = $this->channels_model->update_channel($_SESSION['edited_channel'], $data);

        if ($result) {
        $this->form_validation->set_message('check_channel_on_create', 'Channel succesfully created');
        return TRUE;
        }
        else
       {
         $this->form_validation->set_message('check_channel_on_create', 'Channel with this name already exists');
         return FALSE;
       }
    }
}