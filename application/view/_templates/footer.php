
                    </div>
                <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

     
  <!-- /.control-sidebar -->
</div>
    <!-- define the project's URL (to make AJAX calls possible, even when using this in sub-folders etc) -->
    <script>
        var url = "<?php echo URL; ?>";
    </script>

    <!-- our JavaScript -->
    <script src="<?php echo URL ?>js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo URL ?>js/bootstrap.min.js"></script>
    <script src="<?php echo URL ?>js/alertify.min.js"></script>
    <script src="<?php echo URL ?>js/font Js/all.js"></script>

    <!-- DATATABLES -->
    <script src="<?= URL ?>js/jquery.dataTables.min.js"></script>
    <script src="<?= URL ?>js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= URL ?>js/dataTables.responsive.min.js"></script>
    <script src="<?= URL ?>js/responsive.bootstrap4.min.js"></script>

    <!-- SELECT2 -->
    <script src="<?= URL ?>js/select2.full.min.js"></script>
    

    <?php
        if(isset($script)){
            for($i=0;$i<count($script);$i++){
                echo '<script src="'.URL.$script[$i].'"></script>';
            }
        }
    ?>
    
</body>
</html>
