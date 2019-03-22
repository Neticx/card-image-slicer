<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ImageController extends CI_Controller {

    protected $images_path = array();

	public function index()
	{
		$this->load->view('index');
	}

    public function store()
    {
        $imageData = array('full','number','name','photo','address1','address2','address3','expired');
        $type = $this->input->post('type');
        if ($type == 'KTP'){
            array_push($imageData,'address4');
        }

        $timestamp = time();

        foreach ($imageData as $imageDatum) {
            $this->saveImage($type,$this->input->post($imageDatum."_image"),$imageDatum, $timestamp);
        }

        if ($this->db->insert('images',$this->images_path)){
            echo "ok";
        }
	}

    private function saveImage($card_type,$imgData,$imgName,$time)
    {

        $img = str_replace('data:image/png;base64,', '', $imgData);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $path = '/assets/images/'.$card_type.'_'.$imgName.'_'.$time.'.jpg';
        $file = $_SERVER['DOCUMENT_ROOT'] . $path;
        file_put_contents($file, $data);
        $this->images_path[$imgName] = $path;
	}
}
