<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller 
{
	public function register()
	{
		
		//Validation for the registration page
		
		$this->form_validation->set_rules('first_name','First Name','trim|required|max_length[50]|min_length[2]|xss_clean');
		$this->form_validation->set_rules('last_name','Last Name','trim|required|max_length[50]|min_length[2]|xss_clean');
		$this->form_validation->set_rules('email','Email','trim|required|max_length[100]|min_length[5]|xss_clean|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('username','Username','trim|required|max_length[20]|min_length[5]|xss_clean|is_unique[users.username]');
		$this->form_validation->set_rules('password','Password','trim|required|max_length[20]|min_length[5]|xss_clean');
		$this->form_validation->set_rules('confirm_password','Confirm Password','trim|required|max_length[20]|min_length[5]|xss_clean|matches[password]');
		$this->form_validation->set_rules('dob','Date Of Birth','trim|required|xss_clean');
		$this->form_validation->set_rules('ssn','SSN','trim|required|max_length[9]|min_length[9]|xss_clean|is_unique[users.ssn]');
		$this->form_validation->set_rules('street','Street Address','trim|required|max_length[200]|min_length[2]|xss_clean');
		$this->form_validation->set_rules('city','City','trim|required|max_length[100]|min_length[2]|xss_clean');
		$this->form_validation->set_rules('state','State','trim|required|max_length[2]|min_length[2]|xss_clean');
		$this->form_validation->set_rules('zipcode','Zipcode','trim|required|max_length[5]|min_length[5]|xss_clean');
		$this->form_validation->set_rules('tel','Telphone','trim|required|max_length[10]|min_length[10]|xss_clean');
		
		if($this->form_validation->run() == FALSE)
			{
				$data['major'] = $this->admin_model->getAllMajor();
				$data['results'] = $this->admin_model->getDepCode();
				$data['main_content'] = 'users/register';
				$this->load->view('layouts/main',$data);
			}
		else
			{
				if($this->User_model->create_member())
				{
					if($this->session->userdata('logged_in') &&  $this->session->userdata('role') == 'Admin')
					{
						$data['major'] = $this->admin_model->getAllMajor();
						$data['results'] = $this->admin_model->getDepCode();
						$this->session->set_flashdata('registeredByAdmin','The User has been Created');
						redirect('users/register');
					}
					else
					{
						$this->session->set_flashdata('registered','You are now registered and you can log in');
						redirect('home/index');
					}
				}
				else
				{
					echo "There was an error registering this user Please Contact Technical Support at (516) 712 0231";
				}
			
			}
	}
	

	
	public function login()
	{
		$this->form_validation->set_rules('username','xss_clean');
		$this->form_validation->set_rules('password','xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			//do nothing | waiting for future modification
		}
		else
		{
			//Get from post
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			
			//Get user id from model
			$user_id = $this->User_model->login_user($username, $password);
			
			
			
			//Validate user
			if($user_id)
			{
				$user_data = array(
								'user_id'	=> $user_id['id'],
								'username'	=> $username,
								'role'		=> $user_id['role'],
								'logged_in' => TRUE
								);
				
				//Set session userdata
				$this->session->set_userdata($user_data);
				
				$data = array(
								'loginAttempts' => 0
							 );
						
				$this->db->where('username',$username);
				$update = $this->db->update('users',$data);
				
				$this->session->set_flashdata('login_success', 'You are now logged in');
				
				switch($user_data['role'])
				{
					case "admin" 	:
						redirect('admin_register/index');
						break;
					case "student" 	:
						echo("Student Logged in Successfully");
						break;
					case "faculty" 	:
						echo("faculty Logged in Successfully");
						break;
					default:
						redirect('home/index');
						break;
				}
				
			}
			else
			{
				
				//Login Attempts
				$this->db->where('username',$username);
				$usernameCheck = $this->db->get('users');
				if($usernameCheck->num_rows()>0)
				{
					if($usernameCheck->row(0)->accountStatus == "locked")
					{
						$this->session->set_flashdata('login_failed', 'Sorry, Your Account has been locked please contact your system admin');
						redirect('home/index');				
					}
					if($usernameCheck->row(0)->loginAttempts <= 2)
					{
						$data = array(
										'loginAttempts' => $usernameCheck->row(0)->loginAttempts + 1
									  );
						
						$this->db->where('username',$username);
						$update = $this->db->update('users',$data);
						$this->session->set_flashdata('login_failed', 'Sorry, the login info that you entered is invalid');
						redirect('home/index');
					}
					else
					{
						$data = array('accountStatus'=>'locked');
						$this->db->where('username',$username);
						$update = $this->db->update('users',$data);
						$this->session->set_flashdata('login_failed', 'Sorry, Your Account has been locked due to 3 failed login attempts please contact your system admin');
						redirect('home/index');
					}
				}
				
				
					//Set ERROR
				$this->session->set_flashdata('login_failed', 'Sorry, the login info that you entered is invalid');
				redirect('home/index');
				
			}	
		}
	}
	
	public function logout()
	{
		$tempUser['tempName'] = $this->session->userdata('username');
		//Unset session data
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('user_id');
		$this->session->sess_destroy();
		
		//All This to display your logged out message. 
		$this->session->sess_create(); 
		$this->session->set_userdata($tempUser);
		$this->session->set_flashdata('logged_OUT_success', ', you are now logged Out');
		redirect('home/index');
	}
	
}

?>