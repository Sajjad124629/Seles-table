<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Breeze Admin</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css" />
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css" />
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
   


            <table class="table table-striped">
              <thead>
                <tr>
                  <th>S.N</th>
                  <th>Email</th>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>company</th>
                  <th>created_at</th>
                  <th>country</th>
                </tr>
              </thead>
              <tbody id="tablebody">
                  @foreach ($getdata as $getdatas)
                <tr>
                  <td>{{$loop->index+1}}</td>
                  <td>{{$getdatas->email}}</td>
                  <td>{{$getdatas->first}}</td>
                  <td>{{$getdatas->last}}</td>
                  <td>{{$getdatas->company}}</td>
                  <td>{{$getdatas->created_at}}</td>
                  <td>{{$getdatas->country}}</td>


                </tr>

                @endforeach

              </tbody>
            </table>






          </div>

          <style>
              .w-5{
                display:none;
            }
            </style>

        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="assets/vendors/flot/jquery.flot.js"></script>
    <script src="assets/vendors/flot/jquery.flot.resize.js"></script>
    <script src="assets/vendors/flot/jquery.flot.categories.js"></script>
    <script src="assets/vendors/flot/jquery.flot.fillbetween.js"></script>
    <script src="assets/vendors/flot/jquery.flot.stack.js"></script>
    <script src="assets/vendors/flot/jquery.flot.pie.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->

    <script>
        $(document).ready(function () {

            $('#input_search').keyup(function () {
                var get_search_data = $(this).val().toLowerCase();
                $('#tablebody tr').filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(get_search_data)>-1)
                 });
            });

         })
    </script>

  </body>
</html>
