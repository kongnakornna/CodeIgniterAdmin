<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagination_Model extends CI_Model {
      function __construct() {
        parent::__construct();
    }
    // Count all record of table "contact_info" in database.
      public function record_count() {
        return $this->db->count_all("contact_info");
    }
    
    // Fetch data according to per_page limit.
    public function fetch_data($limit, $id) {
    	
			$from = '2008-01-10';
            $to = '2015-01-10';
            $idn='3650799085644';
            $name='ประ';
            $provincename='เพรช';
        	$language = $this->lang->language['lang'];
        	$this->db->distinct();
            $this->db->select('a.*,b.member_type_name,c.status_type_name,d.geo_name,e.province_name,f.amphur_name,g.district_name,h.village_name,i.countries_name,j.zipcode');
            $this->db->from('_na_member a'); 
            $this->db->join('_member_type b', 'b.member_type_id_map=a.member_type_id', 'left');
            $this->db->join('_status_type c', 'c.status_type_id_map=a.status', 'left');
            $this->db->join('_na_geography d', 'd.geo_id_map=a.geography_id', 'left');
			$this->db->join('_na_province e', 'e.province_id_map=a.province_id_map', 'left');
			$this->db->join('_na_amphur f', 'f.amphur_id_map=a.amphur_id_map', 'left');
			$this->db->join('_na_district g', 'g.district_id_map=a.district_id_map', 'left');
			$this->db->join('_na_village h', 'h.village_id_map=a.village_id_map', 'left');
			$this->db->join('_na_countries i', 'i.countries_id=a.countries_id', 'left');
			$this->db->join('_na_zipcode j', 'j.district_id=a.district_id_map', 'left');
            $this->db->where('a.lang', $language);
            $this->db->where('b.lang', $language);
            $this->db->where('d.lang', $language);
            $this->db->where('e.lang', $language);
            $this->db->where('f.lang', $language);
            $this->db->where('g.lang', $language);
            $this->db->where('h.lang', $language);
            $this->db->where('a.member_type_id',1);
            //$this->db->where('a.status_type_id_map',2);
            //$this->db->where('a.startdate >=', $from);
			//$this->db->where('a.startdate <=', $to);
            //$this->db->where('a.idcard', $idn);
            //$this->db->or_like('a.idcard', $idn);
            //$this->db->or_like('a.name', $name);
            //$this->db->or_like('e.province_name', $provincename);
            #$this->db->order_by('a.member_id','asc');         
            $this->db->where('id', $id);
            $this->db->order_by('a.member_id','desc');         
            $this->db->limit($limit);
            
            $query = $this->db->get(); 
 //echo $this->db->last_query();
    	
 
        
        $query = $this->db->get("contact_info");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
         
            return $data;
        }
        return false;
   }
}
?>