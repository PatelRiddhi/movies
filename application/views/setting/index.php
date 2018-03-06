<div class="col-lg-6">
                          <section class="panel">
                              <header clas="panel-heading">
                                  SETTING PERMISSIONS
                              </header>
                              <div class="panel-body">
                                  <form role="form" action="<?php echo base_url('settings'); ?>"  method="post">
                              <div class="form-group col-lg-6">
<?php 
    foreach ($setting as $row) 
    {
      if($row['role'] != 'admin')
      {
?>
                                  
                                      <label><?php echo $row['role']; ?></label>
<?php
      foreach ($permission as $value) 
      {
?>
                                      <div class="checkbox">
                                        <label>
                                          <input type="checkbox" name="<?php echo $row['id']; ?>[]" value="<?php echo $value; ?>"
                                          <?php
                                              if(in_array($value, $row['permission']))
                                              {
                                                      echo "checked";
                                              }
                                              
                                          ?>
                                          >
                                          <?php echo $value; ?>
                                        </label>
                                      </div>
<?php
        }
      }
    }
?>

                                       <button type="submit" class="btn btn-info">SAVE</button>
                                      <button class="btn btn-info"><a href="<?php echo base_url('settings/cancel'); ?>">CANCEL</button>
                                  </form>

                              </div>
                          
                          </section>
                      </div>