<script src="<?php echo base_url(); ?>js/jquery-1.10.2.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
     var counter =2;
    $('#add').click(function(){
      
       if(counter>10){
            alert("Only 10 textboxes allow");
            return false;
    }   
    counter++;
        var html = $('#main').html();
        $('#copyactor').append(html);
    });

    $("#remove").click(function(){
        $("#div1").remove();
    });
  });
</script>
<div class="col-lg-6">
                          <section class="panel">
                              <header class="panel-heading">
                                  ADD MOVIES
                              </header>
                              <div class="panel-body">
                                  <form role="form" action="<?php base_url('movies/add/'); ?> " method="post">
                                      <div class="form-group">
                                          <label>Movie Name</label>
                                          <input type="text" class="form-control" id="title" name="title" placeholder="Enter movie name here..." required>
                                      </div>
                                      <div class="form-group">
                                          <label>Year</label>
                                          <input type="text" class="form-control" id="year" name="year" required>
                                      </div>
                                      <div class="form-group">
                                          <label>Duration</label>
                                          <input type="text" class="form-control" id="duration" name="duration" required>
                                      </div>
                                      <div class="form-group">
                                          <label>release Date</label>
                                          <input type="date" class="form-control" id="release_date" name="release_date" required>
                                      </div>
                                      <div class="form-group">
                                        <label>Genres</label>
                                        <select class="form-control" name="genres" required>
<?php
      foreach ($genres as $row) 
      {
?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
<?php
      }
?>
                                        </select>
                                      </div>
                                      <label>Actors</label>
                                      <button id="add" class="btn btn-info">+</button>
                                      <div id="main">
                                        <div class="form-group " id="actors">
                                          <div class="col-lg-6 text-center">
                                            <select class="form-control" name="actor[]" required>
<?php
      foreach ($actors as $row) 
      {
?>
                                                  <option value="<?php echo $row['id']; ?>"><?php echo $row['firstname']." ".$row['lastname']; ?></option>
<?php
      }
?>
                                            </select>
                                          </div> 
                                          <div class="col-lg-3 text-center">
                                              <input type="text" name="role[]" class="form-control" required>
                                          </div>
                                          <a id="remove" class="btn btn-info">-</a> <br>
                                        </div>
                                      </div>           
                                 
                                      <div id="copyactor"></div>
                                      
                                      </div>
                                      
                                                           
                                      <div class="form-group" >
                                        <label>Directors</label>
                                        <select class="form-control" name="director" required>
<?php
      foreach ($directors as $row) 
      {
?>
                                          <option value="<?php echo $row['id']; ?>"><?php echo $row['firstname']." ".$row['lastname']; ?></option>
<?php
      }
?>
                                        </select>
                                      </div>                                                            
                                      <div class="form-group" >
                                        <label>Language</label>
                                        <select class="form-control" name="language" required>
                                          <option value="English">English</option>
                                          <option value="Hindi">Hindi</option>
                                          <option value="Gujarati">Gujarati</option>
                                          <option value="Malyalam">Malyalam</option>
                                          <option value="Punjabi">Punjabi</option>
                                        </select>
                                      </div>
                                      <div class="form-group">
                                        <label>Country</label>
                                        <select class="form-control"  name="country" required>
                                          <option value="UK">UK</option>
                                          <option value="USA">USA</option>
                                          <option value="IN">India</option>
                                          <option value="NZ">Newzeland</option>
                                        </select>
                                      </div>
                                      <button type="submit" class="btn btn-info">ADD</button>
                                      <button class="btn btn-info"><a href="<?php echo base_url('movies/cancel'); ?>">CANCEL</button>
                                  </form>

                              </div>
                          </section>
                      </div>