<div class="right_col" role="main">
<div role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="x_panel">
                <div class="x_title">
                    <h2>Cases List</h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table id="datatable-buttons" class="table table-striped table-bordered c_clg">
                        <thead>
                        <tr>
                            <th class="c_clg">Relation</th>
                            <th class="c_clg">hiba_nama_date</th>
                            <th class="c_clg">Remarks</th>
<!--                            <th class="c_clg">Against</th>-->
<!--                            <th class="c_clg">Lawyer</th>-->
<!--                            <th class="c_clg">Starting Date</th>-->
<!--                            <th class="c_clg">Duration</th>-->
                            <th style="width:120px;text-align: center;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($hibaNamas as $key=>$value)
                        {

                            ?>
                            <td><?php echo $value['relation']; ?></td>
                            <td><?php echo $value['hiba_nama_date']; ?></td>
                            <td><?php echo $value['remarks']; ?></td>
<!--                            <td>--><?php //echo $value['against']; ?><!--</td>-->
<!--                            <td>--><?php //echo $value['lawyer_name']; ?><!--</td>-->
<!--                            <td>--><?php //echo $value['starting_date']; ?><!--</td>-->
<!--                            <td>--><?php //echo $value['duration']; ?><!--</td>-->
                            <td>
                                <div class="Action">
                                    <a href="<?php echo base_url();?>edit_exam_subject/<?php echo $value['id']; ?>"><span style="margin-right: 13px;"><i class="fa fa-pencil" aria-hidden="true"></i></span></a>
                                    <a href="<?php echo base_url();?>edit_exam_subject/<?php echo $value['id']; ?>"><span style="margin-right: 13px;"><i class="fa fa-desktop" aria-hidden="true"></i></span></a>
                                    <a href="<?php echo base_url();?>delete_exam_subject/<?php echo $value['id']?>"  onClick=" return confirm('Are You Sure to Delete this Case?')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                </div>
                            </td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
