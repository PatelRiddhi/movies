<div class="row">
          <div class="col-lg-12">
            <h2>Manage Actors</h2>
          <div class="row">
            <div class="col-lg-6">
              <p><?php
                $access = $this->session->userdata('access');
                foreach ($access as $key=>$value) 
                {
                    if($value['permission'] == 'actors')
                    {
                ?>
                <?php if($value['insert'] == 1)
                {
                ?>
                <a href="<?php echo base_url('actors/add/'); ?>" class="btn btn-default">Add New</a>
                <?php 
                }
                ?>
                <form id="checkboxdata" method="post" >
      
            </div>
            <div class="col-lg-12 pull-right">
                <input type="text" name="table_search" id="search_box" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                <button type="button" name="serach" class="btn btn-sm btn-default pull-right" id="search" ><i class="fa fa-search"></i></button>
              </form>    
              </p>
            </div>
          </div>
          <?php if($value['delete_all'] == 1)
                {
                ?>
            <div class="table-responsive">
              <form method="post" action="<?php echo base_url('actors/delete_all/');?>">
               <button type="submit" class="btn btn-danger" name="delete_all" id="delete_all" onclick="return confirm('Are you sure you want to delete these data?');">Delete All</button>
               <?php 
                }
                ?>
              <table class="table table-hover tablesorter" id="example">
                
                  <tr>
                    <th><input type="checkbox" id="ckbCheckAll" ></th> 
                    <th>Sr. No. <i class="fa fa-sort"></i></th>
                    <th>First Name <i class="fa fa-sort"></i></th>
                    <th>Last Name <i class="fa fa-sort"></i></th>
                    <th>Gender <i class="fa fa-sort"></i></th>
                    <?php if(($value['update'] == 1) && ($value['delete'] == 1))
                    {
                    ?>
                    <th>Action</th>
                     <?php } ?>
                  </tr>
                
                <tbody class="data">
<?php
        foreach ($actors as $row)
        {
?> 
               <tr>
                    <td><input type="checkbox" class="checkbBoxClass" id="select" name="select[]" value="<?php echo $row['id'] ?>"></td> 
                    <td><?php echo $start+1;  $start++; ?></td>
                    <td><?php echo ucfirst($row['firstname']); ?></td>
                    <td><?php echo ucfirst($row['lastname']); ?></td>
                    <td><?php if($row['gender'] == 'F')
                              {
                                echo "Female";
                              }
                              elseif($row['gender'] == 'M')
                              {
                                echo "Male";
                              }
                        ?></td>
                    <?php if($value['update'] == 1)
                    {
                    ?>
                    <td><a href= "<?php echo base_url('actors/edit/').$row['id'];?>" > Edit </a> | <?php } ?> 
                    <?php if($value['delete'] == 1)
                    {
                    ?>
                    <a href= "<?php echo base_url('actors/delete/').$row['id'];?>" onclick="return confirm('Are you sure you want to delete this data?');">  Delete </a> <?php } ?>
                  </tr>
<?php
        }
?>
                </tbody>
              </table>
              </form>
              <?php 
        }
    }
    ?>
              <ul class="pagination pagination-sm m-b-10 m-t-10 pull-right">
                  <li><?php echo $links; ?></li>
              </ul>
            </div>
          </div>

<script type="text/javascript">
        $(document).ready(function() {

            // Search
            $("#search").click(function(){
                var m_name = $("#search_box").val();
             
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('actors/search'); ?>',
                    data: {member_name:m_name},
                    cache: true,
                    datatype: 'html',
                    success: function(data)
                    {
                        $("#search_box").val(m_name);
                        $('.data').html(data);                                
                    }
                });
            });

        } );
       
    </script>        