<div class="col-lg-6">
                          <section class="panel">

                            <div class="row">
                            
                              <header class="panel-heading">
                                  ADD GENRES DETAIL
                              </header>
                              <div class="panel-body">
                                  <form role="form" action="<?php echo base_url('genres/add/'); ?>" method="post">

                                      <div class="form-group">
                                          <label>Title</label>
                                          <input type="text" class="form-control" id="title" name="title" required>
                                      </div>
                                       <button type="submit" class="btn btn-info">ADD</button>
                                      <button class="btn btn-info"><a href="<?php echo base_url('genres/cancel'); ?>">CANCEL</button>
                                  </form>
                               </div>
                          </section>   
                      </div>
