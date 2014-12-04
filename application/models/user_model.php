<?php
	class User_model extends CI_Model
{
		public function create_member()
		{
			if($this->session->userdata('logged_in') &&  $this->session->userdata('role') == 'Admin')
			{
				$role = $this->input->post('role');
			}
			else
			{
				$role = "Guest";
			}
			$enc_password = md5($this->input->post('password'));
			$data = array(
			
					'username'   => $this->input->post('username'),
					'email'      => $this->input->post('email'),
					'password'   => $enc_password ,
					'first_name' => $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'dob'        => $this->input->post('dob'),
					'ssn'        => $this->input->post('ssn'),
					'street'     => $this->input->post('street'),
					'city'       => $this->input->post('city'),
					'state'      => $this->input->post('state'),
					'zipcode'    => $this->input->post('zipcode'),
					'tel'        => $this->input->post('tel'),
					'Role'		 =>	$role
					
					);
					
			 $insert = $this->db->insert('users', $data);
			 return $insert;
		}
		
		
		public function login_user($username, $password)
		{
			$enc_password = md5($password);
			
			//Where Clause
			$this->db->where('username',$username);
			$this->db->where('password',$enc_password);
			
			$result = $this->db->get('users');
			
			if($result->num_rows()== 1)
			{
				$userInfo = array('id' => $result->row(0)->ID, 'role' => $result->row(0)->Role);	
				return $userInfo;
			}
			else
			{
				return false; 	
			}
		}
}
?>