
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kappe Admin Panel | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="Developed By M Abdur Rokib Promy">
    <meta name="keywords" content="Admin, Bootstrap 3, Template, Theme, Responsive">
    <!-- bootstrap 3.0.2 -->
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />

<section class="content">
  <div class="row">                      
    <div class="col-lg-offset-4 col-lg-4">
        <section class="panel">
            <center>
            <header class="panel-heading">
                <h2>Admin Login</h2>
            </header>
            </center>
            <center>
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="<?php echo base_url('admin/login'); ?>">
                    <div class="form-group">
                        <label for="inputusername" class="col-lg-2 col-sm-2 control-label">Username</label>
                        <div class="col-lg-10">
                            <input type="username" class="form-control" name="username" id="inputusername" placeholder="username">                                             
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Password</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" name="password" id="inputPassword1" placeholder="Password">
                        </div>
                    </div>                    
                    <div class="form-group">
                        <div class="col-lg-offsefghjt-2 col-lg-10">
                            <button type="submit" class="btn btn-danger">Sign in</button>
                        </div>
                    </div>
                </form>
            </div>
        </center>
        </section>
      </div>
  </div>
</section>
                          