<?php
$n=0;
$page='email/';
if( $this->uri->segment(3)<>FALSE )
{
	$n=$this->uri->segment(3);
	$page.=$n.'/';
}

$action=$page;
if( $n===0 )
	$action='email/0/';
?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Admin | E-Mail Setting</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="shortcut icon" href="<?php echo $this->config->item('favicon');?>">
<link href="<?php echo _css('admin'); ?>" rel="stylesheet" />
<link href="<?php echo _css('colors/blue'); ?>" rel="stylesheet" id="colors" />
<!--[if lt IE 9]>
	<script src="../../assets/js/html5.js"></script>
<![endif]-->
<script src="<?php echo _js('jquery.min'); ?>" type="text/javascript"></script>
<script src="<?php echo _js('jquery.form-validator.min'); ?>" type="text/javascript"></script>
<script>
$(document).ready(function(){
	base_url="<?php echo site_url('getjson')?>" + '/';
});
</script>
<script src="<?php echo _js('admin'); ?>" type="text/javascript"></script>
</head>
<body>

<div id="wrapper">

	<?php $this->load->view('admin/header'); ?>

	<nav id="navigation">
		<ul class="menu" id="responsive">
			<li><a href="<?php echo home();?>"><i class="halflings white home"></i> Home</a></li>
			<li><a href="<?php echo admin('about');?>"><i class="halflings white tags"></i> About Us</a>
				<ul class="cols3">
					<li class="col3">
						<h4>Other Link</h4>
					</li>
					<li class="col1">
						<h5>Page Layouts</h5>
						<ol>
							<li><a href="<?php echo admin('about');?>"> About</a></li>
							<li><a href="<?php echo admin('rd');?>"> R&D</a></li>
							<li><a href="<?php echo admin('testimonials');?>"> Testimonials</a></li>
						</ol>
					</li>
					<li class="col1">
						<h5>Other Pages</h5>
						<ol>
							<li><a href="<?php echo admin('faq');?>"> FAQ's</a></li>
							<li><a href="<?php echo admin('activity');?>"> Activities</a></li>
						</ol>
					</li>
				</ul>
			</li>

			<li><a href="<?php echo admin('oem');?>"><i class="halflings white globe"></i> OEM</a></li>
			<li><a href="<?php echo admin('products');?>"><i class="halflings white qrcode"></i> Products</a></li>
			<li><a href="<?php echo admin('faq');?>"><i class="halflings white question-sign"></i> FAQ's</a></li>
			<li><a href="<?php echo admin('contact');?>" id="current"><i class="halflings white envelope"></i> Contact</a></li>
		</ul>
	</nav>
	<div class="clearfix"></div>

	<div id="content">

		<article class="title">
			<h2>Admin <span>/ Contact</span></h2>
			<ul>
				<li>Total<span><?php echo number_format($num_rows);?></span>Record<?php if( $num_rows>1) echo 's';?></li>
			</ul>
		</article>
		<div class="clearfix"></div>
			<div class="container" id="alert">
				<div class="notification success closeable">
					<p>fsdfsdfsdfsd</p>
				</div>
			</div>
			<?php
			if($this->session->flashdata('message'))
			echo '<div class="container message" style="position:absolute;z-index:1000;margin-top:-12px;">
						<div class="notification '.notification(substr($this->session->flashdata('message'),0,1)).' closeable">
							<p>'.substr($this->session->flashdata('message'),1).'</p>
						</div>
					</div>';
			?>
			<div class="container topbar">
				<nav class="tools">
					<a href="<?php echo admin('contact');?>" class="button color"><i class="icon-envelope-alt"></i> Message Management</a>
					<a href="#" class="button color internal" data-show="divAdd"><i class="icon-plus-sign"></i> เพิ่ม e-mail ผู้รับ Message</a>
					<a href="<?php echo admin('email');?>" class="button light refresh"><i class="icon-refresh"></i> Refresh</a>
					<a href="<?php echo admin($page);?>" class="button light reload"><i class="icon-rotate-left"></i> Reload</a>
				</nav>
				<?php 
				if( $num_rows > 0) :
				?>
				<form id="contact-frm" action="<?php echo admin($page);?>" method="POST">
				<div style="margin:0 15px;">
				<table class="data-table email">
					<thead>
						<tr>
							<th width="40">No</th>
							<th width="60"><input type="checkbox" id="checkall" /></th>
							<th width="60">ID</th>
							<th width="240">Account</th>
							<th>E-Mail</th>
							<th width="80"><i class="icon-edit"></i> Edit</th>
							<th width="80">Active</th>
							<th width="160">Date Created</th>
							<th width="160">Date Modified</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach($data as $key=>$rs)
						{
						$status=( $rs['active']=='Y' )?'':' inactive';
						$id=$rs['id'];
						++$n;
						echo '<tr class="rowdata'.$status.'" data-id="'.$id.'" id="'.$id.'">
							<td class="cn">'.$n.'</td>
							<td class="cn"><input type="checkbox" name="del[]" class="chk" value="'.$id.'"></td>
							<td class="cn">'.$id.'</td>
							<td><div class="left w240 nowrap">'.$rs['account'].'</div></td>
							<td><div class="left nowrap">'.$rs['email'].'</div></td>
							<td><a href="#" class="edit"><div class="cn w80 nowrap">แก้ไข</div></a></td>
							<td class="status"><div class="cn w80 nowrap">'.$rs['active'].'</div></td>
							<td><div class="cn w160 nowrap">'.$rs['created'].'</div></td>
							<td><div class="cn w160 nowrap">'.substr($rs['updated'],0,16).'</div></td>
						</tr>';
						}
						?>
						</tbody>
					</table>
					<div class="container">
						<ul class="pages">
							<li>
								<button type="submit" name="btnDelete" class="button delete disabled"><i class=" icon-trash"></i> Delete</button><p><a href="#" class="unselectall">ยกเลิกเลือกทั้งหมด</a><a href="#" class="strselectall">เลือกทั้งหมด</a></p><p id="information" class="success"></p>
							</li>
							<li>
								<?php echo $pages; ?>
							</li>
						</ul>
					</div>
					<div class="clearfix"></div>
				</form>
				<?php endif ?>

				<div class="container reset divAdd">
					<div id="add" class="form" data-type="1" data-id="" data-action="email">
						<h2><i class="icon-plus-sign"></i> Add new e-mail<span>/ เพิ่ม e-mail ผู้รับ Message จากหน้าเว็ปไซด์</span></h2>
						<form name="addEmail" id="addEmail" action="<?php echo admin($action);?>" method="POST">
						<ul>
							<li> Account</li>
							<li><input type="text" name="account" id="account" data-validation="required" placeholder="กรอก Account"></li>
							<li> E-Mail</li>
							<li><input type="text" name="email" id="email" data-validation="email" placeholder="กรอก E-Mail"></li>
							<li><button type="submit" class="button" name="submit"><i class=" icon-save"></i> Submit</button><input type="reset" class="button light"><p id="information" class="success"></p></li>
						</ul>
						</form>
					</div>
				</div>
				<div class="clearfix"></div>

		</div>
	</div>
</div>

<?php
$this->load->view('admin/footer');
?>
</body>
</html>
