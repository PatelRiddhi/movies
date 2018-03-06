<div class="col-lg-6">
                          <section class="panel">

                            <div class="row">
                            
                              <header class="panel-heading">
                                  ADD DIRECTORS DETAIL
                              </header>
                              <div class="panel-body">
                                  <form role="form" action="<?php echo base_url('directors/add/'); ?>" method="post">

                                      <div class="form-group">
                                          <label>First Name</label>
                                          <input type="text" class="form-control" id="firstname" name="firstname" required>
                                      </div>
                                      <div class="form-group">
                                          <label>Last Name</label>
                                          <input type="text" class="form-control" id="lastname" name="lastname" required> 
                                      </div>
                                       <button type="submit" class="btn btn-info">ADD</button>
                                      <button class="btn btn-info"><a href="<?php echo base_url('directors/cancel'); ?>">CANCEL</button>
                                  </form>
                               </div>
                          </section>   
                      </div>
