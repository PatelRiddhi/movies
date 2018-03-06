<div class="col-lg-6">
                          <section class="panel">
                              <header class="panel-heading">
                                  EDIT ACTORS DETAIL
                              </header>
                              <div class="panel-body">
                                  <form role="form" action="<?php echo base_url('actors/edit/').$actor['id']; ?>" enctype="multipart/form-data" method="post">

                                      <div class="form-group">
                                          <label>First Name</label>
                                          <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $actor['firstname']; ?>">
                                      </div>
                                      <div class="form-group">
                                          <label>Last Name</label>
                                          <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $actor['lastname']; ?>" >
                                      </div>
                                      <div class="form-group">
                                        <label>Gender</label>
                                        <div class="radio">
                                          <label>
                                            <input type="radio" name="gender" id="gender" <?php if($actor['gender']== 'M'){echo "checked";} ?> value="M" >
                                            Male
                                          </label>
                                        </div>
                                        <div class="radio">
                                          <label>
                                            <input type="radio" name="gender" id="gender" <?php if($actor['gender']== 'F'){echo "checked";} ?> value="F">
                                            Female
                                          </label>
                                        </div>
                                      </div>


                                       <button type="submit" class="btn btn-info">UPDATE</button>
                                      <button class="btn btn-info"><a href="<?php echo base_url('actors/cancel'); ?>">CANCEL</button>
                                  </form>

                              </div>
                              
                          </section>
                      </div>