<?php
class admin_model extends CI_Model
{
	public function getDepCode()
	{
		
		$query = $this->db->get('departments');
		
		return $query->result();
	}
	
	public function create_course()
	{
		
		$data = array(
						
						'CourseNum'   		=> $this->input->post('CourseNum'),
						'DepartmentCode'   	=> $this->input->post('DepartmentCode'),
						'CourseTitle'   	=> $this->input->post('CourseTitle'),
						'NumCredits'  	    => $this->input->post('NumCredits'),
						'Prereq1'   		=> $this->input->post('Prereq1'),
						'Prereq2'   		=> $this->input->post('Prereq2'),
						'Prereq3'   		=> $this->input->post('Prereq3')
					  );
		
	
		$insert = $this->db->insert('course',$data);
		return $insert;
	}
	
	public function getAllCourse()
	{
		$this->db->order_by("CourseNum", "asc");
		$query = $this->db->get('course');
		
		return $query->result();
	}
	
	public function create_semester()
	{
		$data = array(
						'Term' => $this->input->post('term'),
						'Year' => $this->input->post('year')
					  );
					  
		$insert = $this->db->insert('semester',$data);
		return $insert;
	}
	
	public function getAllSemester()
	{
		$this->db->order_by("SemesterCode", "desc");
		$query = $this->db->get('semester');
		
		return $query->result();
	}
	
	public function getAllTimeSlot()
	{
		$this->db->order_by("TimeSlotID", "asc");
		$query = $this->db->get('timeslot');
		return $query->result();
	}
	
	public function getAllLocation()
	{
		$this->db->order_by("LocationID", "asc");
		$query = $this->db->get('location');
		return $query->result();
	}
	
	public function getAllFaculty()
	{
		//$this->db->select('First_Name Last_Name facultyID DepartmentCode');
		//$this->db->from('users');
		//$this->db->join('faculty','users.ID=faculty.facultyID');
		//$query = $this->db->get();
		
		$query = $this->db->query("SELECT users.First_Name, users.Last_Name, faculty.facultyID, faculty.DepartmentCode 
From users  INNER JOIN faculty on users.ID = faculty.facultyID");
		return $query->result();
	}
	
	public function create_schedule()
	{
		$data = array (
						'SemesterCode' 		=> $this->input->post('semesterID'),
						'CRN'         		=> $this->input->post('CRN'),
						'TimeSlotID'   		=> $this->input->post('TimeSlotID'),
						'LocationID'   		=> $this->input->post('LocationID'),
						'FacultyID'    		=> $this->input->post('Faculty'),
						'MaxEnroll'    		=> $this->input->post('MaxEnroll'),
						'RemainingEnroll' 	=> $this->input->post('MaxEnroll'),
						'Level'				=> $this->input->post('courseLevel'),
						'Section'			=> $this->input->post('Section')
					   );
					   
		$insert = $this->db->insert('sections',$data);
		return $insert;
	}
	
	public function viewSchedule($data)
	{
		
		$this->db->where('SemesterCode',$data);
		$semQuery = $this->db->get('sections');
		$count = 0;
		$storage =NULL;
		if($semQuery->num_rows()>0)
		{
			
		
			foreach ($semQuery->result() as $row)
			{
				$this->db->where('CRN',$row->CRN);
				$crnQuery = $this->db->get('course');
				
				$this->db->where('TimeSlotID',$row->TimeSlotID);
				$timeQuery = $this->db->get('timeslot');
				
				$this->db->where('LocationID',$row->LocationID);
				$locationQuery = $this->db->get('location');
				
				$this->db->where('ID',$row->FacultyID);
				$facultyQuery = $this->db->get('users');
				
				$storage[$count++]=array( 
								'CRN'			 => $crnQuery->row(0)->CRN,
				 				'CourseNUM'		 => $crnQuery->row(0)->CourseNum,
				 				'DepartmentCode' =>	$crnQuery->row(0)->DepartmentCode,
				 				'CourseTitle'	 =>	$crnQuery->row(0)->CourseTitle,
				 				'Time'			 => $timeQuery->row(0)->Time,
				 				'Days'			 => $timeQuery->row(0)->Days,
				 				'Location'		 => $locationQuery->row(0)->Building . " Room# " . $locationQuery->row(0)->Room,
				 				'Faculty'		 => $facultyQuery->row(0)->First_Name . " " . $facultyQuery->row(0)->Last_Name,
				 				'MaxEnroll'		 => $row->MaxEnroll,
				 				'CurentEnroll'	 => $row->CurrentEnroll,
				 				'Level'			 => $row->Level,
				 				'Section'		 =>	$row->Section,
				 				'SectionID'		 => $row->SectionID
				 				);
			}
		}
		
		return $storage;
	}
	
	public function getSchedule($id)
	{
		$this->db->where('SectionID',$id);
		$result = $this->db->get('sections');
		return $result->row(0);
	}
	
	public function getDepBySecID($id)
	{
		$this->db->where('SectionID',$id);
		$result = $this->db->get('sections');
		
		$this->db->where('CRN',$result->row(0)->CRN);
		$query = $this->db->get('course');
		return $query->row(0)->DepartmentCode;
	}
	
	public function getCourseBySecID($secID)
	{
		$this->db->where('SectionID',$secID);
		$result = $this->db->get('sections');
		
		$this->db->where('CRN',$result->row(0)->CRN);
		$query = $this->db->get('course');
		return $query->row(0);
	}
	
	public function update_Schedule($secID)
	{
		$data = array(
					'TimeslotID' => $this->input->post('TimeSlotID'),
					'LocationID' => $this->input->post('LocationID'),
					'MaxEnroll'  => $this->input->post('MaxEnroll'),
					'FacultyID'  => $this->input->post('Faculty')	
					);
		$this->db->where('SectionID',$secID);
		$update = $this->db->update('sections',$data);
		
		return $update;
	}
	
	public function deleteSchedule($secID)
	{
		$this->db->where('SectionID', $secID);
		$delete = $this->db->delete('sections'); 
		return $delete;
	}
	
	public function getAllMajor()
	{
		$query = $this->db->get('major');
		return $query->result();
	}
}
?>