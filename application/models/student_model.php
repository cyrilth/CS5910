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
		
		if($insert && $update)
		{
			return $insert;	
		}
		else
		{
			return FALSE;
		}
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
		$delete = $this->db->delete('registration'); 
		return $delete;
	}
	
	public function timeslot()
	{
		$timeslot = $this->db->get('timeslot');
		
		return $timeslot->result();
	}
}
?>