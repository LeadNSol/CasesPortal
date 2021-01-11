<?php
//echo"<pre>";
//print_r($results);exit;
?>
<!-- /top navigation -->

<!-- page content -->
<div class="right_col change_ps_w_ord" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add Case Images or Files</h2>

                    <div class="clearfix"></div>
                </div>

                <?php
                if (isset($flash_message)) {
                    if ($flash_message == TRUE) {
                        ?>

                        <div class="alert alert-success">
                            <a class="close" data-dismiss="alert">×</a>
                            <strong>Well done!</strong>images were added successfully.
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-danger">
                            <a class="close" data-dismiss="alert">×</a>
                            <strong>Oops!</strong> Please Try Again...
                        </div>
                    <?php }
                } ?>
                <div class="x_content">
                    <br/>
                    <?php
                    $attributes = array('class' => 'form-horizontal form-label-left', 'id' => 'demo-form2');
                    echo form_open_multipart('submit_case_images/', $attributes);
                    ?>


                    <div class="form-group profile_ed_f_rm">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme" for="first-name">Select
                            Case<span class="required"> *</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control col-md-7 col-xs-12" name="case_id" required="required"
                                    id="cases">
                                <option value="">Select Case</option>
                                <?php foreach ($cases as $key => $val) { ?>

                                    <option value="<?php echo $val['id'] ?>"><?php echo $val['case_name'] ?></option>
                                <?php } ?>
                            </select>
                            <span class="error_cl" id="category_id"></span>
                        </div>
                    </div>
                    <div class="form-group profile_ed_f_rm">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme" for="case-image">Select
                            Image <span class="required"> *</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="file" name="case_images[]" multiple required="required"
                                   class="form-control col-md-7 col-xs-12" value=""/>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group profile_ed_f_rm">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3 save_pr_v">
                            <input type="submit" class="btn btn-success sve_bot" value="Submit">
                        </div>
                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /page content -->