<?php defined('BASEPATH') OR exit('No direct script access allowed'); /** * */

class Model_resetsistem extends CI_Model {
	function reset_it(){
		
			$query = "
			TRUNCATE TABLE trs_jurnal_detail
			";

			 $this->db->query($query);
			
			$query = "
			TRUNCATE TABLE trs_jurnal
			";

			 $this->db->query($query);
			
			
			$query = "
			TRUNCATE TABLE aktiva_details
			";

			 $this->db->query($query);
			
			
			$query = "
			TRUNCATE TABLE aktiva
			";

			
			$query = "
			TRUNCATE TABLE counter
			";

			return $this->db->query($query);
		
	}
}
?>
