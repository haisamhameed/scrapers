<?php
class Whatmobile extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $this->load->model('Whatmobile_model','wm');
        $this->load->helper('curl');
    }
    public function scrape_brands()
    {
    	$page=get_page('https://www.whatmobile.com.pk/');
    	$page=get_subhtml($page,'Search by Brand','Search by Price',15,15);

    	while(strpos($page,'<li>')>0)
    	{
    		//link
    		$link=get_subhtml($page,'href="','"',6,0);
    		$link='https://www.whatmobile.com.pk/'.trim($link);

    		//brand
    		$brand=get_subhtml($page,'">','<',2,0);

    		$page=get_html_after($page,'</li>',4);

    		$temp=array(
    			"link"=>$link,
    			"brand"=>$brand,
    			"site"=>'Whatmobile'
    		);

    		$this->wm->insert_brand($temp);
    	}
    }
    public function scrape_phones_link()
    {
    	$data=$this->wm->get_brand('Whatmobile');
    	if(isset($data) && !empty($data))
    	{
    		foreach($data as $row)
    		{
    			$page=get_page($row['link']);
    			echo $page;
    		}
    	}
    }
}