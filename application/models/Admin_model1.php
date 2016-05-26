<?php
class Admin_model1 extends CI_Model{
function delete_admin($id=4){
       echo '$id='.$id; die();
        if($id>4){
        $this->db->where('admin_id', $id);
		$this->db->delete('_admin'); 
        }else{
            $this->db->set('status', 0);
            $this->db->where('admin_id', $id);
            $this->db->update('_admin'); 
		    //echo $this->db->last_query();
            //echo '$id='.$id;die();
        }
		 
	}
}