<?php

function FormButton() {
    $html = '<div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="form-group m-0 pull-right">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                               ' . lang('Save') . '
                            </button>
                            <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                ' . lang('Reset') . '
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    return $html;
}

function FormStatus($status) {
    $active = $inactive = '';
    if ($status == 'I') {
        $inactive = 'checked';
    } else {
        $active = 'checked';
    }
    $html = '<div class="form-group row">
                        <label class="col-md-3 my-1 control-label">' . lang('Status') . '</label>
                        <div class="col-md-9">
                            <div class="form-check-inline my-1">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="active" value="A" name="status" class="custom-control-input" ' . $active . '>
                                    <label class="custom-control-label" for="active">' . lang('Active') . '</label>
                                </div>
                            </div>
                            <div class="form-check-inline my-1">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="inactive" name="status" value="I" class="custom-control-input" ' . $inactive . '>
                                    <label class="custom-control-label" for="inactive">' . lang('Inactive') . '</label>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <!--end row-->';
    return $html;
}

function post_array($param = array()) {
    $CI = & get_instance();
    $post = array();
    if (isset($param) && count($param) > 0) {
        foreach ($param as $key => $value) {
            $post[$value] = $CI->input->post($value);
        }
    }
    return $post;
}

function print_status($val) {
    if ($val == 'A') {
        return '<span class="alert alert-success">Active</span>';
    } elseif ($val == 'I') {
        return '<span class="alert alert-danger">Inactive</span>';
    }
}

function action_button($status = '', $edit = '', $delete = 0) {
    if (!empty($status)) {
        $html = '<a href="' . $status . '" class="btn btn-success btn-round m-b-10 m-l-10 waves-effect waves-light">
                <i class="fa fa-eye"></i>
              </a>';
    }
    if (!empty($edit)) {
        $html .= '<a href="' . $edit . '" class="btn btn-skype btn-round m-b-10 m-l-10 waves-effect waves-light">
                <i class="fa fa-edit"></i>
              </a>';
    }
    if (!empty($delete)) {
        $html .= '<a onclick="delete_record(this);" data-token="' . $delete . '" class="btn btn-danger btn-round m-b-10 m-l-10 waves-effect waves-light text-white">
                <i class="fa fa-trash"></i>
              </a>';
    }
    return $html;
}
