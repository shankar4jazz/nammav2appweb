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
    </footer><?php /**PATH C:\wamp64\www\nammav2appweb-3\resources\views/partials/_body_footer.blade.php ENDPATH**/ ?>