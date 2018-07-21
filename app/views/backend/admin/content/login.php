<div class="col-md-4 col-10 box-shadow-2 p-0">
    <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
        <div class="card-header border-0">
            <div class="card-title text-center">
                <img src="<?php echo config_item('backend_images_url'); ?>logo/logo-dark.png" alt="<?php echo lang('Logo_Image'); ?>">
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
                <?php echo form_open(backend('login-action', 1), array('name' => 'LoginForm', 'id' => 'LoginForm', 'class' => 'LoginForm')); ?>
                <fieldset class="form-group position-relative has-icon-left">
                    <input type="email" class="form-control" name="email" id="email" placeholder="<?php echo lang('Email'); ?>" required>
                    <div class="form-control-position">
                        <i class="ft-user"></i>
                    </div>
                </fieldset>
                <?php echo form_error('email'); ?>
                <fieldset class="form-group position-relative has-icon-left">
                    <input type="password" class="form-control" name="password" id="user-password" placeholder="<?php echo lang('Password'); ?>" required>
                    <div class="form-control-position">
                        <i class="la la-key"></i>
                    </div>
                </fieldset>
                <?php echo form_error('password'); ?>
                <div class="form-group row">
                    <div class="col-md-12 col-12 float-sm-left text-center text-sm-right"><a href="<?php echo backend('forgot-password'); ?>" class="card-link"><?php echo lang('Forgot_Password'); ?>?</a></div>
                </div>
                <button type="submit" class="btn btn-outline-info btn-block"><i class="ft-unlock"></i> <?php echo lang('Login'); ?></button>
                <?php echo form_close(); ?>
            </div>
            <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
                <span><?php echo lang('OR_Account'); ?></span>
            </p>
            <div class="text-center">
                <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-google">
                    <span class="la la-google"></span>
                </a>
                <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-facebook">
                    <span class="la la-facebook"></span>
                </a>
            </div>
        </div>
    </div>
</div>