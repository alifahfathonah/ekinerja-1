                <footer class="footer-content">
                    <span >
                        <span id="copyright-year"></span> &copy; 1818. Created by <a href="javascript:void(0);">Agussismery Wagi Irawanto</a>, Maros
                    </span>
                    <span class="pull-right">Page rendered in <strong>{elapsed_time}</strong> seconds.</span>
                </footer>

            </section>
            <!--/ END PAGE CONTENT -->

        </section><!-- /#wrapper -->
        <!--/ END WRAPPER -->

        <!-- START @BACK TOP -->
        <div id="back-top" class="animated pulse circle">
            <i class="fa fa-angle-up"></i>
        </div><!-- /#back-top -->
        <!--/ END BACK TOP -->

        <div class="modal fade animated zoomInUp" id="modal_data" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" id="sizeModal">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="titleModal"></h4>
                    </div>
                    <div class="modal-body no-padding">
                        <iframe name="prosesModal" id="prosesModal" style="display:none;"></iframe>
                        <div id="submitModal"></div>
                        <div id="contentModal"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal modal-danger fade animated rotateInDownRight" id="modal_profil" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" id="classProfil">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Profil Pegawai</h4>
                    </div>
                    <div class="modal-body no-padding" id="contentModalProfil"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <script type="text/javascript">
            var url1818 = "<?php echo base_url();?>";
        </script>

        <!-- START JAVASCRIPT SECTION (Load javascripts at bottom to reduce load time) -->
        <!-- START @CORE PLUGINS -->
        <script src="<?=base_url();?>themes/default/assets/global/plugins/bower_components/jquery.inputmask/dist/jquery.inputmask.min.js"></script>
        <script src="<?=base_url();?>themes/default/assets/global/plugins/bower_components/jquery-cookie/jquery.cookie.js"></script>
        <script src="<?=base_url();?>themes/default/assets/global/plugins/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?=base_url();?>themes/default/assets/global/plugins/bower_components/typehead.js/dist/handlebars.js"></script>
        <script src="<?=base_url();?>themes/default/assets/global/plugins/bower_components/typehead.js/dist/typeahead.bundle.min.js"></script>
        <script src="<?=base_url();?>themes/default/assets/global/plugins/bower_components/jquery-nicescroll/jquery.nicescroll.min.js"></script>
        <script src="<?=base_url();?>themes/default/assets/global/plugins/bower_components/jquery.sparkline.min/index.js"></script>
        <script src="<?=base_url();?>themes/default/assets/global/plugins/bower_components/jquery-easing-original/jquery.easing.1.3.min.js"></script>
        <script src="<?=base_url();?>themes/default/assets/global/plugins/bower_components/ionsound/js/ion.sound.min.js"></script>
        <script src="<?=base_url();?>themes/default/assets/global/plugins/bower_components/bootbox/bootbox.js"></script>
        <!--/ END CORE PLUGINS -->

        <!-- START @PAGE LEVEL PLUGINS -->
        <?php
            if(isset($list_js_plugin)){
                foreach ($list_js_plugin as $js_plugin) {
                ?>
                    <script src="<?=base_url();?>themes/default/assets/global/plugins/bower_components/<?=$js_plugin;?>"></script>
                <?php
                }
            }
        ?>
        <!--/ END PAGE LEVEL PLUGINS -->

        <!-- START @PAGE LEVEL SCRIPTS -->

        <script src="<?=base_url();?>themes/default/assets/showLoading/js/jquery.showLoading.js"></script>
        
        <?php
            if(isset($list_js_page)){
                foreach ($list_js_page as $js_page) {
                ?>
                    <script src="<?=base_url();?>themes/default/assets/admin/js/pages/<?=$js_page;?>"></script>
                <?php
                }
            }
        ?>
        <script src="<?=base_url();?>themes/default/assets/admin/js/apps.js"></script>
        <script src="<?=base_url();?>themes/default/assets/admin/js/dhivar1818.js"></script>
        <script src="<?=base_url();?>themes/default/assets/admin/js/dhivar1818_validat.js"></script>
        <script src="<?=base_url();?>themes/default/assets/admin/js/demo.js"></script>

        
        <!--/ END PAGE LEVEL SCRIPTS -->
        <!--/ END JAVASCRIPT SECTION -->

        <script>
            $(document).ready(function(){
                /* DEFAULT ACTIVE MENU
                $("#djmainmenu<?=$main_menu_active;?>").addClass("active");
                $("#djmenu<?=$menu_active;?>").addClass("active");
                */
                var url_active = window.location;
                $('ul.sidebar-menu a').filter(function () {
                   return this.href == url_active;
                }).parents('li').addClass('active');
            });
        </script>
        <!--/ END GOOGLE ANALYTICS -->

    </body>
    <!--/ END BODY -->

</html>