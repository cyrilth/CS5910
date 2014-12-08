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
			
			 if($insert)
			 {
			 	$username = $this->input->post('username');
				if($data["Role"] == "Student")
				{
					
					$student = $this->create_student($username);
					return $student;
				}	
			 	else if($data["Role"] == "Faculty")
				{
					$faculty = $this->create_faculty($username);
					return $faculty;
				}
				else if($data["Role"] == "Admin")
				{
					$admin = $this->create_admin($username);
					return $admin;
				}
				else if($data["Role"] == "Guest")
				{
					 return $insert;	
				}
				else
				{
					return FALSE;
				}	
			 }
			 else
			 {
			 	return $insert;
			 }
			 	
		}
		
		public function create_student($username)
		{
			$this->db->where('username',$username);
			$query = $this->db->get('users');
			$data = array(
							'StudentID' => $query->row(0)->ID,
							'DepartmentCode' => $this->input->post('DepartmentCode'),
							'major1' => $this->input->post('major'),
							'Hold' => $this->input->post('hold')
						);
						
			$insert = $this->db->insert('student', $data);
			return $insert;
		}
		
		public function create_faculty($username)
		{
			$this->db->where('username',$username);
			$query = $this->db->get('users');
			$data = array(
							'facultyID' => $query->row(0)->ID,
							'DepartmentCode' => $this->input->post('DepartmentCode')
						);
						
			$insert = $this->db->insert('faculty', $data);
			return $insert;
		}
		
		public function create_admin($username)
		{
			$this->db->where('username',$username);
			$query = $this->db->get('users');
			$data = array(
							'AdminID' => $query->row(0)->ID
						);
						
			$insert = $this->db->insert('admins', $data);
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
		
		public function getUserInfo($role)
		{
			$this->db->where('Role',$role);
			$query = $this->db->get('users');
			return $query->result();
		}
		
		public function userInfo($id = 0)
		{
			$this->db->where('ID',$id);
			$query = $this->db->get('users');
			return $query->row(0);
		}
		
		public function studentInfo($id)
		{
			$this->db->where('StudentID',$id);
			$query = $this->db->get('student');
			return $query->row(0);
		}
}
?>