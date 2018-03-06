<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard - SB Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="<?php echo base_url(); ?>css/sb-admin.css" rel="stylesheet">
   
    <!-- Page Specific CSS -->
    <script src="<?php echo base_url(); ?>js/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
     <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
 </head>

 <body>
<?php $page = $this->uri->segment(3);
$CI =& get_instance();
$CI->load->model('setting_model');
$setting = $CI->setting_model->get_all(); 
foreach ($setting as $key => $value) 
    {
      if($value['role'] == $this->session->userdata('role'))
      {
        $k = $key;
        $permission =  $CI->setting_model->get_permission_id($value['id']);
        $setting[$key]['permission'] = array_column($permission, 'permission');
      }
    }

$this->session->set_userdata('permission', $setting[$k]['permission']);
?>
    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo base_url('dashboard'); ?>">SB Admin</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li class="active"><a <?php if($page=='' || $page=='dashboard') echo 'class="active"';  ?> href="<?php echo base_url('dashboard'); ?>"> Dashboard</a></li>

            <?php if(in_array('actors', $this->session->userdata('permission'))){ ?>
            <li><a <?php if($page=='actors') echo 'class="active"';  ?> href="<?php echo base_url('actors'); ?>"><i class="fa fa-user"></i> Actors</a></li>
            <?php } ?>

            <?php if(in_array('directors', $this->session->userdata('permission'))){ ?>
            <li><a <?php if($page=='directors') echo 'class="active"';  ?> href="<?php echo base_url('directors'); ?>"><i class="fa fa-user"></i> Directors</a></li>
            <?php } ?>

            <?php if(in_array('genres', $this->session->userdata('permission'))){ ?>
            <li><a <?php if($page=='genres') echo 'class="active"';  ?> href="<?php echo base_url('genres'); ?>"><i class="fa fa-asterisk"></i> Genres</a></li>
            <?php } ?>

            <?php if(in_array('movies', $this->session->userdata('permission'))){ ?>
            <li><a <?php if($page=='movies') echo 'class="active"';  ?> href="<?php echo base_url('movies'); ?>"><i class="fa fa-film"></i>  Movies</a></li>
            <?php } ?>

            <?php if(in_array('settings', $this->session->userdata('permission'))){ ?>
            <li class="dropdown">
            <li><a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo base_url('settings'); ?>"><i class="fa fa-gear"></i> Settings <b class="caret"></b></a>
                <ul class="dropdown-menu">
                <li><a href="<?php echo base_url('settings/add_permission'); ?>">Add Permission</a></li>
                <li><a href="<?php echo base_url('settings/add_role'); ?>">Add Role</a></li>
                <li><a href="<?php echo base_url('settings'); ?>">update Permission</a></li>
              </ul>   
            </li>
              
              <?php } ?>
          </ul>
          
          <ul class="nav navbar-nav navbar-right navbar-user">
            <a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-user"></i><?php echo "Welcome  ".$this->session->userdata('username'); ?></a><br>
            <li class="divider"></li>
              <a href="<?php echo base_url('admin/logout'); ?>"><i class="fa fa-power-off"></i>LOGOUT</a>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
<?php
        if(!$content =='')
        {
            echo $content;
        }
?>
      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="<?php echo base_url(); ?>js/bootstrap.js"></script>

    <!-- Page Specific Plugins -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script src="<?php echo base_url(); ?>js/morris/chart-data-morris.js"></script>
    <script src="<?php echo base_url(); ?>js/tablesorter/jquery.tablesorter.js"></script>
    <script src="<?php echo base_url(); ?>js/tablesorter/tables.js"></script>
    
  </body>
</html>
<script type="text/javascript">
$("#ckbCheckAll").click(function () {
    $(".checkbBoxClass").prop('checked', $(this).prop('checked'));
});
</script>
