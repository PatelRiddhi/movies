<script src="<?php echo base_url(); ?>js/jquery-1.10.2.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#add').click(function(){
        var html = $('#main').html();
        $('#copyactor').append(html);
    });

    $('#remove').on('click','#remove',function(e){
        e.preventDefault();
        $('#').prevUntil('#actors').remove();
    });
  });
</script>
<div class="col-lg-6">
                          <section class="panel">
                              <header class="panel-heading">
                                  EDIT MOVIES
                              </header>
                              <div class="panel-body">
                                  <form role="form" action="<?php base_url('movies/edit/'); ?> " method="post">
                                      <div class="form-group">
                                          <label>Movie Name</label>
                                          <input type="text" class="form-control" id="title" name="title" value="<?php echo $movie['title']; ?>">
                                      </div>
                                      <div class="form-group">
                                          <label>Year</label>
                                          <input type="text" class="form-control" id="year" name="year" value="<?php echo $movie['year']; ?>">
                                      </div>
                                      <div class="form-group">
                                          <label>Duration</label>
                                          <input type="text" class="form-control" id="duration" name="duration" value="<?php echo $movie['duration']; ?>">
                                      </div>
                                      <div class="form-group">
                                          <label>release Date</label>
                                          <input type="date" class="form-control" id="release_date" name="release_date" value="<?php echo $movie['release_date']; ?>">
                                      </div>
                                      <div class="form-group">
                                        <label>Genres</label>
                                        <select class="form-control" name="genres" required>
<?php
      $CI =& get_instance();
      $CI->load->model('genres_model');
      $CI->load->model('directors_model');
      $CI->load->model('actors_model');
      
      $genre_id = $CI->genres_model->get_genre_id($movie['id']);
      foreach ($genres as $row) 
      {
?>
                                            <option value="<?php echo $row['id']; ?>" 
                                              <?php
                                              foreach ($genre_id as $g_id) 
                                              {
                                                if($g_id['genre_id']==$row['id'])
                                                  {
                                        
                                                      echo "selected";
                                                  }
                                              }
                                              ?>><?php echo $row['title'];  ?></option>
<?php
      }
?>
                                        </select>
                                      </div>
                                      <!--
<?php
      $actor_id = $CI->actors_model->get_actor_id($movie['id']);
      $actor=$CI->actors_model->get_by_id($actor_id[0]['actor_id']);

?>
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
                                      
                                      </div> -->                                             
                                      <div class="form-group" >
                                        <label>Directors</label>
                                        <select class="form-control" name="director" required>
<?php
      $director_id = $CI->directors_model->get_director_id($movie['id']);
      foreach ($directors as $row) 
      {
?>
                                          <option value="<?php echo $row['id']; ?>"
                                            <?php
                                              foreach ($director_id as $d_id) 
                                              {
                                                if($d_id['director_id']==$row['id'])
                                                  {
                                        
                                                      echo "selected";
                                                  }
                                              }
                                              ?>><?php echo $row['firstname']." ".$row['lastname']; ?></option>
<?php
      }
?>
                                        </select>
                                      </div> 
                                      <?php echo $movie['language']; ?>                                                           
                                      <div class="form-group" >
                                        <label>Language</label>
                                        <select class="form-control" name="language" required>
                                          <option value="English" <?php echo($movie['language']=="English") ? 'selected':''  ?> >English</option>
                                          <option value="Hindi" <?php echo($movie['language']=="Hindi") ? 'selected':'' ?> >Hindi</option>
                                          <option value="Gujarati" <?php echo($movie['language']=="Gujarati") ? 'selected':''  ?> >Gujarati</option>
                                          <option value="Malyalam" <?php echo($movie['language']=="Malyalam") ? 'selected':''  ?> >Malyalam</option>
                                          <option value="Punjabi" <?php echo($movie['language']=="Punjabi") ? 'selected':''  ?> >Punjabi</option>
                                        </select>
                                      </div>
                                      <div class="form-group">
                                        <label>Country</label>
                                        <select class="form-control"  name="country">
                                          <option value="UK" <?php echo($movie['country']=="UK") ? 'selected':''  ?> >UK</option>
                                          <option value="USA" <?php echo($movie['country']=="USA") ? 'selected':''  ?> >USA</option>
                                          <option value="IN" <?php echo($movie['country']=="IN") ? 'selected':''  ?> >India</option>
                                          <option value="NZ" <?php echo($movie['country']=="NZ") ? 'selected':''  ?> >Newzeland</option>
                                        </select>
                                      </div>
                                      <button type="submit" class="btn btn-info">ADD</button>
                                      <button class="btn btn-info"><a href="<?php echo base_url('movies/cancel'); ?>">CANCEL</button>
                                  </form>

                                    </div>
                          </section>
                      </div>