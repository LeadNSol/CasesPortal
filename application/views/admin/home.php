<?php
  $this->load->model('User');
   $all_active_cases=$this->User->getAllActiveCases();
   $all_completed_cases=$this->User->getAllCompletedCases();
   $all_pending_cases = $this->User->getAllPendingCases();


?>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>



        <!-- top navigation -->

        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row">

            <div class="vistr_d">
                <div class="col-sm-4">
					<div class="all_user_d clr_1">
					     <h2>Active Cases</h2>
						   <span><?php echo $all_active_cases;?></span>
					 </div>
                 </div>

				    <div class="col-sm-4">
					<div class="all_user_d clr_2">
					     <h2>Completed Cases</h2>
						   <span><?php echo $all_completed_cases;?></span>
					 </div>
                 </div>

				    <div class="col-sm-4">
					<div class="all_user_d clr_3">
					     <h2>Pending Cases</h2>
						   <span><?php echo $all_pending_cases;?></span>
					 </div>
                 </div>

				 <div class="clearfix"></div>
              </div>

          </div>
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
                                    foreach($results as $key=>$value)
                                    {

                                        ?>
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
                                                <a href="<?php echo base_url();?>view_case_details/<?php echo $value['id']; ?>" title="details"><span style="margin-right: 13px;"><i class="fa fa-desktop" aria-hidden="true"></i></span></a>
                                                <a href="<?php echo base_url();?>delete_case/<?php echo $value['id']?>" title="delete"
                                                   onClick=" return confirm('Are You Sure to Delete this Case?')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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

        </div>



            <!-- delete asking dialog Modal -->
        <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md" style="width:450px;">
        <div class="modal-content modl_cntnt">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Are you sure you want to delete this Item? </h4>
            </div>
            <!--<div class="modal-body mb_b">
            </div>-->
            <div class="modal-footer" style="margin-top:0;">
                <input type="hidden" id="de_userid">
                <button type="button" class="btn btn-default ok_board_pop" id="delete_setuser">Yes</button>
                <button type="button" class="btn btn-default ok_board_pop" data-dismiss="modal">No</button>

            </div>

        </div>
    </div>
</div>
        </div>
        <!-- /page content -->
<script type="text/javascript">
   function preventback(){
       window.history.forward();}
       setTimeout("preventback()",0);
       window.onunload= function() { null };
</script>

        <!-- footer content -->
 

 