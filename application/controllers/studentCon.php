<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class studentCon extends CI_Controller 
{
	
	
	public function __construct()
	{
		parent::__construct();
		
		if(!($this->session->userdata('logged_in') &&  $this->session->userdata('role') == 'Student'))
		{
			$this->session->set_flashdata('noaccess','Sorry you are not logged in with appropriate access');
			redirect('home/index');
		}	
	}
	
	public function index()
	{
		
		$data['main_content'] = 'admin/register';
		$this->load->view('layouts/main',$data);
	}

	
	public function viewSchedule()
	{
		$data['sectionBySem']=$this->admin_model->viewSchedule($this->input->post('semesterID'));
		$data['getSemester'] = $this->admin_model->getAllSemester();
		$data['main_content'] = 'student/viewSchedule';
		$this->load->view('layouts/main',$data);
	}
	
	public function addClass()
	{
		$checkSem = $this->input->post('semesterID');
		if(!($checkSem == "0"))
		{
			$count=0;
			$getCurStudReg=$this->student_model->getCurStudReg($this->session->userdata('user_id'),$checkSem);
			if(!($getCurStudReg==0))
			{
				foreach($getCurStudReg as $row)
				{
					$this->db->where('CRN',$row->CRN);
					$courseQuery = $this->db->get('sections');
					$this->db->where('CourseID',$courseQuery->row(0)->CourseID);
					$courseInfo = $this->db->get('course');
					$getRecord[$count++] = array('CRN' => $row->CRN, 'CourseName' => $courseInfo->row(0)->CourseNum." ".$courseInfo->row(0)->DepartmentCode." ".$courseInfo->row(0)->CourseTitle,'regID'=>$row->regID);
				}
				$data['getRecord']=$getRecord;
			}
			$data['semester']=$this->student_model->getSemByID($checkSem);
			$data['main_content'] = 'student/addCRN';
			$this->load->view('layouts/main',$data);
		}
		else
		{
			$data['getSemester'] = $this->admin_model->getAllSemester();
			$data['main_content'] = 'student/addClass';
			$this->load->view('layouts/main',$data);
		}
		
	}
	
	public function addCRN($semID = NULL)
	{
		
		if(isset($semID))
		{
			
			$this->form_validation->set_rules('course1','CRN 1','trim|required|numeric|xss_clean|callback_studentHoldCheck|callback_existCheck['.$semID.']|callback_prereqcheck['.$semID.']|callback_timeSlotCheck['.$semID.']|callback_creditLimitCheck['.$semID.']||callback_duplicateCheck['.$semID.']|callback_classFullCheck');
			if($this->form_validation->run() == FALSE)
			{
				$count=0;
				$getCurStudReg=$this->student_model->getCurStudReg($this->session->userdata('user_id'),$semID);
				if(!($getCurStudReg==0))
				{
					foreach($getCurStudReg as $row)
					{
						$this->db->where('CRN',$row->CRN);
						$courseQuery = $this->db->get('sections');
						$this->db->where('CourseID',$courseQuery->row(0)->CourseID);
						$courseInfo = $this->db->get('course');
						$getRecord[$count++] = array('CRN' => $row->CRN, 'CourseName' => $courseInfo->row(0)->CourseNum." ".$courseInfo->row(0)->DepartmentCode." ".$courseInfo->row(0)->CourseTitle,'regID'=>$row->regID);
					}
					$data['getRecord']=$getRecord;
				}
				$data['semester']=$this->student_model->getSemByID($semID);
				$data['main_content'] = 'student/addCRN';
				$this->load->view('layouts/main',$data);
			}
			else
			{
				if($this->student_model->register($this->input->post('course1'),$this->session->userdata('user_id'),$semID))
				{
					$getCurStudReg=$this->student_model->getCurStudReg($this->session->userdata('user_id'),$semID);
					if(!($getCurStudReg==0))
					{
						$count=0;
						foreach($getCurStudReg as $row)
						{
							$this->db->where('CRN',$row->CRN);
							$courseQuery = $this->db->get('sections');
							$this->db->where('CourseID',$courseQuery->row(0)->CourseID);
							$courseInfo = $this->db->get('course');
							$getRecord[$count++]= array('CRN' => $row->CRN, 'CourseName' => $courseInfo->row(0)->CourseNum." ".$courseInfo->row(0)->DepartmentCode." ".$courseInfo->row(0)->CourseTitle,'regID'=>$row->regID);
						}
						$data['getRecord']=$getRecord;
					}
					
					$data['semester']=$this->student_model->getSemByID($semID);
					$data['main_content'] = 'student/addCRN';
					$this->load->view('layouts/main',$data);
				}
			}

		}
		
	}
	
	public function studentHoldCheck()
	{
		$student = $this->student_model->getStudByID($this->session->userdata('user_id'));
		
		if($student->Hold == "" || $student->Hold == "None")
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('studentHoldCheck','Please Clear Your Hold First');
			return FALSE;
		}
	}
	
	public function existCheck($crn, $semID)
	{
		if(!($crn == ""))
		{
			$record = $this->student_model->getsectionByCS($crn,$semID);
			
			if($record->num_rows()== 1)
			{
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('existCheck','This %s Does not Exist For This Semester');
				return FALSE;
			}
		}
		else
		{
			return TRUE;
		}
	
	}
	
	public function prereqcheck($crn,$semID)
	{
		$status = $this->student_model->prereqRecord($crn, $this->session->userdata('user_id'),$semID);
		
		if($status)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('prereqcheck','You do not meet the Prerequisite for this %s');
			return FALSE;
		}
	}
	
	public function timeSlotCheck($crn,$semID)
	{
		$studSeh = $this->student_model->getCurStudReg($this->session->userdata('user_id'),$semID);
		$newTime = $this->student_model->getTimeSlotByCrn($crn);
		$timeRecord = NULL;
		if(!($studSeh==0))
		{
			foreach($studSeh as $row)
			{
				$this->db->where('CRN', $row->CRN);
				$query = $this->db->get('sections');
				
				$timeRecord[$query->row(0)->TimeSlotID]= $query->row(0)->TimeSlotID;
			}
			
			if(isset($timeRecord[$newTime]))
			{
				$this->form_validation->set_message('timeSlotCheck','Cannot register %s because you already registered for that TimeSlot');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			return TRUE;
		}
	}
	
	public function creditLimitCheck($crn,$semID)
	{
		$studSeh = $this->student_model->getCurStudReg($this->session->userdata('user_id'),$semID);
		
		$this->db->where('CRN',$crn);
		$currentQuery = $this->db->get('sections');
		$this->db->where('CourseID',$currentQuery->row(0)->CourseID);
		$currentCourseQuery = $this->db->get('course');
		
		$creditCount = $currentCourseQuery->row(0)->NumCredits; 
		if(!($studSeh==0))
		{
			foreach($studSeh as $row)
			{
				$this->db->where('CRN', $row->CRN);
				$query = $this->db->get('sections');
				
				$this->db->where('CourseID',$query->row(0)->CourseID);
				$courseQuery = $this->db->get('course');
				$creditCount = $creditCount + $courseQuery->row(0)->NumCredits; 
			}
			if($creditCount > 15)
			{
				$this->form_validation->set_message('creditLimitCheck','Cannot register %s because you are over the credit limit');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			return TRUE;
		}
	}
	
	public function duplicateCheck($crn,$semID)
	{
		$this->db->where('CRN',$crn);
		$currentQuery = $this->db->get('sections');
		$currCourseID = $currentQuery->row(0)->CourseID;
		
		$studSeh = $this->student_model->getCurStudReg($this->session->userdata('user_id'),$semID);
		
		$storage = NULL;
		
		if(!($studSeh==0))
		{
			foreach($studSeh as $row)
			{
				$this->db->where('CRN', $row->CRN);
				$query = $this->db->get('sections');
				
				$storage[$query->row(0)->CourseID]=$query->row(0)->CourseID;
			}
			
			if(isset($storage[$currCourseID]))
			{
				$this->form_validation->set_message('duplicateCheck','You are Already Registered for this course');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			return TRUE;
		}
	}
	
	public function classFullCheck($crn)
	{
		$this->db->where('CRN', $crn);
		$reEnroll = $this->db->get('sections');
		
		if($reEnroll->row(0)->RemainingEnroll==0)
		{
			$this->form_validation->set_message('classFullCheck','The Class is Full');
			return FALSE;
		} 
		else
		{
			return TRUE;
		}
	}
	public function deleteReg($regID)
	{
		if($this->student_model->deleteReg($regID))
		{
			$data['success']= "The Registration has been successfully deleted";
			$data['main_content'] = 'student/deleteReg';
			$this->load->view('layouts/main',$data);
		}
	}
	
	public function viewYourSchedule()
	{
		$currentReg = $this->student_model->getCurStudReg($this->session->userdata('user_id'),$this->input->post('semesterID'));
		$count = 0;
		if(!($currentReg == 0))
		{
			foreach($currentReg as $row)
			{
				$this->db->where('CRN', $row->CRN);
				$sectionQuery = $this->db->get('sections');
				
				$this->db->where('CourseID', $sectionQuery->row(0)->CourseID);
				$courseQuery = $this->db->get('course');
				
				$this->db->where('LocationID', $sectionQuery->row(0)->LocationID);
				$locationQuery = $this->db->get('location');
				
				$this->db->where('ID', $sectionQuery->row(0)->FacultyID);
				$facultyQuery = $this->db->get('users');
				
				$storage[$count++]= array(
										  'timeslot' => $sectionQuery->row(0)->TimeSlotID, 
										  'Course'   => $courseQuery->row(0)->CourseNum." ".$courseQuery->row(0)->DepartmentCode." ".$courseQuery->row(0)->CourseTitle,
										  'Location' => $locationQuery->row(0)->Building." Room:".$locationQuery->row(0)->Room,
										  'Faculty'  => $facultyQuery->row(0)->First_Name." ".$facultyQuery->row(0)->Last_Name
										  );
				
				
			}
			
			$data["viewReg"]= $storage;
		}
		$data['getSemester'] = $this->admin_model->getAllSemester();
		$data['timeslot']=$this->student_model->timeslot();
		$data['main_content'] = 'student/viewYourSchedule';
		$this->load->view('layouts/main',$data);
	}
	
	public function viewPayBalance()
	{	
	
		$this->form_validation->set_rules('balance','Balance','trim|required|numeric|xss_clean');
	
		if($this->form_validation->run() == FALSE)
		{
			$this->db->where('StudentID',$this->session->userdata('user_id'));
			$getBalance = $this->db->get('student');
			$data['getBalance'] = $getBalance->row(0)->balances;
			$data['main_content'] = 'student/balance';
			$this->load->view('layouts/main',$data);
		}
		else
		{
			if($this->student_model->payBalance())
			{
				$this->session->set_flashdata('viewPayBalance','Your Payment is Accepted');
				redirect('studentCon/viewPayBalance');
			}
		}
		
	}
	
	public function viewHolds()
	{
		
		$data['holds']= $this->student_model->getHoldByStudID($this->session->userdata('user_id'));
		$data['main_content'] = 'student/viewHolds';
		$this->load->view('layouts/main',$data);
	}
	
	public function viewTranscript()
	{
		
		if($this->input->post('semesterID') == -1)
		{
			
			$data['getAllGrades'] = $this->student_model->getAllGrade($this->session->userdata('user_id'));
			$data['getGradeTotal']= $this->student_model->getGradeTotal($this->session->userdata('user_id'));
			
		}
		else
		{
			$data['semGrade']= $this->student_model->getSemGrade($this->session->userdata('user_id'),$this->input->post('semesterID'));
			
		}
		$data['getSemester'] = $this->admin_model->getAllSemester();
		$data['main_content'] = 'student/viewTranscript';
		$this->load->view('layouts/main',$data);
	}
	
	public function viewAdvisor()
	{
		$data['getRecord'] = $this->student_model->getAdvisor($this->session->userdata('user_id'));
		$data['main_content'] = 'student/viewAdvisor';
		$this->load->view('layouts/main',$data);
	}
	
	public function viewEditMajor()
	{
		$this->form_validation->set_rules('major1','1rst Major','callback_duplicateMajorCheck');
		$this->form_validation->set_rules('major2','1rst Major','callback_checkMajor1Selected');
	
		if($this->form_validation->run() == FALSE)
		{
			$data['getAllMinor']=$this->student_model->getAllMinor();
			$data['getAllMajor']=$this->student_model->getAllMajor();
			
			$data['major']=$this->student_model->getMajor($this->session->userdata('user_id'));
			$data['main_content'] = 'student/major';
			$this->load->view('layouts/main',$data);
		}
		else
		{
			if($this->student_model->updateMajor($this->session->userdata('user_id')))
			{
				$this->session->set_flashdata('major','Your Major Has Been Successfully Updated');
				redirect('studentCon/viewEditMajor');
			}
		}
	}
	
	public function duplicateMajorCheck($major1)
	{
		if($major1 == $this->input->post('major2'))
		{
			$this->form_validation->set_message('duplicateMajorCheck','Duplicate Major');
			return FALSE;
		} 
		else
		{
			return TRUE;
		}
	}
	public function checkMajor1Selected()
	{
		if($this->input->post('major1') == 1)
		{
			$this->form_validation->set_message('checkMajor1Selected','Please Select Your First Major');
			return FALSE;
		} 
		else
		{
			return TRUE;
		}
	}
}