 <?php (defined('BASEPATH')) OR exit('No direct script access allowed');


/**
* 
*/
class MY_controller extends CI_Controller{
	

 public function __construct() {
        parent::__construct();
 }

 public function Plantilla($view, $data = array()){
        $this->load->view("catalogo/head");
        $this->load->view($view,$data);
        $this->load->view("catalogo/footer");
 }

}