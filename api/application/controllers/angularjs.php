<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class angularjs extends REST_Controller
{
	/* 
	*	Template used for HTML Emails.
	*/
	
	
	public function __construct() 
     {
           parent::__construct(); 
           $this->load->database();
     }
	function newsupdate_get()
    {
        if(!$this->get('id'))
        {
        	$this->response("Bad request", 400);
        }
		$this->load->model('newsupdatemodel');
        $newsupdate = $this->newsupdatemodel->get_newsupdate($this->get());
		    	
        if($newsupdate)
        {
            $this->response($newsupdate[0], 200); // 200 being the HTTP response code
        }
        else
        {
            $this->response(array('error' => 'News update could not be found'), 404);
        }
    }
		
	function newsupdate_post()
    {
		if(!$this->post('title') || !$this->post('description'))
        {
        	$this->response("Bad request", 400);
        }
		$this->load->model('newsupdatemodel');
		$result = $this->newsupdatemodel->save_newsupdate($this->post());
		if ( ! $result )
		{
			$this->response("Internal server error..", 500);
		} 
		else 
		{
			$this->response('Record created', 200); // 200 being the HTTP response code
		}
    }
	

	// fetch news
	function newsupdates_get()
    {
        $this->load->model('newsupdatemodel');
        $news = $this->newsupdatemodel->get_newsupdates();
		if($news)
        {
            $this->response($news, 200); // 200 being the HTTP response code
        }
        else
        {
            $this->response(array('error' => 'No news found!'), 404);
        }
    }
	
	public function newsupdate_delete($id)
    {
		$this->load->model('newsupdatemodel');
        $result = $this->newsupdatemodel->delete_newsupdate($id);
		if($result)
        {
            $this->response(array('success' => 'Record deleted!'), 200); // 200 being the HTTP response code
        }
        else
        {
            $this->response(array('error' => 'No news found!'), 404);
        }       
    }
	
	public function send_post()
	{
		var_dump($this->request->body);
	}


	public function send_put()
	{
		var_dump($this->put('foo'));
	}
}