<!-- Slick slider -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/slick.css">
<!-- Fancybox slider -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.fancybox.css" type="text/css" media="screen"/>
<!-- Theme color -->
<link id="switcher" href="<?php echo base_url(); ?>assets/css/theme-color/default-theme.css" rel="stylesheet">

<!-- Main style sheet -->
<link href="assets/css/style.css" rel="stylesheet">

<?php

$imagesArray = array();
if (!empty($caseImages)) {
    foreach ($caseImages as $key => $value) {
        $images = json_decode($value['images'], true);
        foreach ($images as $k => $v) {
            $imagesArray[] = $v;
        }
    }
}


?>

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>View Case Details</h2>

                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
                <div class="x_content">
                    <div class="col-sm-12">
                        <div class="col-sm-8">
                            <h3 class="text-center">Case Name: <?php if (!empty($caseArr)) {
                                    echo $caseArr[0]['case_name'];
                                } ?></h3>
                        </div>

                        <div class="col-sm-4"><h2 class="text-right ">Total
                                Hearing: <?php if (!empty($hearingDetails)) {
                                    echo count($hearingDetails);
                                } ?></h2>
                        </div>

                    </div>
                    <br><br>

                    <h4>Case Information</h4>
                    <div class="ln_solid"></div>
                    <div class="x_content">
                        <table class="table table-striped table-bordered c_clg">
                            <thead>
                            <tr>
                                <th class="c_clg">Case Name</th>
                                <th class="c_clg">Case District</th>
                                <th class="c_clg">Region</th>
                                <th class="c_clg">Case Type</th>
                                <th class="c_clg">Against</th>
                                <th class="c_clg">Lawyer</th>
                                <th class="c_clg">Starting Date</th>
                                <th class="c_clg">Duration</th>
                                <th class="c_clg">Status</th>
                                <th class="c_clg">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (!empty($caseArr)) {
                                foreach ($caseArr as $key => $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo $value['case_name']; ?></td>
                                        <td><?php echo $value['case_district']; ?></td>
                                        <td><?php echo $value['region']; ?></td>
                                        <td><?php echo $value['case_type']; ?></td>
                                        <td><?php echo $value['against']; ?></td>
                                        <td><?php echo $value['lawyer_name']; ?></td>
                                        <td><?php echo $value['starting_date']; ?></td>
                                        <td><?php echo $value['duration']; ?></td>
                                        <td><?php echo $value['status']; ?></td>
                                        <td>
                                            <div class="Action">
                                                <a href="<?php echo base_url(); ?>view_case_details/<?php echo $value['id']; ?>"
                                                   title="Edit"><span style="margin-right: 13px;"><i class="fa fa-edit"
                                                                                                     aria-hidden="true"></i></span></a>
                                                <a href="<?php echo base_url(); ?>delete_case/<?php echo $value['id'] ?>"
                                                   title="delete"
                                                   onClick=" return confirm('Are You Sure to Delete this Case?')"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                    <h4>Case Hearing Information</h4>
                    <div class="ln_solid"></div>
                    <div class="x_content">
                        <a href="<?php echo base_url(); ?>add_case_hearing" class="btn btn-success"
                           style="float: right;">Add
                            Case Hearing <i
                                    class="fa fa-address-card-o" aria-hidden="true"></i></a>

                        <table id="datatable-buttons" class="table table-striped table-bordered c_clg">
                            <thead>
                            <tr>
                                <th class="c_clg">s.no</th>
                                <th class="c_clg">Hearing Date</th>
                                <th class="c_clg">Remarks</th>
                                <th class="c_clg">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($hearingDetails as $key => $value) {

                                ?>
                                <tr>
                                    <td><?php echo $value['h_id']; ?></td>
                                    <td><?php echo $value['hearing_date']; ?></td>
                                    <td><?php echo $value['remarks']; ?></td>
                                    <td>
                                        <div class="Action">
                                            <a href="<?php echo base_url(); ?>view_case_details/<?php echo $value['h_id']; ?>"
                                               title="Edit"><span style="margin-right: 13px;"><i
                                                            class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a>
                                            <a href="<?php echo base_url(); ?>delete_case/<?php echo $value['h_id'] ?>"
                                               title="delete"
                                               onClick=" return confirm('Are You Sure to Delete this Case?')"><i
                                                        class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php

                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <h4>Case Gallery</h4>
                    <div class="ln_solid"></div>
                    <a href="<?php echo base_url(); ?>load_case_images_view" class="btn btn-primary"
                       style="float: right;">Attach more Files <i
                                class="fa fa-paperclip" aria-hidden="true"></i></a>

                    <div id="mixit-container" class="mu-gallery-body row x_content">
                        <?php
                        if (count($imagesArray) > 0) {
                            foreach ($imagesArray as $value) {

                                ?>
                                <div class="col-sm-4 col-md-3 col-xs-12 mix">

                                    <div class="mu-single-gallery">
                                        <div class="mu-single-gallery-item">
                                            <div class="mu-single-gallery-img">
                                                <img alt="<?php echo $value; ?>" width="200px" height="150px"
                                                     src='<?php echo base_url(); ?>uploads/images/<?php echo $value; ?>'/>
                                            </div>
                                            <br/>
                                            <div class="mu-single-gallery-info">
                                                <div class="mu-single-gallery-info-inner">
                                                    <a href="<?php echo base_url(); ?>uploads/images/<?php echo $value; ?>"
                                                       data-fancybox-group="gallery" class="fancybox btn btn-dark"><span
                                                                class="fa fa-eye"></span></a>
                                                    <a href="#" class="aa-link btn btn-danger"><span
                                                                class="fa fa-trash-o"></span></a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                </div>

                                <?php
                            }
                        } else { ?>
                            <div class="x_title text-center"><h5>No Image files were found!</h5></div>

                            <?php
                        } ?>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>
<!-- jQuery library -->
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>

<!-- Slick slider -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/slick.js"></script>
<!-- Counter -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/waypoints.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.counterup.js"></script>
<!-- Mixit slider -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.mixitup.js"></script>
<!-- Add fancyBox -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.fancybox.pack.js"></script>

<!-- Custom js -->
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

