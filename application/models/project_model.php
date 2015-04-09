<?php class Project_model extends CI_Model
{
/**
 * This function gets project listing from project table
 * @param int department id
 * @return array project list
*/
  public function listing($deptid = '')
  {
    $this->db->select('projectid, projecttitle, category.name category, department.deptname deptname, active');
    $this->db->join('department','department.deptid=project.deptid');
    $this->db->join('category','category.id=project.catid','left outer');
    if ($deptid == '') {
    } else {
      $this->db->where(array('project.deptid' => $deptid));
    }
    $query = $this->db->get('project');
    if ($query->num_rows() >= 1) {
      return $query->result_array();
    } else {
      return false;
    }
  }
  /**
   * This function gets project categories
   * @return array project categories
   */
  public function get_category_master()
  {
    $this->db->select('id, category.name, department.deptname deptname, categorydesc');
    $this->db->join('department', 'department.deptid = category.deptid',
      'left outer');
    $query = $this->db->get('category');
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return false;
    }
  }
} ?>    