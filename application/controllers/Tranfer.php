<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tranfer extends CI_Controller {

    public function __construct()    {
        parent::__construct();
		 //$this->load->model('Vdo_model');
		 $breadcrumb = array();

        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }

	public function index(){

	}

	public function zoonnews($catid = null){
		
			//$this->load->model('Category_model', 'Subcategory_model', 'News_model', 'Tranfer_model');

			$this->load->model('Category_model');
			$this->load->model('Subcategory_model');
			$this->load->model('News_model');
			$this->load->model('Tranfer_model');

			$data_en = $data_th = array();
			$insert = false;
			$display = true;

			if($this->input->get('number'))
				$number = $this->input->get('number');
			else
				$number = 20;
			//Debug($this->input->get());

			$id = 0;

			$load_zoonnews = $this->Tranfer_model->load_zoonnews();

			if($display == true) Debug($load_zoonnews);

			//$data_list = $this->Tranfer_model->load_news($catid, 1, $number);

	}

	public function news($idzone = null){
		
			$this->load->model('Category_model');
			$this->load->model('Subcategory_model');
			$this->load->model('News_model');
			$this->load->model('Tranfer_model');

			$data_en = $data_th = $picture = array();
			$insert = true;
			$display = false;
			$page = 1;

			if($this->input->get('number'))
				$number = $this->input->get('number');
			else
				$number = 200;

			if($this->input->get('page')) $page = $this->input->get('page');

			//Debug($this->input->get());

			$id = $news_id = 0;
			$category_id = 3;
			$subcategory_id = 9;

			$data_list = $this->Tranfer_model->load_news($idzone, $page, $number);

			if($display == true) Debug($data_list);
			//die();
			#24-12-57
			//IDZONE 001 ==> 1-1 = 17496 
			//IDZONE 002 ==> 1-1 = 10975 
			//IDZONE 003 ==> 11-17 = 7121 
			//IDZONE 004 ==> 11-19 = 3623 
			//IDZONE 005 ==> 1-3 = 6405 
			//IDZONE 006 ==> 1-3 = 1763 
			//IDZONE 007 ==> 17-37 = 54 
			//IDZONE 008 ==> 13-27 = 3201 
			//IDZONE 009 ==> 1-1 = 498 
			//IDZONE 010 ==> 1-3 = 374 

			$get_max_id = $this->News_model->get_max_id('_news_old');
			$news_id = $get_max_id[0]['max_id'];

			$get_order = $this->News_model->get_max_order(1);
			$order_id = $get_order[0]->max_order;
			//Debug($order_id);
			//die();

			if(isset($data_list)){
				if($data_list['header']['code'] == 200){
					$all = count($data_list['body']);
					echo "<br>ALL = $all <br>";
					for($i=0;$i<$all;$i++){
								
								unset($picture);
								unset($idnewsrelate);
								//unset($picture);

								$idnews = $data_list['body'][$i]['IDNews'];
								$filename = $data_list['body'][$i]['FileName'];
								$FkIDZone = $data_list['body'][$i]['FkIDZone'];
								$FkIDDara = $data_list['body'][$i]['FkIDDara'];

								$topic = StripTxt($data_list['body'][$i]['Topic']);
								$topicshort = StripTxt($data_list['body'][$i]['Topicshort']);
								$detail = $data_list['body'][$i]['Detail'];

								$detailpic1 = $data_list['body'][$i]['DetailPic1'];
								$tag = $data_list['body'][$i]['Tag'];

								$datecreate = $data_list['body'][$i]['DateCreate'];
								$timecreate = $data_list['body'][$i]['TimeCreate'];

								$fkiduser = $data_list['body'][$i]['FkIDUser'];
								$gennews = $data_list['body'][$i]['GenNews'];
								$countclick = $data_list['body'][$i]['CountClick'];
								$gencode = $data_list['body'][$i]['GenCode'];
								$orderzone = $data_list['body'][$i]['OrderZone'];
								$sex = $data_list['body'][$i]['sex'];
								$nude = $data_list['body'][$i]['nude'];
								$folder = $datecreate;

								$picture[] = $data_list['body'][$i]['Pic0'];
								$picture[] = $data_list['body'][$i]['Pic1'];
								$picture[] = $data_list['body'][$i]['Pic2'];
								$picture[] = $data_list['body'][$i]['Pic3'];

								$idnewsrelate = explode(",", $data_list['body'][$i]['IDNewsRelate']);

								$create_date = ConvertDate8toFormat(trim($datecreate)).' '.$timecreate;

								$news_id++;
								$order_id++;

								if(count($idnewsrelate) > 1) $relate = json_encode($idnewsrelate);

								$data[$i] = 
									array(
										  'news_id' => $news_id ,
										  'news_id2' => $news_id ,
										  'idzone' => $idzone,
										  'idnews' => $idnews,
										  'fkiddara' => $FkIDDara,
										  'category_id' => $category_id,
										  'subcategory_id' => $subcategory_id,
										  'title' => $topic,
										  'description' => $topicshort,
										  'detail' => $detail,
										  'folder_img' => $folder,
										  'create_date' => $idnews,
										  'countview' => $countclick,
										  'picture' => json_encode($picture),
										  'relate' => json_encode($create_date),
										  'gender' => $sex,
										  'create_date' => $create_date,
										  'create_by' => 1,
										  'status' => $gennews,
										  'lang' => 'th',
										  'order_by' => $order_id
									);

								/*********************************
								$data_en[$i]['news_id'] = $news_id;
								$data_en[$i]['news_id2'] = $news_id;

								$data_en[$i]['idnews'] = $idnews;
								$data_en[$i]['title'] = $topic;
								$data_en[$i]['description'] = $topicshort;
								//$data_en[$i]['detail'] = $detail;

								$data_en[$i]['folder_img'] = $folder;
								$data_en[$i]['create_date'] = $create_date;
								$data_en[$i]['countview'] = $countclick;

								$data_en[$i]['picture'] = json_encode($picture);
								if(count($idnewsrelate) > 1) $data_en[$i]['relate'] = json_encode($idnewsrelate);

								switch($sex){	
										case 1 : $sex = 'm'; break;
										default : $sex = 'f'; break;
								}

								$data_en[$i]['gender'] = $sex;
								$data_en[$i]['status'] = $gennews;
								$data_en[$i]['lang'] = 'th';
								$data_en[$i]['order_by'] = $order_id;
								*****************************/

								//Debug($data_en[$i]);
								//Debug($idnewsrelate);

								/*Debug($picture);
								Debug($idnewsrelate);

								echo '<img src="'.$data_list['body'][$i]['Pic0'].'" border="0" /><br>';
								echo '<img src="'.$data_list['body'][$i]['Pic1'].'" border="0" /><br>';
								echo '<img src="'.$data_list['body'][$i]['Pic2'].'" border="0" /><br>';
								echo '<img src="'.$data_list['body'][$i]['Pic3'].'" border="0" /><br>';
								echo "<hr>";*/

					}
					
					if($display == true) Debug($data);

					if($insert == true){
							if($this->News_model->add_batch($data, '_news_old', 0)){
								echo "<br>Import news $all Success.";
							}else
								echo "<br>Can not insert data.";
					}

					
					/*if($insert == true){
							if($this->Tranfer_model->import_to_db($data_en)){
									echo "<br>Import  en $all Success.";
							}
							if($this->Tranfer_model->import_to_db($data_th)){
									echo "<br>Import  th $all Success.";
							}
					}*/
				}
			}


	}

	public function copy_news($idzone = null){ //Copy Data from tmp to live

				//$this->load->model('Category_model');
				//$this->load->model('Subcategory_model');
				$this->load->model('News_model');
				$this->load->model('Column_model');
				$this->load->model('Tranfer_model');

				//$data_en = $data_th = $picture = array();
				$insert = true;
				$display = false;
				$page = 1;

				switch($idzone){
						case "001" :
							$type = 1;	//1 =News , 2 = Column
							$category_id = 1;
							$subcategory_id = 1;
						break;
						case "002" :
							$type = 1;
							$category_id = 1;
							$subcategory_id = 1;
						break;
						case "003" :
							$type = 2;
							$category_id = 11;
							$subcategory_id = 17;
						break;
						case "004" :
							$type = 2;
							$category_id = 11;
							$subcategory_id = 19;
						break;
						case "005" :
							$type = 1;
							$category_id = 1;
							$subcategory_id = 3;
						break;
						case "006" :
							$type = 1;
							$category_id = 1;
							$subcategory_id = 3;
						break;
						case "007" :
							$type = 2;
							$category_id = 17;
							$subcategory_id = 37;
						break;
						case "008" :
							$type = 2;
							$category_id = 13;
							$subcategory_id = 27;
						break;
						case "009" :
							$type = 1;
							$category_id = 1;
							$subcategory_id = 1;
						break;
						case "010" :
							$type = 1;	//1 =News , 2 = Column
							$category_id = 3;
							$subcategory_id = 9;
						break;				
				}
				//echo "idzone = $idzone";
				//die();

				if($this->input->get('number'))
					$number = $this->input->get('number');
				else
					$number = 200;

				if($this->input->get('page')) $page = $this->input->get('page');

				$id = 0;
				$data_list = $this->Tranfer_model->load_table_news($idzone, $page, $number);
				$alldata = count($data_list);

				if($type == 1){

					$get_max_id = $this->News_model->get_max_id();
					$get_order = $this->News_model->get_max_order($category_id);
					$max_id = $get_max_id[0]['max_id'];
					$order_id = $get_order[0]->max_order;

				}else{

					$get_max_id = $this->Column_model->get_max_id();
					$get_order = $this->Column_model->get_max_order($category_id);

					$max_id = $get_max_id[0]['max_id'];
					//$max_id = 29401;
					$order_id = $get_order[0]->max_order;
				}

				//echo "$alldata record<hr>";
				//Debug($order_id);
				//Debug($data_list);
				if(isset($data_list)){
							for($i=0;$i<$alldata;$i++){
									
									$max_id++;
									$order_id++;
									if($type == 1){
										$data[$i] = 
											array(
												  'news_id' => $data_list[$i]->news_id,
												  'news_id2' => $data_list[$i]->news_id,
												  'category_id' => $data_list[$i]->category_id,
												  'subcategory_id' => $data_list[$i]->subcategory_id,
												  'title' => $data_list[$i]->title,
												  'description' => $data_list[$i]->description,
												  'detail' => $data_list[$i]->detail,
												  'countview' => $data_list[$i]->countview,
												  'gender' => $data_list[$i]->gender,
												  'credit_id' => 1,

												  'create_date' => $data_list[$i]->create_date,
												  'create_by' => 1,
												  'status' => $data_list[$i]->status,
												  'lang' => 'th',
												  'order_by' => $order_id
											);
									}else{
										$data[$i] = 
											array(
												  'column_id' => $max_id,
												  'column_id2' => $max_id,
												  'category_id' => $data_list[$i]->category_id,
												  'subcategory_id' => $data_list[$i]->subcategory_id,
												  'title' => $data_list[$i]->title,
												  'description' => $data_list[$i]->description,
												  'detail' => $data_list[$i]->detail,
												  'countview' => $data_list[$i]->countview,
												  'credit_id' => 1,

												  'create_date' => $data_list[$i]->create_date,
												  'create_by' => 1,
												  'status' => $data_list[$i]->status,
												  'lang' => 'th',
												  'order_by' => $order_id
											);									
									}

							}
				}

				//die();

				if(isset($data)){
						if($display == true) Debug($data);

						if($insert == true){
									if($type == 1)
										$this->Tranfer_model->add_batch($data, '_news');
									else if($type == 2)
										$this->Tranfer_model->add_batch($data, '_column');

									echo "<br>Import new data $alldata Success.";
						}else{
									echo "<br>Can not insert data.";
						}
				}

	}
	
	public function download($id = null){

				//DEFINE( 'DS', DIRECTORY_SEPARATOR );
				DEFINE( 'DS', '/' );
				$this->load->model('Picture_model');
				$this->load->model('Tranfer_model');

				$copy_img = true;
				$ref_type = 1;
				$i = 0;
				$caption = $create_date = '';
				$picture_obj = null;

				$data_input = $this->input->get();
				//Debug($data_input);

				$url_pic = base64_decode($data_input['url']);
				$picture = explode("/", $url_pic);
				$filename = $picture[count($picture)-1];
				$folder = $data_input['folder'];

				$folder_img = explode("-", ConvertDate8toFormat($folder));
				$tmp_folder = '';
				if(isset($folder_img)){
						foreach($folder_img as $val){
								$tmp_folder .= $val.DS;
								$this->Tranfer_model->chkfolder_exists($tmp_folder);
						}
				}
				$folder = implode(DS, $folder_img);

				if($copy_img == true){
						$img_size = @getimagesize($url_pic);
						$picture_size = ($img_size[0] > 0) ? $img_size[0] : 0;
				}else
						$picture_size = 0;

				if(($picture_size > 0) && ($copy_img == true)){
						//echo "<br>Tranfer_model->download($url_pic, $folder, $filename, $ref_type, $picture_size)<br>";
						$display_pic = $this->Tranfer_model->download($url_pic, $folder, $filename, $ref_type, $picture_size);
				}//Download Complete

				$newsobj = $this->Tranfer_model->load_table_news("000", 1, 1, $id);
				
				$picture_obj[$i]['ref_id'] = $id;
				$picture_obj[$i]['ref_type'] = $ref_type;
				$picture_obj[$i]['file_name'] = $filename;
				//$picture_obj['title'] = StripTxt($data_input['title']);

				$picture_obj[$i]['caption'] = StripTxt($newsobj[0]->title);
				$picture_obj[$i]['folder'] = $folder;
				$picture_obj[$i]['create_date'] = $newsobj[0]->create_date;
				$picture_obj[$i]['create_by'] = $this->session->userdata('admin_id');
				$picture_obj[$i]['status'] = 1;
				$picture_obj[$i]['order'] = 1;
				$picture_obj[$i]['default'] = 1;

				$this->Picture_model->add_batch($picture_obj);

				redirect('news/picture/'.$id);
				die();
	}

	public function view_news($idzone = null){

				//DEFINE( 'DS', DIRECTORY_SEPARATOR );
				DEFINE( 'DS', '/' );

				$this->load->model('Picture_model');
				$this->load->model('News_model');
				//$this->load->model('Column_model');
				$this->load->model('Tranfer_model');

				//$data_en = $data_th = $picture = array();
				$insertdb = false;
				$copy_img = true;
				$display = false	;

				echo "<br>insertdb = ".intval($insertdb);
				echo "<br>copy_img = ".intval($copy_img);
				echo "<br>display = ".intval($display)."<hr>";

				$page = 1;
				$ref_type = 1;
				$pic_obj = new stdClass();
				$picture_obj = array();

				if($this->input->get('number'))
					$number = $this->input->get('number');
				else
					$number = 200;

				if($this->input->get('page')) $page = $this->input->get('page');

				//Debug($this->input->get());
				$id = $news_id = 0;
				$data_list = $this->Tranfer_model->load_table_news($idzone, $page, $number, 0, 1);  //load data from sd_news_old
				$alldata = count($data_list);

				echo "all = ".$alldata."<br>";
				//Debug($data_list);
				//die();

				if(isset($data_list)){
							for($i=0;$i<$alldata;$i++){
									
									$pic_obj = json_decode($data_list[$i]->picture);

									$folder_img = explode("-", ConvertDate8toFormat($data_list[$i]->folder_img));
									
									//$order_id++;
									$data[$i] = 
										array(
											  'idnews' => $data_list[$i]->idnews,
											  'picture' => $pic_obj,
											  'fkiddara' => $data_list[$i]->fkiddara,
											  'folder_img' => $folder_img,
											  'relate' => $data_list[$i]->relate,

											  'news_id' => $data_list[$i]->news_id,
											  'news_id2' => $data_list[$i]->news_id2,
											  'category_id' => $data_list[$i]->category_id,
											  'subcategory_id' => $data_list[$i]->subcategory_id,
											  'title' => $data_list[$i]->title,
											  //'description' => $data_list[$i]->description,
											  //'detail' => $data_list[$i]->detail,

											  'countview' => $data_list[$i]->countview,
											  'gender' => $data_list[$i]->gender,
											  'create_date' => $data_list[$i]->create_date,
											  'create_by' => 1,
											  'status' => $data_list[$i]->status,
											  'lang' => 'th',
											  //'order_by' => $order_id
										);

									if($display == true) Debug($data[$i]);

									//Debug($folder_img);
									$tmp_folder = '';
									if(isset($folder_img)){
											foreach($folder_img as $val){
													$tmp_folder .= $val.DS;
													$this->Tranfer_model->chkfolder_exists($tmp_folder);
											}
									}
									//Debug($pic_obj);

									$picture0 = $pic_obj[0];
									$fname = explode("/", $picture0);
									$filename = $fname[count($fname)-1];

									$folder = implode(DS, $folder_img);

									if($copy_img == true){
										$img_size = @getimagesize($picture0);
										$picture_size = ($img_size[0] > 0) ? $img_size[0] : 0;
									}else
										$picture_size = 0;

									//Debug($img_size);
									//Debug($this->input->get());

									/*echo "<br>picture=$picture0<br>";
									echo "<br>filename=$filename<br>";
									echo "<br>picture_size=$picture_size<br>";
									echo "<br>this->Tranfer_model->download($picture0, $folder, $filename, $ref_type)<br>";*/

									if(($picture_size > 0) && ($copy_img == true)){
										//if($copy_img == true) 
										if($i == 0) 
											$display_pic = $this->Tranfer_model->download($picture0, $folder, $filename, $ref_type, $picture_size, 1);
										else
											$display_pic = $this->Tranfer_model->download($picture0, $folder, $filename, $ref_type, $picture_size);
									}

									//Add Picture to DB
									//unset($picture_obj);
									$picture_obj[$i]['ref_id'] = $data_list[$i]->news_id2;
									$picture_obj[$i]['ref_type'] = $ref_type;
									$picture_obj[$i]['file_name'] = $filename;
									//$picture_obj['title'] = StripTxt($data_input['title']);
									
									$picture_obj[$i]['caption'] = StripTxt($data_list[$i]->title);
									$picture_obj[$i]['folder'] = $folder;
									$picture_obj[$i]['create_date'] = $data_list[$i]->create_date;
									$picture_obj[$i]['create_by'] = $this->session->userdata('admin_id');
									$picture_obj[$i]['status'] = 1;
									$picture_obj[$i]['order'] = 1;
									$picture_obj[$i]['default'] = 1;

									//if((count($picture_list) == 0) && ($i == 0)) $picture_obj['default'] = 1;
									//$this->Picture_model->store(0, $picture_obj);

									unset($pic_obj);
									//exit;
							}
				}

				if(isset($data)){
						
						if($insertdb == true) $this->Picture_model->add_batch($picture_obj);
						echo "<br>picture_obj = ".count($picture_obj);

						echo "<br>Complete $alldata record.";
						unset($data_list);
						unset($data);

						//if($display == true) Debug($data);
						/*if($insertdb == true){
									$this->News_model->add_batch($data, '_news');
									echo "<br>Import news $alldata Success.";
						}else{
									echo "<br>Can not insert data.";
						}*/
				}

	}

	/*public function view_column(){

				$this->load->model('Picture_model');
				$this->load->model('Column_model');
				$this->load->model('Tranfer_model');

				//SELECT * FROM `sd_column` WHERE column_id > 180 ORDER BY column_id

				$cat = 13;
				$subcat = 27;

				$data_list = $this->Tranfer_model->get_column($cat, $subcat);
				$alldata = count($data_list);

				echo "alldata = $alldata";
				//Debug($data_list);

				$tmpID = $this->Tranfer_model->GetID_TMP($cat, $subcat);
				$startid = $tmpID[0]->news_id;
				//$startid = 29401;
				Debug($startid);

				//$id = $news_id = 0;
				//$data_list = $this->Tranfer_model->load_table_news($idzone, $page, $number, 1);
				$alldata = count($data_list);

				if(isset($data_list)){
						for($i=0;$i<$alldata;$i++){
								$data = 
										array(
											  'news_id' => $data_list[$i]->column_id,
											  'news_id2' => $data_list[$i]->column_id2,
									);
								$this->Tranfer_model->update_column(intval($startid), $data);
								$startid++;
						}
				}
				//Debug($data);
				echo "<br>Complete $alldata record.";
				unset($data);
				unset($data_list);
	}*/

}