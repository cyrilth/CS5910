<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class facultyCon extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
		if(!($this->session->userdata('logged_in') &&  $this->session->userdata('role') == 'Faculty'))
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
	
	public function viewClassList()
	{
		$checkSem = $this->input->post('semesterID');
		$storage = NULL;
		$count=0;
		if(!($checkSem == "0"))
		{
			$currentFacRecord = $this->faculty_model->getSecByFacSem($this->session->userdata('user_id'),$checkSem);
			if(isset($currentFacRecord))
			{
				foreach($currentFacRecord as $row)
				{
					$this->db->where('CourseID',$row->CourseID);
					$courseInfo = $this->db->get('course');
					$storage[$count++] = array('Section'=>$row->Section,'CRN'=>$row->CRN, 'CurrentEnroll' => $row->CurrentEnroll,'MaxEnroll'=>$row->MaxEnroll,'CourseName' => $courseInfo->row(0)->CourseNum." ".$courseInfo->row(0)->DepartmentCode." ".$courseInfo->row(0)->CourseTitle);
				}
			}
			$data['getRecord'] = $storage;
			$data['getSemester'] = $this->admin_model->getAllSemester();
			$data['semester']=$this->student_model->getSemByID($checkSem);
			$data['main_content'] = 'faculty/viewClassList';
			$this->load->view('layouts/main',$data);
		}
		else
		{
			$data['getSemester'] = $this->admin_model->getAllSemester();
			$data['main_content'] = 'faculty/viewClassList';
			$this->load->view('layouts/main',$data);
		}
	}
	
	public function viewClassRoster($crn,$semID,$courseName,$semName)
	{
		
		$curReg = $this->faculty_model->getCurRegByCS($crn,$semID);
		$storage = NULL;
		$count = 0;
		
		if(!($curReg == 0))
		{
			foreach($curReg as $reg)
			{
				$this->db->where('ID',$reg->studentID);
				$studQuery = $this->db->get('users');
				$storage[$count++] = array(
										   'StudentID' => $reg->studentID, 
										   'Name' =>$studQuery->row(0)->First_Name. " ". $studQuery->row(0)->Last_Name,
										   'midtermGrade'=>$reg->midtermGrade,
										   'courseGrade'=>$reg->courseGrade
										   );
			}
		}
		
		$data['preInfo']=array('CRN'=>$crn,
							   'SemID'=>$semID,
							   'CourseName'=>$courseName,
							   'SemName' =>$semName);
		$data['reg']=$storage;
		$data['main_content'] = 'faculty/viewClassRoster';
		$this->load->view('layouts/main',$data);
	}
	
	public function reportGrade($crn,$semID,$semName,$courseName,$studID,$studName)
	{
		$this->form_validation->set_rules('midterm','Mid Term','trim|required');
		if($this->form_validation->run() == FALSE)
		{
			$curInfo = $this->faculty_model->gradesByID($crn,$studID);
			$data['courseName']=$courseName;
			$data['semName']=$semName;
			$data['studID']= $studID;
			$data['studName']= $studName;
			$data['semID']= $semID;
			$data['crn']=$crn;
			$data['midterm'] = $curInfo->midtermGrade;
			$data['final'] = $curInfo->courseGrade;
			$data['main_content'] = 'faculty/reportGrade';
			$this->load->view('layouts/main',$data);
		}
		else
		{
			if($this->faculty_model->updateGrade($crn,$studID))
			{
				$this->session->set_flashdata('updateGrade','The Grade has been Update');
				$curInfo = $this->faculty_model->gradesByID($crn,$studID);
				$data['courseName']=$courseName;
				$data['semName']=$semName;
				$data['studID']= $studID;
				$data['studName']= $studName;
				$data['semID']= $semID;
				$data['crn']=$crn;
				$data['midterm'] = $curInfo->midtermGrade;
				$data['final'] = $curInfo->courseGrade;
				$data['main_content'] = 'faculty/reportGrade';
				$this->load->view('layouts/main',$data);
			}
		}
	}
	
	public function advisementList()
	{
		$data["advisor"] = $this->faculty_model->getAdvisementList();
		$data['main_content'] = 'faculty/getAdvisementList';
		$this->load->view('layouts/main',$data);
	}
}