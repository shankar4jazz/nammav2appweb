    <?php
    $app = \App\Models\AppSetting::first();
    ?>
    <footer class="iq-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 ">
                    <span class="mr-1">
                <?php echo e($app->site_copyright); ?>

                    </span>
                </div>
            </div>
        </div>
    </footer><?php /**PATH /var/www/vhosts/jobs7.in/newsapp.jobs7.in/resources/views/partials/_body_footer.blade.php ENDPATH**/ ?>