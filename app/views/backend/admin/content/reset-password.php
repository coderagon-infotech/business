<div class="col-md-4 col-10 box-shadow-2 p-0">
    <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
        <div class="card-header border-0">
            <div class="card-title text-center">
                <img src="<?php echo config_item('backend_images_url'); ?>logo/logo-dark.png" alt="<?php echo lang('Logo_Image'); ?>">
            </div>
        </div>
        <div class="card-content">
            <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
                <span><?php echo lang('Set_new_password'); ?></span>
            </p>
            <div class="card-body">
                <?php echo form_open(backend('reset-action', 1), array('name' => 'ResetForm', 'id' => 'ResetForm', 'class' => 'ResetForm')); ?>
                <input type="hidden" name="id" value="<?php echo encryptData($id); ?>"/>
                <fieldset class="form-group position-relative has-icon-left">
                    <input type="password" class="form-control" name="password" id="password" placeholder="<?php echo lang('Password'); ?>" required value="">
                    <div class="form-control-position">
                        <i class="la la-key"></i>
                    </div>
                </fieldset>
                <?php echo form_error('password'); ?>
                <fieldset class="form-group position-relative has-icon-left">
                    <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="<?php echo lang('Confirm_Password'); ?>" required value="">
                    <div class="form-control-position">
                        <i class="la la-key"></i>
                    </div>
                </fieldset>
                <?php echo form_error('cpassword'); ?>
                <button type="submit" class="btn btn-outline-info btn-block"><i class="ft-unlock"></i> <?php echo lang('Save'); ?></button>
                <?php echo form_close(); ?>
            </div>
        </div>
        <div class="card-footer border-0">
            <p class="float-sm-right text-center"><?php echo lang('New_Modern'); ?> ? <a href="<?php echo site_url('backend'); ?>" class="card-link"><?php echo lang('Login'); ?></a></p>
        </div>
    </div>
</div>