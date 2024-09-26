<!doctype html>
<html>
    <header>
    </header>
<body>
    <?php $data = $this->db->get_where('student', array('student_id' => $student_id))->result_array();
        foreach($data as $row):
    ?>
    <div style="width:100%; font-size: 16px; line-height: 24px; font-family: 'nunito'; color: #555;">
	    <table cellpadding="0" cellspacing="0" style="width: 100%;line-height: inherit;text-align: left;">
            <tr>
                <td colspan="2">
                    <table  style="width: 100%;line-height: inherit;text-align: left;">
                        <tr>
                            <td style="padding-bottom: 20px; vertical-align: top;">
                                <img src="<?php echo base_url();?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description;?>" alt="EduAppGT" style="width:10%;">
                            </td>
                            <td style="padding-bottom: 20px; vertical-align: top;text-align:center;padding-top:5px;">
                                
                            </td>
                            <td style="text-align: right;" >
                                <p style="font-size: 12px; text-transform:uppercase"><b><?php echo $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;?></b></p>
                                <p style="font-size: 12px;"><?php echo $this->db->get_where('settings', array('type' => 'address'))->row()->description;?></b></p>
                                <p style="font-size: 12px;"><?php echo $this->db->get_where('settings', array('type' => 'phone'))->row()->description;?></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
            </tr>
		</table>
        <table cellpadding="0" cellspacing="0"  style="width: 100%;line-height: inherit;text-align: left;">
            <tr>
                <td style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                    <b style="font-size: 12px;"><?php echo get_phrase('enroll');?></b><br>
                    <?php echo $this->db->get_where('enroll', array('student_id' => $student_id))->row()->roll;?>
                </td>
                <td style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                    <b style="font-size: 12px;"><?php echo get_phrase('first_name');?></b><br>
                    <?php echo $row['first_name'];?>
                </td>
                <td style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                    <b style="font-size: 12px;"><?php echo get_phrase('last_name');?></b><br>
                    <?php echo $row['last_name'];?>
                </td>
                <td style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                    <b style="font-size: 12px;"><?php echo get_phrase('gender');?></b><br>
                    <?php if($row['sex'] == 'M') echo get_phrase('male'); else echo get_phrase('female');?>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                    <b style="font-size: 12px;"><?php echo get_phrase('address');?></b><br>
                    <?php echo $row['address'];?>
                </td>
                <td style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                    <b style="font-size: 12px;"><?php echo get_phrase('phone');?></b><br>
                    <?php echo $row['phone'];?>
                </td>
            </tr>
            <tr>
                <td style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                    <b style="font-size: 12px;"><?php echo get_phrase('date_of_birth');?></b><br>
                    <?php echo $row['birthday'];?>
                </td>
                <td style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                    <b style="font-size: 12px;"><?php echo get_phrase('email');?></b><br>
                    <?php echo $row['email'];?>
                </td>
                <td style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                    <b style="font-size: 12px;"><?php echo get_phrase('username');?></b><br>
                    <?php echo $row['username'];?>
                </td>
                <td style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                    <b style="font-size: 12px;"><?php echo get_phrase('password');?></b><br>
                    <?php echo base64_decode($pw);?>
                </td>
            </tr>
            <?php $class_id   = $this->db->get_where('enroll', array('student_id' => $student_id))->row()->class_id;?>
        <?php $section_id = $this->db->get_where('enroll', array('student_id' => $student_id))->row()->section_id;?>
            <tr>
                <td colspan="2" style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                    <b style="font-size: 12px;"><?php echo get_phrase('parent');?></b><br>
                    <?php echo $this->crud_model->get_name('parent', $row['parent_id']);?>
                </td>
                <td style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                    <b style="font-size: 12px;"><?php echo get_phrase('class');?></b><br>
                    <?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name;?>
                </td>
                <td style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                    <b style="font-size: 12px;"><?php echo get_phrase('section');?></b><br>
                    <?php echo $this->db->get_where('section', array('section_id' => $section_id))->row()->name;?>
                </td>
            </tr>
        </table>
        
        <table cellpadding="0" cellspacing="0" style="margin-top:20px; border-top:1px solid #000; border-left:1px solid #000; border-right:1px solid #000; width: 100%;line-height: inherit;text-align: left;">
            <tr>
                <th style="border: 1px solid #000" colspan="3"><?php echo get_phrase('assigned_subjects');?></th>
            </tr>
            <tr>
                <th style="border: 1px solid #000">#</th>
                <th style="border: 1px solid #000"><?php echo get_phrase('subject');?></th>
                <th style="border: 1px solid #000"><?php echo get_phrase('teacher');?></th>
            </tr>
            <?php 
                $subjects = $this->db->get_where('subject', array('class_id' => $class_id, 'section_id' => $section_id))->result_array();
                foreach($subjects as $sub):
            ?>
                <tr>
                    <td style="padding:5px;font-size: 12px; border: 1px solid #000; text-align:center;">
                        <b style="font-size: 12px;">1.</b>
                    </td>
                    <td style="padding:5px;font-size: 12px; border: 1px solid #000; text-align:center;">
                        <?php echo $sub['name'];?>
                    </td>
                    <td style="padding:5px;font-size: 12px; border: 1px solid #000; text-align:center;">
                        <?php echo $this->crud_model->get_name('teacher',$sub['teacher_id']);?>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
        <small style="margin-top:25px;"><?php echo $this->db->get_where('academic_settings' , array('type' =>'terms'))->row()->description;?></small>
        <br>
        <table cellpadding="0" cellspacing="0"  style="margin-top:45px;margin-bottom:10px width: 100%;line-height: inherit;text-align: center;">
            <tr>
                <td style="padding:5px;font-size: 12px; text-align:center;">
                    <center>____________________________________<br>
                    <?php echo get_phrase('parent');?>
                </td>
                <td colspan="1" style="width:40%;">
                </td>
                <td style="padding:5px;font-size: 12px; text-align:center;">
                    ____________________________________<br><?php echo get_phrase('student');?>
                </td>
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0"  style="width: 100%;line-height: inherit;text-align: left;margin-top:50px">
            <tr>
                <td colspan="2" style="padding-bottom: 40px;border-top:2px solid black;">
                    <table  style="width: 100%;line-height: inherit;text-align: left;vertical-align:top">
                        <tr>
                            <td style="font-size: 12px;">
                                <b><?php echo get_phrase('address');?>:</b><br>
                                <?php echo $this->db->get_where('settings', array('type' => 'address'))->row()->description;?>
                            </td>
                            <td style="font-size: 12px;">
                                <b><?php echo get_phrase('phone');?>:</b><br>
                                <?php echo $this->db->get_where('settings', array('type' => 'phone'))->row()->description;?>
                            </td>
                            <td style="text-align: right;font-size: 12px;">
								<?php echo get_phrase('generated_by');?> <?php echo $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;?><br>
                                <b><?php echo base_url();?></b>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
		</table>
    </div> 
    <?php endforeach;?>
</body>
</html>
