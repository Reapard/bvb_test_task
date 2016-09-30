<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_task_tables extends CI_Migration {

	public function create_users_table()
	{
                $this->load->dbforge();
		$this->dbforge->add_field('id');
                $this->dbforge->add_field(array(
                        'email' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '80',
                                'unique' => TRUE
                        ),
                        'password' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '70'
                        )
                ));
        $this->dbforge->create_table('users_table');
	}

        public function create_channels_table()
        {
                $this->load->dbforge();
                $this->dbforge->add_field('id');
                $this->dbforge->add_field(array(
                        'user' => array(
                                'type' => 'INT',
                                'constraint' => '9'
                        ),
                        'channel_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '40'
                        ),
                        'channel_description' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '120'
                        )
                ));
        
        $this->dbforge->create_table('channels_table');
        }

	public function create_subscription_table(){
                $this->load->dbforge();
                $this->dbforge->add_field('id');
                $this->dbforge->add_field(array(
                        'user' => array(
                                'type' => 'INT',
                                'constraint' => '40'
                        ),
                        'channel' => array(
                                'type' => 'INT',
                                'constraint' => '40'
                        )
                ));

                $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (user) REFERENCES users_table(id)');
                $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (channel) REFERENCES channels_table(id)');
                $this->dbforge->create_table('subscriptions_table');

        }

	public function up()
        {
                $this->load->dbforge();
                $this->create_users_table();
                $this->create_channels_table();
                $this->create_subscription_table();
        }

        public function down()
        {
                $this->load->dbforge();
                $this->dbforge->drop_table('users_table');
                $this->dbforge->drop_table('channels_table');
                $this->dbforge->drop_table('subscriptions_table');
        }
}