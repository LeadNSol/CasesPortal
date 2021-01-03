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
                    <h2>Add New Case</h2>

                    <div class="clearfix"></div>
                </div>

                <?php
                if (isset($flash_message)) {
                    if ($flash_message == TRUE) {
                        ?>

                        <div class="alert alert-success">
                            <a class="close" data-dismiss="alert">×</a>
                            <strong>Well done!</strong>case is added successfully.
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
                    echo form_open_multipart('submit_case_details', $attributes);
                    ?>

                    <div class="form-group profile_ed_f_rm">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme" for="case-name">Case
                            name<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="facebook_link" name="case_name" placeholder="case name"
                                   required="required" class="form-control col-md-7 col-xs-12" value="">
                        </div>
                    </div>

                    <div class="form-group profile_ed_f_rm">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme" for="case-type">Case
                            Type<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="case_type" name="case_type" placeholder="court / office or both"
                                   required="required" class="form-control col-md-7 col-xs-12" value="">
                        </div>
                    </div>

                    <div class="form-group profile_ed_f_rm">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme" for="cases-against">Case
                            Against<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control col-md-7 col-xs-12" name="case_against" required="required"
                                    id="case_type">
                                <option value="">Select Filer</option>
                                <option value="Us">Us</option>
                                <option value="Them">Them</option>
                            </select>

                        </div>
                    </div>
                    <div class="form-group profile_ed_f_rm">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme" for="lawyer-name">Lawyer
                            Name<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="facebook_link" name="lawyer_name" placeholder="Lawyer name"
                                   required="required" class="form-control col-md-7 col-xs-12" value="">
                        </div>
                    </div>
                    <div class="form-group profile_ed_f_rm">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme" for="first-name">Lawyer
                            Contact No<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="facebook_link" name="phone" placeholder="lawyer contact no"
                                   required="required" class="form-control col-md-7 col-xs-12" value="">
                        </div>
                    </div>


                    <!--          province-->


                    <script>
                        function random()
                        {
                            var a=document.getElementById('input').value;
                            if(a=="Lower Dir")
                            {
                                var array=["Select a Value","Timergara","Balambat","Lal Qala","Samarbagh"];
                            }
                            else if(a=="Upper Dir")
                            {
                                var array=["Select a Value","Wari","Barawal","Sheringal"];
                            }
                            // else if(b=="Sindh")
                            // {
                            //     var array=["Select a Value","karachi","Multan","quata"];
                            // }
                            else
                            {
                                var array=[];
                            }
                            var string="";
                            for(i=0;i<array.length;i++)
                            {
                                string=string+"<option>"+array[i]+"</option>";
                            }

                            string="<select name='cases-tehsil' class='form-control'>"+string+"</select>";
                            document.getElementById('output').innerHTML=string;
                        }


                    </script>

                    <div class="form-group profile_ed_f_rm">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme" for="cases-district">
                            Case District<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control col-md-7 col-xs-12" name="case_district" required="required"
                                    id="input" onchange="random()">
                                <option value="select_actor">Select District</option>
                                <option>Lower Dir</option>
                                <option>Upper Dir</option>
<!--                                <option value="Swat">Swat</option>-->
<!--                                <option value="Peshawar">Peshawar</option>-->
<!--                                <option value="Mardan">Mardan</option>-->
                            </select>

                        </div>
                    </div>


<!--                    tehil-->
                    <div class="form-group profile_ed_f_rm">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme" for="cases-district">
                            Case Tehsil<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div id="output">
                            <select class="form-control col-md-7 col-xs-12" name="cases-tehsil" required="required"
                                    id="output">
                                <option value="select_actor">Select Tehsil</option>

                            </select>
                            </div>

                        </div>
                    </div>


                    <div class="form-group profile_ed_f_rm">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme"
                               for="first-name">Area / Region<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="case_region" name="region"
                                   placeholder="Area or region or tehsil e.g. Timergara"
                                   required="required"
                                   class="form-control col-md-7 col-xs-12" value="">
                        </div>
                    </div>
                    <div class="form-group profile_ed_f_rm">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme" for="cases-status">
                            Case Current Status<span class="required">*</span>
                        </label>


                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control col-md-7 col-xs-12" name="case_status" required="required"
                                    id="case_status">
                                <option value="">Select Sataus</option>
                                <option value="Active">Active</option>
                                <option value="Closed">Closed / Completed</option>
                                <option value="Pending">Pending</option>
                            </select>

                        </div>
                    </div>


                    <div class="form-group profile_ed_f_rm">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme" for="first-name">Starting
                            Date<span class="required"> *</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="starting_date" name="starting_date"
                                   placeholder="choose starting date" class="form-control col-md-7 col-xs-12" value="">
                        </div>
                    </div>
                    <div class="form-group profile_ed_f_rm" id="ending_date_div">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme"
                               for="starting-date">Ending Date<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="date" id="ending_date_input" name="ending_date" placeholder="choose Ending date"
                                   class="form-control col-md-7 col-xs-12" value="">
                        </div>
                    </div>
                    <div class="form-group profile_ed_f_rm" id="hearing_div">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme"
                               for="starting-date">Total Hearing<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="hearing_input" name="total_hearing"
                                   placeholder="number of appearance in court"
                                   class="form-control col-md-7 col-xs-12" value="">
                        </div>
                    </div>

                    <div class="form-group profile_ed_f_rm" id="remarks">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme"
                               for="starting-date">Remarks</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea id="remarks" name="remarks" placeholder="case remark or details description"
                                      class="form-control col-md-7 col-xs-12"></textarea>
                        </div>
                    </div>

                    <!-- <div class="form-group profile_ed_f_rm">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme" for="first-name">Mac
                             Id<span class="required">*</span>
                         </label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" id="facebook_link" name="mac_id" required="required"
                                    class="form-control col-md-7 col-xs-12" value="">
                         </div>
                     </div>-->
                    <!--<div class="form-group profile_ed_f_rm">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme" for="first-name">user Image <span class="required">*</span>
                     </label>
                     <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="file" id="facebook_link" name="site_image" class="form-control col-md-7 col-xs-12" height="200" width="200" value="">
                     </div>
                    </div>-->
                    <div class="ln_solid"></div>
                    <div class="form-group profile_ed_f_rm">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3 save_pr_v">
                            <input type="submit" class="btn btn-success sve_bot" value="save">
                        </div>
                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /page content -->

<!-- footer content -->

<style>
    .change_ps_w_ord {
        min-height: 611px !important;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
<script>
    $("#starting_date").flatpickr({
        altInput: false,
        altFormat: "F j, Y",
        dateFormat: "d-M-Y",
    });
    $("#ending_date_input").flatpickr({
        altInput: false,
        altFormat: "F j, Y",
        dateFormat: "d-M-Y",
    });

</script>
<script>

    $(document).ready(function () {
//alert("trttr");

        $('#ending_date_div').hide();
        $('#remarks').hide();
        $('#hearing_div').hide();
        $("#case_status").change(function () {
            var status = $(this).val();
            if (status === "Closed") {
                $('#ending_date_div').show();
                $('#remarks').show();
                $('#hearing_div').show();
            } else {
                $('#ending_date_div').hide();
                $('#remarks').hide();
                $('#hearing_div').hide();
            }

        })
    });
</script>