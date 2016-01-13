 <?php (defined('BASEPATH')) OR exit('No direct script access allowed');


/**
* 
*/
class MY_controller extends CI_Controller{
	

 public function __construct() {
        parent::__construct();
 }

 public function Plantilla1($view, $data = array()){
     
     $this->load->view("plantilla/script");
     $this->load->view("plantilla/header");
     $this->load->view($view,$data);
     $this->load->view("plantilla/footer");
        
 }
 
 public function vista($view, $data = array()){
     
     $this->load->view("plantilla/script");
     $this->load->view($view,$data);
     $this->load->view("plantilla/footer");
        
 }

}