 <div class="container mt-5 ">
     <div class="col-md-12">
         <div class="card mt-5">
             <div class="card-header">
                 <h1 class="text-center">Sales Report</h1>
             </div>
             <form action="../Admin_head/index.php?page=sales_report" method="post">
                 <div class="form-group row m-2">
                     <label for="start_date" class="col-sm-2 col-form-label">Start Date:</label>
                     <div class="col-sm-10">
                         <input type="date" class="form-control " id="start_date" name="start_date" required>
                     </div>
                 </div>
                 <div class="form-group row m-2">
                     <label for="end_date" class="col-sm-2 col-form-label ">End Date:</label>
                     <div class="col-sm-10">
                         <input type="date" class="form-control " id="end_date" name="end_date" required>
                     </div>
                 </div>
                 <div class="form-group row">
                     <div class="col-sm-10 offset-sm-2">
                         <button type="submit" class="btn btn-primary">Generate Report</button>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </div>