<div class="content-w">
 <?php include 'fancy.php';?>
 <div class="header-spacer"></div>
	<div class="content-i">
		<div class="content-box">
			<div class="conty">
				<div class="ui-block">
					<div class="ui-block-content">
      					<div class="steps-w">
        					<div class="step-triggers">
          						<a class="step-trigger active" href="#stepContent1"><?php echo get_phrase('download_student_sheet');?></a>
        				    </div>
        					<div class="step-contents">
          					    <div class="step-content active" id="stepContent1">
									<div class="row">									
    				 				    <center><img src="<?php echo base_url();?>uploads/student.png" style="width:30%"></center>
									</div>
                				    <div class="form-buttons-w text-center">
                  						<a class="btn btn-rounded btn-primary btn-lg" href="<?php echo base_url();?>admin/generate/<?php echo $student_id;?>/<?php echo $pw;?>"><?php echo get_phrase('download');?></a>
                  					    <a class="btn btn-rounded btn-success btn-lg" href="<?php echo base_url();?>admin/new_student/"><?php echo get_phrase('new_student');?></a>
            					    </div>			
          					    </div>
        		            </div>
        		        </div>
		            </div>
	            </div>
	        </div>
	    </div>
	</div>
</div>