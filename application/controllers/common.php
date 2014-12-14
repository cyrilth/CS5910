<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class common extends CI_Controller 
{
	public function viewCourseSection()
	{
		$this->form_validation->set_rules('semesterID','Semester ID','callback_zeroValueSemester_check');
		if($this->form_validation->run() == FALSE)
		{
			$data['getSemester'] = $this->admin_model->getAllSemester();
			$data['main_content'] = 'common/viewCourseSection';
			$this->load->view('Layouts/main',$data);
		}
		else
		{
				$data['sectionBySem']=$this->admin_model->viewSchedule($this->input->post('semesterID'));
				$data['getSemester'] = $this->admin_model->getAllSemester();
				$data['main_content'] = 'common/viewCourseSection';
				$this->load->view('Layouts/main',$data);
		}
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
		$data['main_content'] = 'common/viewCatalogue';
		$this->load->view('Layouts/main',$data);
	}
	public function viewPrereq($secID)
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
			$data['main_content'] = 'common/viewPrereq';
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
				$data['main_content'] = 'common/viewPrereq';
				$this->load->view('Layouts/main',$data);
			}
		}
	}
	
	
	
}