<?php
class faculty_model extends CI_Model
{
	public function getSecByFacSem($facID, $semID)
	{
		$this->db->where('FacultyID',$facID);
		$this->db->where('SemesterCode',$semID);
		$query = $this->db->get('sections');
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return NULL;
		}
	}
	
	public function getCurRegByCS($crn,$semID)
	{
		$this->db->where('CRN',$crn);
		$this->db->where('SemesterCode',$semID);
		$query = $this->db->get('registration');
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return NULL;
		}
	}
	public function gradesByID($crn,$studID)
	{
		$this->db->where('CRN',$crn);
		$this->db->where('studentID',$studID);
		$query = $this->db->get('registration');
		return $query->row(0);
	}
	public function getGradePoints($lettergrade)
	{
		if($lettergrade == "A")
		{
			return 4.00;
		}
		elseif($lettergrade == "A-")
		{
			return 3.70;
		}
		elseif($lettergrade == "B+")
		{
			return 3.33;
		}
		elseif($lettergrade == "B")
		{
			return 3.00;
		}
		elseif($lettergrade == "B-")
		{
			return 2.70;
		}
		elseif($lettergrade == "C+")
		{
			return 2.30;
		}
		elseif($lettergrade == "C")
		{
			return 2.00;
		}
		elseif($lettergrade =="C-")
		{
			return 1.70;
		}
		elseif($lettergrade == "D+")
		{
			return 1.30;
		}
		elseif($lettergrade == "D")
		{
			return 1.00;
		}
		elseif($lettergrade == "D-")
		{
			return 0.70;
		}
		else
		{
			return 0;
		}
	}
	public function updateGrade($crn,$studID)
	{
		$data = array(
					'midtermGrade' => $this->input->post('midterm'),
					'courseGrade' => $this->input->post('final')
					);
		$this->db->where('CRN',$crn);
		$this->db->where('studentID',$studID);
		$update = $this->db->update('registration',$data);
		
		$this->db->where('studentID',$studID);
		$gradeQuery= $this->db->get('student');
		$creditsEarnedTotal = $gradeQuery->row(0)->CreditsEarned;
		$totalpoints = $gradeQuery->row(0)->TotalPoints;
		$creditsTakenTotal = $gradeQuery->row(0)->CreditsTaken;
		
		if($this->input->post('final')=="W" || $this->input->post('final')=="I" ||$this->input->post('final')=="NG")
		{
			$data = array( 
						  "CreditsTaken"=>$creditsTakenTotal + (int)$this->getCCreditByCRN($crn)
						  );
			$this->db->where('StudentID', $studID);
			$updateCreditsEarned = $this->db->update('student',$data);
		}
		else
		{	
			//var_dump($this->input->post('final')); die();
			$data = array(
						  "CreditsEarned" => $creditsEarnedTotal + $this->getCCreditByCRN($crn),
						  "TotalPoints" => $totalpoints + ((int)($this->getCCreditByCRN($crn)) * $this->getGradePoints($this->input->post('final'))), 
						  "CreditsTaken"=>$creditsTakenTotal + $this->getCCreditByCRN($crn)
						  );
			$this->db->where('StudentID', $studID);
			$updateCreditsEarned = $this->db->update('student',$data);
		}
		return $update;
	}
	
	public function getCCreditByCRN($crn)
	{
		$this->db->where('CRN',$crn);
		$sectQuery = $this->db->get('sections');
		
		$this->db->where('CourseID',$sectQuery->row(0)->CourseID);
		$creditQuery = $this->db->get('course');
		
		return $creditQuery->row(0)->NumCredits;
	}
	
	public function getAdvisementList()
	{
		$getAllStudent = $this->db->get('student');
		$storage = NULL;
		$count = 0 ;
		foreach($getAllStudent->result() as $student)
		{
			$this->db->where('StudentID', $student->StudentID);
			$getADList = $this->db->get('advisor');
			
			$this->db->where('ID', $student->StudentID);
			$getSTName = $this->db->get('users');
			$ADname = "| ";
			if($getADList->num_rows()>0)
			{
				
				foreach($getADList->result() as $advisor)
				{
					$this->db->where('ID',$advisor->facultyID);
					$getADName = $this->db->get('users');
					$ADname = $ADname . $getADName->row(0)->First_Name ." ".$getADName->row(0)->Last_Name . " | ";
				}
			}
			$storage[$count++]=array(
										"StudentID"   => $getSTName->row(0)->ID,
										"StudentName" => $getSTName->row(0)->First_Name ." ".$getSTName->row(0)->Last_Name,
										"Advisor" 	  => $ADname
									);
		}
		return $storage;
	}
}
?>