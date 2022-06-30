<!DOCTYPE html>
<html>
 <head>
  <title>Live search in laravel using AJAX</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container box">
   <div class="panel panel-default">
    <div class="panel-body"  style="background:#c7bebd;">
     <div class="form-group">
        <label>Search</label>
      <input style="background:#f5eae9;"  type="text" name="search" id="search" class="form-control" placeholder="Search name/designation/department" />
     </div>
     <div class="table-responsive">
      <!-- <table class="table table-striped table-bordered">
       <thead>
        <tr>
         <th>Name</th>
         <th>Department</th>
         <th>Designation</th>
        </tr>
       </thead> -->
       <!-- <tbody>

       </tbody>
      </table> -->
      <div >
        <div class="p-2" style="background:white; width:50%;">
        <table class="table table-striped table-bordered">
       <thead>
       </thead> 
       <tbody>
        <tr>
        </tr>
       </tbody>
      </table>
        </div>
      </div>
     </div>
    </div>    
   </div>
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
    

 fetch_employee_data();

 function fetch_employee_data(query = '')
 {
   
  $.ajax({
   url:"{{ url('/live_search/action') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    $('tbody').html(data.table_data);
    $('#total_records').text(data.total_data);
   }
  })
 }

 $(document).on('keyup', '#search', function(){
  var query = $(this).val();
  fetch_employee_data(query);
 });
});
</script>