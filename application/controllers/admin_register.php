<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin_register extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
		if(!($this->session->userdata('logged_in') &&  $this->session->userdata('role') == 'Admin'))
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
	
	public function addCourse()
	{
		
		
		$data['results'] = $this->admin_model->getDepCode();
		
		$data['main_content'] = 'admin/addCourse';
		
		$this->load->view('layouts/main',$data);
	}
	
	public function addCourse_Validation()
	{
		$this->form_validation->set_rules('CourseNum','Course Number','trim|required|max_length[3]|min_length[3]|xss_clean|callback_duplicateCourseCheck');
		$this->form_validation->set_rules('CourseTitle','Course Title','trim|required|max_length[50]|min_length[2]|xss_clean');
		$this->form_validation->set_rules('NumCredits','Number of Credits','trim|required|max_length[1]|min_length[1]|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$data['results'] = $this->admin_model->getDepCode();
			$data['main_content'] = 'admin/addCourse';
			$this->load->view('layouts/main',$data);
		}
		else
		{
			if($this->admin_model->create_course())
			{
				$this->session->set_flashdata('addCourse','The Course has been Registered');
				redirect('admin_register/addCourse');
			}
		}
	}
	
	public function duplicateCourseCheck($courseNum)
	{
		$this->db->where('CourseNum',$courseNum);
		$this->db->where('DepartmentCode',$this->input->post('DepartmentCode'));
		$result =$this->db->get('course');
		if($result->num_rows()>0)
		{
			$this->form_validation->set_message('duplicateCourseCheck','Duplicate Course');
			return false;
		}
		else{ return TRUE;}
		
	}
	
	public function viewCatalogue()
	{
		$courselist = $this->admin_model->getAllCourse();
		
		$count = 0;
		$storage = NULL;
		foreach($courselist as $singleCourse)
		{
			$this->db->where('courseID',$singleCourse->CourseID);
			$preqlist = $this->db->get('preq');
			$preReqString =""; 
			if($preqlist->num_rows()>0)
			{
					foreach($preqlist->result() as $row)
					{
						$this->db->where('CourseID',$row->prereqID);
						$courseQuery = $this->db->get('course');
						$preREQ = $courseQuery->row(0)->CourseNum." ".$courseQuery->row(0)->DepartmentCode." ".$courseQuery->row(0)->CourseTitle;
						$preReqString = $preReqString." ".$preREQ;
					}
					$preReqString = $preReqString;
				
			}
			else
			{
				$preReqString = "None";
			}
			$storage[$count++] =array("CourseID"=>$singleCourse->CourseID, "CourseNum"=>$singleCourse->CourseNum,"DepartmentCode"=>$singleCourse->DepartmentCode,"CourseTitle"=>$singleCourse->CourseTitle,"NumCredits"=>$singleCourse->NumCredits,"PreReq"=> $preReqString);
			
		}
		$data['allCourseWPrereq']= $storage;
		$data['main_content'] = 'admin/viewCatalogue';
		$this->load->view('Layouts/main',$data);
	}
	
	public function editCourse($courseID)
	{
		$this->form_validation->set_rules('CourseNum','Course Number','trim|required|max_length[3]|min_length[3]|xss_clean');
		$this->form_validation->set_rules('CourseTitle','Course Title','trim|required|max_length[50]|min_length[2]|xss_clean');
		$this->form_validation->set_rules('NumCredits','Number of Credits','trim|required|max_length[1]|min_length[1]|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$data['courseByID']=$this->admin_model->getCourseByID($courseID);
			$data['courseID']=$courseID;
			$data['results'] = $this->admin_model->getDepCode();
			$data['main_content'] = 'admin/editCourse';
			$this->load->view('Layouts/main',$data);
		}
		else
		{
			if($this->admin_model->updateCourse($courseID))
			{
				$data['courseByID']=$this->admin_model->getCourseByID($courseID);
				$data['courseID']=$courseID;
				$data['results'] = $this->admin_model->getDepCode();
				$this->session->set_flashdata('editCourse','This Course has been Updated');
				$data['main_content'] = 'admin/editCourse';
				$this->load->view('Layouts/main',$data);
			}
		}
	}
	public function deleteCourse($courseID)
	{
		if($this->admin_model->deleteCourseByID($courseID))
		{
			$this->viewCatalogue();
		}
	}
	
	public function addViewSemester()
	{
		$this->form_validation->set_rules('year', 'Year', 'trim|required|max_length[4]|min_length[4]|xss_clean|numeric|callback_semester_check');
		
		if($this->form_validation->run() == FALSE)
		{
			$data['allSemester'] = $this->admin_model->getAllSemester();
			$data['main_content'] = 'admin/addViewSemester';
			$this->load->view('Layouts/main',$data);	
		}
		else
		{
			if($this->admin_model->create_semester())
			{
				$this->session->set_flashdata('addViewSemester','The Semester has been Created');
				redirect('admin_register/addViewSemester');
			}
		}
	}
	
	public function semester_check()
	{
		$this->db->where('Term',$this->input->post('term'));
		$this->db->where('Year',$this->input->post('year'));
		$result = $this->db->get('semester');
		if($result->num_rows()>0)
		{
			$this->form_validation->set_message('semester_check','This semester already exist');
			return false;
		}	
		else{ return TRUE; }
	}
	
	public function createSchedule()
	{
		$this->form_validation->set_rules('CRN','CRN','callback_location_check|callback_section_check|callback_zeroValue_check|callback_professor_check|callback_course_count');
		
		$maxEnroll = $this->input->post('MaxEnroll');
		
		if($maxEnroll)
		{
			$data['MaxEnroll']=$maxEnroll;
		}
		else{$data['MaxEnroll']= "0";}
		
		
		if($this->input->post('CRN'))
		{
			$data['sortCourse']= $this->input->post('CRN');
		}
		else{$data['sortCourse'] = 0;}
		
		if($this->form_validation->run() == FALSE)
		{
			
			$data['getAllFaculty'] = $this->admin_model->getAllFaculty();
			$data['allLocation']= $this->admin_model->getAllLocation();
			$data['allTimeSlot'] = $this->admin_model->getAllTimeSlot();
			$data['allCourse'] = $this->admin_model->getAllCourse();
			$data['getSemester'] = $this->admin_model->getAllSemester();
			$data['main_content'] = 'admin/createSchedule';
			$this->load->view('Layouts/main',$data);
		}
		else
		{
			if($this->admin_model->create_schedule())
			{
				$this->session->set_flashdata('createSchedule','This Course has been Scheduled Successfully');
				redirect('admin_register/createSchedule');
			}
		}
		
	}
	public function course_count()
	{
		$this->db->where('CRN',$this->input->post('CRN'));
		$this->db->where('SemesterCode',$this->input->post('semesterID'));
		$this->db->where('Section',$this->input->post('Section'));
		
		$result = $this->db->get('sections');
		if($result->num_rows()>0)
		{
			$this->form_validation->set_message('course_count','There is already Section registered with the same Section Number');
			return false;
		}	
		else{ return TRUE; }
	}
	
	public function section_check()
	{
		$this->db->where('CRN',$this->input->post('CRN'));
		$this->db->where('TimeSlotID',$this->input->post('TimeSlotID'));
		$this->db->where('LocationID',$this->input->post('LocationID'));
		$result = $this->db->get('sections');
		if($result->num_rows()>0)
		{
			$this->form_validation->set_message('section_check','This Section already exist');
			return false;
		}	
		else{ return TRUE; }
	}
	
	public function professor_check()
	{
		if (!($this->input->post('Faculty')== "0"))
		{
			$this->db->where('SemesterCode',$this->input->post('semesterID'));
			$this->db->where('TimeSlotID',$this->input->post('TimeSlotID'));
			$this->db->where('FacultyID',$this->input->post('Faculty'));
			$result = $this->db->get('sections');
			if($result->num_rows()>0)
			{
				$this->form_validation->set_message('professor_check','There is another course already assigned to this faculty');
				return false;
			}
			else{ return TRUE;}
				
		}
		
		else{ return TRUE; }
	}
	
	public function location_check()
	{
		if (!($this->input->post('LocationID')== "0"))
		{
			$this->db->where('SemesterCode',$this->input->post('semesterID'));
			$this->db->where('TimeSlotID',$this->input->post('TimeSlotID'));
			$this->db->where('LocationID',$this->input->post('LocationID'));
			$result = $this->db->get('sections');
			if($result->num_rows()>0)
			{
				$this->form_validation->set_message('location_check','There is another course already registered for that time and place');
				return false;
			}
			else{ return TRUE;}
				
		}
		
		else{ return TRUE; }
	}
	
	public function zeroValue_check()
	{
		
		if($this->input->post('semesterID') == "0" || $this->input->post('DepartmentCode') == "0" || $this->input->post('CRN') == "0" || $this->input->post('TimeSlotID') == "0" || $this->input->post('courseLevel') == "0")
		{
			$this->form_validation->set_message('zeroValue_check','Please Select a Value for All (*) option');
			return false;
		}	
		else{ return TRUE; }
	}
	
	public function viewEditSchedule($past = NULL,$dataFlash = NULL)
	{
		$this->form_validation->set_rules('semesterID','Semester ID','callback_zeroValueSemester_check');
		if($this->form_validation->run() == FALSE)
		{
			$data['dataFlash'] = $dataFlash;
			$data['past'] = $past;
			$data['getSemester'] = $this->admin_model->getAllSemester();
			$data['main_content'] = 'admin/viewEditSchedule';
			$this->load->view('Layouts/main',$data);
		}
		else
		{
				$data['dataFlash'] = $dataFlash;
				$data['past'] = $past;
				$data['sectionBySem']=$this->admin_model->viewSchedule($this->input->post('semesterID'));
				$data['getSemester'] = $this->admin_model->getAllSemester();
				$data['main_content'] = 'admin/viewEditSchedule';
				$this->load->view('Layouts/main',$data);
		}
		
		
	}
	
	public function zeroValueSemester_check()
	{
		
		if($this->input->post('semesterID') == "0")
		{
			$this->form_validation->set_message('zeroValueSemester_check','Please Select a Semester');
			return false;
		}	
		else{ return TRUE; }
	}
	
	public function editSchedule($secID)
	{
		$this->form_validation->set_rules('TimeSlotID','Time Slot','callback_location_check|callback_section_check|callback_professor_check|callback_zeroValueSTimeSlot_check');
		if($this->form_validation->run() == FALSE)
		{
			$this->db->where('CRN',$secID);
			$secQuery = $this->db->get('sections');
			$data['preReq']=$this->admin_model->getCoursePreqByName($secQuery->row(0)->CourseID);
			$data['dataflash'] = NULL;
			$data['DepartmentCode'] = $this->admin_model->getDepBySecID($secID);
			$data['getAllFaculty']= $this->admin_model->getAllFaculty();
			$data['allLocation']= $this->admin_model->getAllLocation();
			$data['getCourseBySecID']= $this->admin_model->getCourseBySecID($secID);
			$data['allTimeSlot'] = $this->admin_model->getAllTimeSlot();
			$data['getSchedule']=$this->admin_model->getSchedule($secID);;
			$data['main_content'] = 'admin/editSchedule';
			$this->load->view('Layouts/main',$data);
		}
		else
		{
			if($this->admin_model->update_Schedule($secID))
			{
				
				$data['dataflash'] = 'The Schedule has been Updated';
				$data['getCourseBySecID']= $this->admin_model->getCourseBySecID($secID);
				$data['DepartmentCode'] = $this->admin_model->getDepBySecID($secID);
				$data['allLocation']= $this->admin_model->getAllLocation();
				$data['getAllFaculty'] = $this->admin_model->getAllFaculty();
				$data['allTimeSlot'] = $this->admin_model->getAllTimeSlot();
				$data['getSchedule']=$this->admin_model->getSchedule($secID);
				$data['main_content'] = 'admin/editSchedule';
				$this->load->view('Layouts/main',$data);
			}
		}
	}
	
	public function zeroValueSTimeSlot_check()
	{
		
		if($this->input->post('TimeSlotID') == "0")
		{
			$this->form_validation->set_message('zeroValueSTimeSlot_check','Please Select a TimeSlot');
			return false;
		}	
		else{ return TRUE; }
	}
	
	public function deleteSchedule($secID)
	{
		$this->db->where('CRN',$secID);
		$result = $this->db->get('sections');
		
	 
		if($this->admin_model->deleteSchedule($secID))
		{
			$dataFlash = 'This Schedule has been Deleted';
			$this->viewEditSchedule($result->row(0)->SemesterCode,$dataFlash);
		}
	}
	
	public function viewEditUser($pastRole = "0")
	{
		
		if($this->input->post('role'))
		{
			$role = $this->input->post('role');
			$data['userRole']= $role;
			$data['userInfo'] = $this->User_model->getUserInfo($role);
		}
		
		$data['pastRole']=$pastRole;
		$data['main_content'] = 'users/viewEditUser';
		$this->load->view('Layouts/main',$data);
	}
	
	public function editUser($id = 0,$role)
	{
		
		$data['userInfo']= $this->User_model->userInfo($id);
		if($role = "Student")
		{
			$data['userRole'] = $role;
			$data['studentInfo'] = $this->User_model->studentInfo($id);
		}
		$data['DepCode'] = $this->admin_model->getDepCode();
		$data['id']=$id;
		$data['main_content'] = 'users/editUser';
		$this->load->view('Layouts/main',$data);
	}
	
	public function prereq()
	{
		$this->form_validation->set_rules('course','Course','callback_duplicatePreReq');
		if($this->form_validation->run() == FALSE)
		{
			$preq= $this->admin_model->getCoursePreq();
			$count=0;
			foreach($preq as $row)
			{
				$this->db->where('CourseID',$row->prereqID);
				$getpreName = $this->db->get('course');
				$storage[$count++]= array(
											'courseID'=>$row->CourseID,
											'courseNum'=>$row->CourseNum,
											'courseDepCode'=>$row->DepartmentCode,
											'courseTitle'=>$row->CourseTitle,
											'preqID'=>$getpreName->row(0)->CourseID,
											'preqCourseNum'=>$getpreName->row(0)->CourseNum,
											'preqDepCode'=>$getpreName->row(0)->DepartmentCode,
											'preqCourseTitle'=>$getpreName->row(0)->CourseTitle,
										  );
			}
			$data['getPrereq']=$storage;
			$data['allCourse'] = $this->admin_model->getAllCourse();
			$data['main_content'] = 'admin/prereq';
			$this->load->view('Layouts/main',$data);
		}
		else
		{
			if($this->admin_model->addPreReq())
			{
				$preq= $this->admin_model->getCoursePreq();
				$count=0;
				foreach($preq as $row)
				{
					$this->db->where('CourseID',$row->prereqID);
					$getpreName = $this->db->get('course');
					$storage[$count++]= array(
												'courseID'=>$row->CourseID,
												'courseNum'=>$row->CourseNum,
												'courseDepCode'=>$row->DepartmentCode,
												'courseTitle'=>$row->CourseTitle,
												'preqID'=>$getpreName->row(0)->CourseID,
												'preqCourseNum'=>$getpreName->row(0)->CourseNum,
												'preqDepCode'=>$getpreName->row(0)->DepartmentCode,
												'preqCourseTitle'=>$getpreName->row(0)->CourseTitle,
											  );
				}
				$data['getPrereq']=$storage;
				$data['allCourse'] = $this->admin_model->getAllCourse();
				$data['main_content'] = 'admin/prereq';
				$this->load->view('Layouts/main',$data);
			}
		}
	}
	
	public function duplicatePreReq()
	{
		$this->db->where('courseID', $this->input->post('course'));
		$this->db->where('prereqID', $this->input->post('prereq'));
		$result = $this->db->get('preq');
		if($result->num_rows()>0)
		{
			$this->form_validation->set_message('duplicatePreReq','Duplicate PreReq');
			return false;
		}
		else{ return TRUE;}
	}
	
	public function deletePrereq($courseID,$preReqID)
	{
		if($this->admin_model->deletePrereq($courseID,$preReqID))
		{
			$this->prereq();
		}
	}
	
	public function OverRideStudentSchedule()
	{
		
		$this->form_validation->set_rules('studentID','Student ID','trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('crn','CRN','trim|required|numeric|xss_clean');
	
		if($this->form_validation->run() == FALSE)
		{
			$data['getSemester'] = $this->admin_model->getAllSemester();
			$data['main_content'] = 'admin/OverRideStudentSchedule';
			$this->load->view('layouts/main',$data);
		}
		else
		{
			if($this->admin_model->insertStudSeh())
			{
				$this->session->set_flashdata('OverRideStudentSchedule','The Course Section Has been Added to Student Schedule');
				redirect('admin_register/OverRideStudentSchedule');
			}
		}
	}
}