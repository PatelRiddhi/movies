 <div class="panel-group m-bot20" id="accordion">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">
                                                    More information about <?php echo $movies['title']; ?> 
                                                </h3>
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class="panel">
                                            <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Movie Title :</label>
                                                <div class="col-lg-10">
                                                    <h5><?php echo $movies['title']; ?></h5>
                                                </div>
                                        </div>
                                        <div class="panel">
                                            <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Actors :</label>
                                            <div class="col-lg-10">
                                                <?php 
                                                foreach ($actors as $actor) 
                                                {                                                    
                                                }
                                                ?>
                                                <h5><?php echo $actor['firstname']." ".$actor['lastname']; ?></h5>
                                            </div>
                                        </div>
                                        <div class="panel">
                                            <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Long Description :</label>
                                            <div class="col-lg-10">
                                                <h5><?php echo $blog['long_description']; ?></h5>
                                            </div>
                                        </div>
                                       
                                        <button class="btn btn-info"><a href="<?php echo base_url('admin/blogs/cancel'); ?>">BACK</button>
</div>                                        
                                            