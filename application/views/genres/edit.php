<div class="col-lg-6">
                          <section class="panel">
                              <header class="panel-heading">
                                  EDIT GENRES DETAIL
                              </header>
                              <div class="panel-body">
                                  <form role="form" action="<?php echo base_url('genres/edit/').$genres['id']; ?>" enctype="multipart/form-data" method="post">

                                      <div class="form-group">
                                          <label>Title</label>
                                          <input type="text" class="form-control" id="title" name="title" value="<?php echo $genres['title']; ?>">
                                      </div>                                     
                                       <button type="submit" class="btn btn-info">UPDATE</button>
                                      <button class="btn btn-info"><a href="<?php echo base_url('genres/cancel'); ?>">CANCEL</button>
                                  </form>

                              </div>
                          
                          </section>
                      </div>