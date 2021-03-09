        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

     <!-- jQuery -->
    <!-- Componentes -->
    <script src="<?= HTTP_ADMIN ?>assets/js/componentes.min.js"></script>
    <?php
    if($_SERVER['SCRIPT_FILENAME'] == PATH_ADMIN . "home.php"){
    ?>
    <script src="<?= HTTP_ADMIN ?>assets/js/temp-morris-data.js"></script>
    <script src="<?= HTTP_ADMIN ?>assets/js/temp-flot-data.js"></script>
    <? } ?>
</body>

</html>