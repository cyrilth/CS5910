<?php
class student_model extends CI_Model
{
	public function getSemByID($semID)
	{
		$this->db->where('SemesterCode',$semID);
		$query = $this->db->get('semester');
		return $query->row(0);
	}
	
	public function register($crn,$studentID,$semID)
	{	
		$data = array (
						'studentID' 		=> $studentID,
						'CRN'         		=> $crn,
						'SemesterCode'   	=> $semID
					   );
					   
		$insert = $this->db->insert('registration',$data);
		
		$this->db->where('CRN', $crn);
		$sectUpdate= $this->db->get('sections');
		
		$updateDATA = array(
							"CurrentEnroll" => $sectUpdate->row(0)->CurrentEnroll +1,
							"RemainingEnroll" => $sectUpdate->row(0)->RemainingEnroll -1
							);
		
		$this->db->where('CRN',$crn);
		$update = $this->db->update('sections',$updateDATA);
		
		$this->db->where('StudentID',$studentID);
		$balanceQuery = $this->db->get('student');
				
		$updateBalance = 1000 + $balanceQuery->row(0)->balances;
		
		$data =array("balances"=>$updateBalance);
		$this->db->where('StudentID',$studentID);
		$newBalance = $this->db->update('student',$data);
		
		return $newBalance;
	}
	
	public function getStudByID($id)
	{
		$this->db->where('StudentID',$id);
		$query = $this->db->get('student');
		return $query->row(0);
	}
	
	public function getsectionByCS($crn,$semID)
	{
		$this->db->where('CRN',$crn);
		$this->db->where('SemesterCode',$semID);
		$query = $this->db->get('sections');
		return $query;
	}
	
	public function prereqRecord($crn,$studID,$semID)
	{
		$this->db->where('CRN',$crn);
		$crnQuery = $this->db->get('sections');
		
		$this->db->where('courseID',$crnQuery->row(0)->CourseID);
		$preqQuery = $this->db->get('preq');
		
		$storePreq = NULL;
		$countPreq = 0;
		$metReq = FALSE;
		
		if($preqQuery->num_rows() > 0)
		{
			foreach($preqQuery->result() as $row)
			{
				$storePreq[$countPreq++] = $row->prereqID; 
			}
			
			$this->db->where('studentID',$studID);
			$this->db->where('SemesterCode <', $semID);
			$studQuery = $this->db->get('registration');
			
			if($studQuery->num_rows()>0)
			{
				
				if($studQuery->num_rows() == 1)
				{
					if($studQuery->row(0)->courseGrade == "A" || $studQuery->row(0)->courseGrade == "A-"||$studQuery->row(0)->courseGrade == "B+"||$studQuery->row(0)->courseGrade == "B"||$studQuery->row(0)->courseGrade == "B-"||$studQuery->row(0)->courseGrade == "C+"||$studQuery->row(0)->courseGrade == "C" || $studQuery->row(0)->courseGrade == "TBA" || $studQuery->row(0)->courseGrade == "T")
						{
							$this->db->where('CRN',$studQuery->row(0)->CRN);
							$studCRNQuery = $this->db->get('sections');
							if(!isset($studentRecord[$studCRNQuery->row(0)->CourseID]))
							{						
								$studentRecord[$studCRNQuery->row(0)->CourseID]=$studCRNQuery->row(0)->CourseID;
							}	
						}
				}
				else
				{
					foreach($studQuery->result() as $row)
					{
						if($row->courseGrade == "A" || $row->courseGrade == "A-"||$row->courseGrade == "B+"||$row->courseGrade == "B"||$row->courseGrade == "B-"||$row->courseGrade == "C+"||$row->courseGrade == "C" || $row->courseGrade == "TBA" || $row->courseGrade == "T")
						{
							$this->db->where('CRN',$row->CRN);
							$studCRNQuery = $this->db->get('sections');
							if(!isset($studentRecord[$studCRNQuery->row(0)->CourseID]))
							{						
								$studentRecord[$studCRNQuery->row(0)->CourseID]=$studCRNQuery->row(0)->CourseID;
							}	
						}
					}
				}
				
			}
			
			for($i=0; $i < count($storePreq); $i++)
			{
				if(isset($studentRecord[$storePreq[$i]]))
				{
					$metReq = TRUE;
				}
				else
				{
					return FALSE;
				}	
			}
			
			return $metReq;
		}
		else
		{
			return TRUE;
		}	
	}
	
	public function getTimeSlotByCrn($crn)
	{
		$this->db->where('CRN', $crn);
		$query = $this->db->get('sections');
		if($query->num_rows() == 1)
		{
			return $query->row(0)->TimeSlotID;
		}
		else
		{
			return 0;
		}
	}
	
	public function getCurStudReg($studID,$semID)
	{
		
		$this->db->where('SemesterCode',$semID);
		$this->db->where('studentID', $studID);
		$query = $this->db->get('registration');
		if($query->num_rows() > 0)
		{
		
			
				return $query->result();
			
		}
		else
		{
			return 0;
		}		
	}
	public function deleteReg($regID)
	{
		$this->db->where('regID', $regID);
		$updateReg = $this->db->get('registration');
		
		$this->db->where('StudentID',$updateReg->row(0)->studentID);
		$balanceQuery= $this->db->get('student');
		
		$updateBalance = $balanceQuery->row(0)->balances - 1000;
		$data =array("balances"=>$updateBalance);
		$this->db->where('StudentID',$updateReg->row(0)->studentID);
		$newBalance = $this->db->update('student',$data);
		
		$this->db->where('CRN', $updateReg->row(0)->CRN);
		$sectUpdate= $this->db->get('sections');
		
		$updateDATA = array(
							"CurrentEnroll" => $sectUpdate->row(0)->CurrentEnroll -1,
							"RemainingEnroll" => $sectUpdate->row(0)->RemainingEnroll +1
							);
		
		$this->db->where('CRN',$updateReg->row(0)->CRN);
		$update = $this->db->update('sections',$updateDATA);
		
		$this->db->where('regID', $regID);
		$delete = $this->db->delete('registration'); 
		return $delete;
	}
	
	public function timeslot()
	{
		$timeslot = $this->db->get('timeslot');
		
		return $timeslot->result();
	}
	
	public function payBalance()
	{
		$this->db->where('StudentID',$this->session->userdata('user_id'));
		$getBalance = $this->db->get('student');
		
		$updateBalance = $getBalance->row(0)->balances - $this->input->post('balance');
		
		$data = array("balances" => $updateBalance);
		$this->db->where('StudentID',$this->session->userdata('user_id'));
		$update = $this->db->update('student',$data);
		
		return $update;
	}
	
	public function getHoldByStudID($id)
	{
		$this->db->where('StudentID',$id);
		$getHolds = $this->db->get('student');
		return $getHolds->row(0)->Hold;
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
		elseif($lettergrade == "C-")
		{
			return 1.70;
		}
		elseif($lettergrade =="D+")
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
	
	public function getAllGrade($id)
	{
		$this->db->where('studentID',$id);
		$regQuery = $this->db->get('registration');
		if($regQuery->num_rows()>0)
		{
			$storage = NULL;
			$count=0;
			foreach($regQuery->result() as $row)
			{
				$this->db->where('CRN',$row->CRN);
				$secQuery = $this->db->get('sections');
				
				$this->db->where('CourseID',$secQuery->row(0)->CourseID);
				$courseQuery = $this->db->get('course');
				
				$this->db->where('SemesterCode',$row->SemesterCode);
				$semQuery = $this->db->get('semester');
				
				$storage[$count++]=array(
										"Term" =>$semQuery->row(0)->Term." ".$semQuery->row(0)->Year,
										"Course"=>$courseQuery->row(0)->CourseNum." ".$courseQuery->row(0)->DepartmentCode." ".$courseQuery->row(0)->CourseTitle,
										"Credit"=>$courseQuery->row(0)->NumCredits,
										"Grade"=>$row->courseGrade
										);
			}
			
			return $storage;
		}
		else
		{
			return NULL;
		}
	}
	
	public function getGradeTotal($id)
	{
		$this->db->where('StudentID',$id);
		$query = $this->db->get('student');
		
		$gpa = ($query->row(0)->TotalPoints) / ($query->row(0)->CreditsEarned);
		
		$allGrades = array(
						'CreditsTaken'  =>$query->row(0)->CreditsTaken,
						'CreditsEarned' =>$query->row(0)->CreditsEarned,
						'TotalPoints'   =>$query->row(0)->TotalPoints ,
						'GPA' 			=>$gpa,
						'ClassStanding' => $query->row(0)->ClassStanding
						
						);
						
		return $allGrades;
	}
	
	public function getSemGrade($studID,$semID)
	{
		$this->db->where('studentID',$studID);
		$this->db->where('SemesterCode',$semID);
		$regQuery = $this->db->get('registration');
		
		if($regQuery->num_rows()>0)
		{
			
			$storage = NULL;
			$count=0;
			$creditsAttempted = 0;
			$creditsEarned = 0 ;
			$gradePoints = 0;
			foreach($regQuery->result() as $row)
			{
				$this->db->where('CRN',$row->CRN);
				$secQuery = $this->db->get('sections');
				
				$this->db->where('CourseID',$secQuery->row(0)->CourseID);
				$courseQuery = $this->db->get('course');
				
				$this->db->where('SemesterCode',$row->SemesterCode);
				$semQuery = $this->db->get('semester');
				
				if(!($row->courseGrade=="TBA"))
				{
					if($row->courseGrade=="W" || $row->courseGrade == "I" || $row->courseGrade == "NG")
					{
						$creditsAttempted = $creditsAttempted +$courseQuery->row(0)->NumCredits ;
					}
					else
					{
						$creditsAttempted = $creditsAttempted + $courseQuery->row(0)->NumCredits;
						$creditsEarned = $creditsEarned + $courseQuery->row(0)->NumCredits;
						$gradePoints = $gradePoints + ( $courseQuery->row(0)->NumCredits * $this->getGradePoints($row->courseGrade));
					}
				}
				$storage[$count++]=array(
										"Term" =>$semQuery->row(0)->Term." ".$semQuery->row(0)->Year,
										"Course"=>$courseQuery->row(0)->CourseNum." ".$courseQuery->row(0)->DepartmentCode." ".$courseQuery->row(0)->CourseTitle,
										"Credit"=>$courseQuery->row(0)->NumCredits,
										"Grade"=>$row->courseGrade,
										"creditsAttempted" => $creditsAttempted,
										"creditsEarned" => $creditsEarned,
										"gradePoints" =>$gradePoints
										);
			}
			
			return $storage;
		}
		else
		{
			return NULL;
		}
	}
	
	public function getAdvisor($id)
	{
		$this->db->where('StudentID',$id);
		$query = $this->db->get('advisor');
		
		if($query->num_rows()>0)
		{
			$storage = NULL;
			$count=0;
			foreach($query->result() as $row)
			{
				$this->db->where('ID',$row->facultyID);
				$record = $this->db->get('users');
				$storage[$count++] = array("Name"=> $record->row(0)->First_Name." ".$record->row(0)->Last_Name);
			}
			
			return $storage;
		}
		else
		{
			return NULL;
		}
		
	}
	
	public function getMajor($id)
	{
		$this->db->where('StudentID',$id);
		$query= $this->db->get('student');
		
		$storage = array("Major1"=>$query->row(0)->major1,"Major2"=>$query->row(0)->major2,"Minor"=>$query->row(0)->minor);
		
		return $storage;
	}
	
	public function getAllMajor()
	{
		$this->db->where('type',"major");
		$query= $this->db->get('major');
		return $query->result();
	}
	
	public function getAllMinor()
	{
		$this->db->where('type',"minor");
		$query= $this->db->get('major');
		return $query->result();
	}
	
	public function updateMajor($id)
	{
		$this->db->where('majorID',$this->input->post('major1'));
		$query = $this->db->get('major');
		
		$data = array(
					'major1' => $this->input->post('major1'),
					'major2' => $this->input->post('major2'),
					'minor' => $this->input->post('minor'),
					'DepartmentCode'=>$query->row(0)->DepartmentCode
					);
		$this->db->where('StudentID',$id);
		$update = $this->db->update('student',$data);
		
		return $update;
	}
	
}
?>