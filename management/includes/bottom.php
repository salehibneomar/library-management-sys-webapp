    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="plugins/jquery/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="plugins/raphael/raphael.min.js"></script>
    <script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <script>
      $('.select2bs4').select2({
          //theme: 'bootstrap4'
      });

      $('.select2CustomInput').select2({
          //theme: 'bootstrap4',
          tags: true
      });
    </script>
      <!-- bootstrap tags input -->
  <script src="plugins/bstagsinput/bootstrap-tagsinput.js"></script>
  <script>
      $('.bs4-tags-input').tagsinput({
        trimValue: true,
        confirmKeys: [44],
        allowDuplicates: false
      });

      $('.bootstrap-tagsinput > input:first').focus(function(){
        $('.bootstrap-tagsinput').addClass('form-control-focus-class');
      });

      $('.bootstrap-tagsinput > input:first').focusout(function(){
          $('.bootstrap-tagsinput').removeClass('form-control-focus-class');
      });
  </script>
      <!--Data Tables -->
    <script src="plugins/datatables_latest/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables_latest/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/sweetalert2/sweetalert2.all.min.js" ></script>
    <!-- Krajee -->
    <script src="plugins/krajee-bs-file-input/js/plugins/piexif.js" ></script>
    <script src="plugins/krajee-bs-file-input/js/plugins/sortable.js" ></script>
    <script src="plugins/krajee-bs-file-input/js/fileinput.js" ></script>
    <script src="plugins/krajee-bs-file-input/js/locales/fr.js" ></script>
    <script src="plugins/krajee-bs-file-input/js/locales/es.js" ></script>
    <script src="plugins/krajee-bs-file-input/themes/fas/theme.js" ></script>
    <script src="plugins/krajee-bs-file-input/themes/explorer-fas/theme.js" ></script>
    <!-- Optional: include a polyfill for ES6 Promises for IE11 -->


    <script>
        var link = window.location.href
        var getUrlParams = new URL(link);
        page = link.split("/").pop().split('.php')[0];

        var url = (page == 'category')          ? 'getAllBookCategory.php'        :
                  (page == 'management')        ? 'getAllUser.php'                :
                  (page == 'book')              ? 'getAllBook.php'                :
                  (page == 'member')            ? 'getAllMember.php'              :
                  (page == 'book-request')      ? 'getAllBookRequest.php'         : null;
                  
        url = 'server-side-datatables/'+url;

          var DATA_TABLE = $('#dataTable').DataTable({
                
                "processing": true,
                "language": {
                      "processing": "Fetching Data..."
                },
                "serverSide": true,
                "ajax": {
                  "url": url,
                  
                },
                "pageLength": 5,
                "lengthMenu": [5, 10, 15],
                "order":  [ 0, 'desc' ]
            });


    </script>

    <script>
      
        /* ChartJS
        * -------
        * Here we will create a few charts using ChartJS
        */


        //-------------
        //- DONUT CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData        = {
          labels: [
              'Chrome',
              'IE',
              'FireFox',
              'Safari',
              'Opera',
              'Navigator',
          ],
          datasets: [
            {
              data: [700,500,400,600,300,100],
              backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }
          ]
        }
        var donutOptions     = {
          maintainAspectRatio : false,
          responsive : true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        var donutChart = new Chart(donutChartCanvas, {
          type: 'doughnut',
          data: donutData,
          options: donutOptions
        });

        
      
    </script>


<!-- Sweet Alert Session operation -->
    <script>

      <?php 

        if(isset($_SESSION['alert'])){ ?>

          var icon  = '<?=$_SESSION['alert']['type']; ?>';
          var title = '<?=ucfirst($_SESSION['alert']['type']); ?>';
          var text  = '<?=$_SESSION['alert']['msg']; ?>';

            Swal.fire({
              icon:  icon,
              title: title,
              html:  text,
              showConfirmButton: true
            });

      <?php unset($_SESSION['alert']); } ?>

    </script>

<!-- Sweet Alert Confirmation trigger -->
  <script>

        $("#dataTable").on("click", ".swal-delete-trigger", function(e){
        e.preventDefault();

            var link=$(this).attr('href');

            Swal.fire({
                    icon: 'warning',
                    title: 'Are you sure ?',
                    text:  'You won\'t be able to revert this choice!',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete'

            }).then((result) => {
                if (result.value){
                    window.location.href=link;
                }
            });

        });
    </script>
    
    <script>
          $("#image-uploader").fileinput({
            'theme': 'explorer-fas',
            'uploadUrl': '#',
            dropZoneEnabled: false,
            browseOnZoneClick: true,
            showRemove: false,
            showUpload: false,
            showCancel: false,
            showCaption: true,
            showClose: false,
            browseClass: "btn btn-success",
            browseIcon: '<i class="fas fa-image"></i>',
            browseLabel: '&ensp;Click here to choose image',
            focusCaptionOnBrowse: true,
            allowedFileTypes: ["image"],
            allowedFileExtensions: ["jpg", "jpeg", "png"],
            maxFileSize: 2048,
            fileActionSettings: {
                showRemove: true,
                showZoom: false,
                showUpload: false,
                removeClass: 'btn btn-sm btn-danger',
                zoomClass: 'btn btn-sm btn-info' 
            },

        });

    </script>
    <script src="custom-assets/js/script.js"></script>

    <?php 
      $conn->close();
      ob_end_flush(); 
    ?>
</body>
</html>