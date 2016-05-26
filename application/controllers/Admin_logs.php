<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
class Admin_logs extends MY_Controller {

    public function __construct()    {
        parent::__construct();
        $breadcrumb = array();
        
        if(!$this->session->userdata('is_logged_in')){
            redirect(base_url());
        }
    }

	public function index(){
		
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));		
			$language = $this->lang->language;

			//if($this->input->server('REQUEST_METHOD') === 'POST'){
					
					$data_input = $this->input->get();
					$id = $data_input['id'];
					$type = $data_input['type'];
					
					//$id = $this->uri->segment(2);
					//$type = $this->uri->segment(3);

					$datalog = array(
							"ref_type" => $type,
							"ref_id" => $id
					);
					$view_log = $this->Admin_log_activity_model->view_log(0, $datalog);
					//Debug($view_log);

					if($view_log){
								//Debug($view_log);

						$alllogs = count($view_log);

						$html = '<div class="col-sm-12">
									<div style="min-height: 31px;" class="col-xs-12 col-sm-12 widget-container-col ui-sortable">
														<div style="opacity: 1;" class="widget-box widget-color-orange ui-sortable-handle collapsed">
																<div class="widget-header widget-header-small">
																	<h6 class="widget-title">
																		<i class="ace-icon fa fa-sort"></i>
																		'.$language['admin logs activity'].'
																	</h6>

																	<div class="widget-toolbar">
																		<a href="#" data-action="collapse">
																			<i class="ace-icon fa fa-plus" data-icon-show="fa-plus" data-icon-hide="fa-minus"></i>
																		</a>
																		<a href="#" data-action="close">
																			<i class="ace-icon fa fa-times"></i>
																		</a>
																	</div>
																</div>

																<div style="display: none;" class="widget-body">
																	<div class="widget-main">

								<table id="sample-table-1" class="table table-striped table-bordered table-hover">
																<thead>
																	<tr>
																		<th>ID</th>
																		<th>'.$language['title'].'</th>
																		<th>'.$language['action'].'</th>
																		<th>'.$language['admin'].' '.$language['username'].'</th>
																		<th>'.$language['create_date'].'</th>
																	</tr>
																</thead>
																<tbody>';

									for($i=0;$i<$alllogs;$i++){
												
												$admin_log_id = $view_log[$i]->admin_log_id;
												//$ref_type = $view_log[$i]->ref_type;
												$ref_id = $view_log[$i]->ref_id;
												$ref_title = $view_log[$i]->ref_title;
												$action = action_view_logs($view_log[$i]->action);
												$admin_username = $view_log[$i]->admin_username;
												$create_date = RenDateTime($view_log[$i]->create_date);

												$html .= "<tr>
															<td>".$admin_log_id."</td>
															<td>".$ref_title."</td>
															<td>".$action."</td>
															<td>".$admin_username."</td>
															<td>".$create_date."</td>
												</tr>";				
									}

									$html .= '</tbody></table>

																	</div>
																</div>
															</div>
														</div>
													</div>';

			//}

	}

}