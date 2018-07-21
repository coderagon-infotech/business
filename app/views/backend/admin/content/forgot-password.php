<div class="col-md-4 col-10 box-shadow-2 p-0">
    <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
        <div class="card-header border-0">
            <div class="card-title text-center">
                <img src="<?php echo config_item('backend_images_url'); ?>logo/logo-dark.png" alt="<?php echo lang('Logo_Image'); ?>">
            </div>
        </div>
        <div class="card-content">
            <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
                <span><?php echo lang('Forgot_send_link'); ?></span>
            </p>
            <div class="card-body">
                <?php echo form_open(backend('forgot-action', 1), array('name' => 'ForgotForm', 'id' => 'ForgotForm', 'class' => 'ForgotForm')); ?>
                <fieldset class="form-group position-relative has-icon-left">
                    <input type="email" class="form-control" name="email" id="email" placeholder="<?php echo lang('Email'); ?>" required>
                    <div class="form-control-position">
                        <i class="ft-user"></i>
                    </div>
                </fieldset>
                <?php echo form_error('email'); ?>
                <button type="submit" class="btn btn-outline-info btn-block"><i class="ft-unlock"></i> <?php echo lang('Reset_Password'); ?></button>
                <?php echo form_close(); ?>
            </div>
        </div>
        <div class="card-footer border-0">
            <p class="float-sm-right text-center"><?php echo lang('New_Modern'); ?> ? <a href="<?php echo site_url('backend'); ?>" class="card-link"><?php echo lang('Login'); ?></a></p>
        </div>
    </div>
</div>