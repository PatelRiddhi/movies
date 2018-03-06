<div class="col-lg-6">
                          <section class="panel">
                              <header class="panel-heading">
                                  EDIT DIRECTORS DETAIL
                              </header>
                              <div class="panel-body">
                                  <form role="form" action="<?php echo base_url('directors/edit/').$director['id']; ?>" enctype="multipart/form-data" method="post">

                                      <div class="form-group">
                                          <label>First Name</label>
                                          <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $director['firstname']; ?>">
                                      </div>
                                      <div class="form-group">
                                          <label>Last Name</label>
                                          <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $director['lastname']; ?>" >
                                      </div>
                                       <button type="submit" class="btn btn-info">UPDATE</button>
                                      <button class="btn btn-info"><a href="<?php echo base_url('directors/cancel'); ?>">CANCEL</button>
                                  </form>

                              </div>
                          
                          </section>
                      </div>