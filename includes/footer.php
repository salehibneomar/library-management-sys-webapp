<footer class="bg-dark footer-section">

<p class="text-white text-center p-0">&copy; 2020-Inf <br>Designed and Developed by: Saleh Ibne Omar</p> 

</footer>

    <script src="assets/js/jquery-3.5.1.min.js" ></script>
    <script src="assets/js/popper.min.js" ></script>
    <script src="assets/js/bootstrap.min.js" ></script>
    <script src="assets/js/sweetalert2.all.min.js" ></script>
    <!-- Krajee -->
    <script src="assets/plugins/krajee-bs-file-input/js/plugins/piexif.js" ></script>
    <script src="assets/plugins/krajee-bs-file-input/js/plugins/sortable.js" ></script>
    <script src="assets/plugins/krajee-bs-file-input/js/fileinput.js" ></script>
    <script src="assets/plugins/krajee-bs-file-input/js/locales/fr.js" ></script>
    <script src="assets/plugins/krajee-bs-file-input/js/locales/es.js" ></script>
    <script src="assets/plugins/krajee-bs-file-input/themes/fas/theme.js" ></script>
	<script src="assets/plugins/krajee-bs-file-input/themes/explorer-fas/theme.js" ></script>
	
	<script src="assets/js/script.js"></script>
    
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
            showConfirmButton: false,
            timer: 5000
        });

    <?php unset($_SESSION['alert']); } ?>

    </script>

<?php
    $conn->close();
    ob_end_flush();
?>
</body>
</html>