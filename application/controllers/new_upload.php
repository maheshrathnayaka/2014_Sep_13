    <?php

class New_Upload extends CI_Controller 
{
	

	function __costruct()
	{
		parent::__costruct();


	}

	public function index()
	{
         $this->load->library('session');
	} 
        
        public function createthumb($imgpath)//create thumb 
        {
             
                       
            $config['image_library'] = 'gd2';
            $config['source_image'] = $imgpath;
            $config['create_thumb'] = TRUE;
            $config['thumb_marker'] = '_thumb';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 150;
            $config['height'] = 150;
                   
            $this->load->library('image_lib', $config);
  
            
           if ( ! $this->image_lib->resize())
           {
                echo $this->image_lib->display_errors();
           }
           $this->image_lib->clear();          
        
        }
        
        public function createWatermark($imgpath) 
        {
            //water mark
          
           $config['image_library'] = 'gd2';
           $config['source_image'] = $imgpath;
           $config['wm_text'] = 'Copyright 2014 - KStore';
           $config['wm_type'] = 'text';
           $config['wm_font_path'] = './system/fonts/texb.ttf';
           $config['wm_font_size'] = '16';
           $config['wm_font_color'] = 'ffffff';
           $config['wm_vrt_alignment'] = 'middle';
           $config['wm_hor_alignment'] = 'center';
           $config['wm_padding'] = '20';
           $config['wm_opacity']='30';

            $this->image_lib->initialize($config);
            $this->image_lib->watermark();    
            $this->image_lib->clear();
        }
                

        public function uploadImage() 
        {        
        if(isset($_POST))
        {
	$DestinationDirectory	=  APPPATH . '../images/temp/';
	
	//check if this is an ajax request
	if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
            die();
	}
	
	// check $_FILES['ImageFile'] not empty
	if(!isset($_FILES['ImageFile']) || !is_uploaded_file($_FILES['ImageFile']['tmp_name']))
	{
            die('Something wrong with uploaded file, something missing!'); // output error when above checks fail.
	}
	
	// Random number will be added after image name
	$RandomNumber 	= rand(0, 9999999999); 

	$ImageName 		= str_replace(' ','-',strtolower($_FILES['ImageFile']['name'])); //get image name
	$ImageSize 		= $_FILES['ImageFile']['size']; // get original image size
	$TempSrc	 	= $_FILES['ImageFile']['tmp_name']; // Temp name of image file stored in PHP tmp folder
	$ImageType	 	= $_FILES['ImageFile']['type']; //get file type, returns "image/png", image/jpeg, text/plain etc.

	//Let's check allowed $ImageType, we use PHP SWITCH statement here
	switch(strtolower($ImageType))
	{
		case 'image/png':
			//Create a new image from file 
			$CreatedImage =  imagecreatefrompng($_FILES['ImageFile']['tmp_name']);
			break;
		case 'image/gif':
			$CreatedImage =  imagecreatefromgif($_FILES['ImageFile']['tmp_name']);
			break;			
		case 'image/jpeg':
		case 'image/pjpeg':
			$CreatedImage = imagecreatefromjpeg($_FILES['ImageFile']['tmp_name']);
			break;
		default:
			die('Unsupported File!'); //output error and exit
	}
	
	//PHP getimagesize() function returns height/width from image file stored in PHP tmp folder.
	//Get first two values from image, width and height. 
	//list assign svalues to $CurWidth,$CurHeight
	list($CurWidth,$CurHeight)=getimagesize($TempSrc);
	
	//Get file extension from Image name, this will be added after random name
	$ImageExt = substr($ImageName, strrpos($ImageName, '.'));
  	$ImageExt = str_replace('.','',$ImageExt);
	
	//remove extension from filename
	$ImageName 		= preg_replace("/\\.[^.\\s]{3,4}$/", "", $ImageName); 
	
	//Construct a new name with random number and extension.
        $user = $this->session->userdata['logged_in']['userid'];
	$NewImageName = $user.'-'.$RandomNumber.'.'.$ImageExt;
        $NewImageThumbName = $user.'-'.$RandomNumber.'_thumb.'.$ImageExt;
	
	//set the Destination Image
	
	$DestRandImageName    = $DestinationDirectory.$NewImageName; // Image with destination directory
	//$newDestRandImageName = $DestRandImageName;
        
        if(move_uploaded_file($_FILES['ImageFile']['tmp_name'], $DestRandImageName  ))
	{
            
            $this->createthumb($DestRandImageName);
            //$NewThumbImageName = $ImageName.'-'.$RandomNumber.'_thumb.'.$ImageExt;
            //$this->createWatermark($newDestRandImageName);
	
                echo '<img src="http://kstoretesting.net16.net/images/temp/'.$NewImageThumbName.'">';
                echo '<input type="button" value="Remove" onclick="removeImage(this.id)" id="'.$NewImageName.'" class="btn" style="border-color: #dbd1d1; margin-top: 3px;color: #B19195;">';

	}
        else
        { 
		die('error uploading File!');
	}
     

        }


        }
        
        public function removeImage($idAndDiv)  
        {

        $split = explode("~",$idAndDiv);
        $imageid = $split[0];
        $diveid =  $split[1];
            
        $this->load->helper('file');
        $imagepath = APPPATH . '../images/temp/'.$imageid;
        $defaultImagePath=APPPATH . '../images/upload.png';
        if(unlink($imagepath))
         {   
            
            if($diveid=="img11"){
                echo '<img style="margin-top: 20px;" src="'.$defaultImagePath.'" hight="97px" width="155px"/>';
                echo '<input type="button" onclick="imgDiv1click()" id="submit-btn1" value="upload image" class="btn" style="border-color: #dbd1d1; margin-top: 8px;color: #B19195;" />';
            }
            else if ($diveid=="img12"){
                echo '<img style="margin-top: 20px;" src="'.$defaultImagePath.'" hight="97px" width="155px"/>';
                echo '<input type="button" onclick="imgDiv2click()" id="submit-btn2" value="upload image" class="btn" style="border-color: #dbd1d1; margin-top: 8px;color: #B19195;" />';
            }
            else if ($diveid=="img13"){
                echo '<img style="margin-top: 20px;" src="'.$defaultImagePath.'" hight="97px" width="155px"/>';
                echo '<input type="button" onclick="imgDiv3click()" id="submit-btn3" value="upload image" class="btn" style="border-color: #dbd1d1; margin-top: 8px;color: #B19195;" />';
            }
            else{
                echo '<img style="margin-top: 20px;" src="'.$defaultImagePath.'" hight="97px" width="155px"/>';
                echo '<input type="button" onclick="imgDiv4click()" id="submit-btn4" value="upload image" class="btn" style="border-color: #dbd1d1; margin-top: 8px;color: #B19195;" />';
            }
           
         }
         
        }
        

        
}

