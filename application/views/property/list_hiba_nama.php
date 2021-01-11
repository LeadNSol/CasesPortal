<div class="right_col" role="main">

    <div role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_panel">
                    <div class="x_title">
                        <h2>Details<small>of Hiba Nama </small></h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <table id="datatable-buttons" class="table table-striped table-bordered c_clg">
                            <thead>
                            <tr>
                                <th class="c_clg">s.no</th>
                                <th class="c_clg">From (Relation)</th>
                                <th class="c_clg">Hiba nama Date</th>
                                <th class="c_clg">Remarks</th>
                                <th style="width:120px;text-align: center;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($hibaNamaList as $key => $value) {

                                ?>
                                <td><?php echo $value['h_id']; ?></td>
                                <td><?php echo $value['relation']; ?></td>
                                <td><?php echo $value['hiba_nama_date']; ?></td>
                                <td><?php echo $value['remarks']; ?></td>
                                <td>
                                    <div class="Action">
                                        <a href="<?php echo base_url(); ?>edit_hiba_nama/<?php echo $value['h_id']; ?>" title="Edit"><span
                                                    style="margin-right: 13px;"><i class="fa fa-pencil"
                                                                                   aria-hidden="true"></i></span></a>
                                        <a href="<?php echo base_url(); ?>edit_exam_subject/<?php echo $value['h_id']; ?>" title="Details"><span
                                                    style="margin-right: 13px;"><i class="fa fa-desktop"
                                                                                   aria-hidden="true"></i></span></a>
                                        <a href="<?php echo base_url(); ?>delete_hiba_nama/<?php echo $value['h_id'] ?>" title="Delete"
                                           onClick=" return confirm('Are You Sure to Delete this Case?')"><i
                                                    class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </div>
                                </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>