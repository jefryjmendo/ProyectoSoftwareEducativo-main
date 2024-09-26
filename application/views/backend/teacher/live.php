<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<?php 
  $posts = $this->db->get_where('live' , array('live_id' => base64_decode($live_id)))->result_array();
  foreach ($posts as $row):
?>
<div class="content-w">
    <?php include 'fancy.php';?>
    <div class="header-spacer"></div>
        <div class="conty">
        <div class="content-i">
          <div class="content-box">
               <div class="back">
            <a href="<?php echo base_url();?>teacher/meet/<?php echo base64_encode($row['class_id']."-".$row['section_id']."-".$row['subject_id']);?>/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>
          </div>
            <div class="row">
              <div id="container" style="width:100%;height:100vh">
                
              
            </div>
        </div>
    </div>
  </div>
</div>
</div>

<script src="https://meet.jit.si/external_api.js"></script>
<script>
    var domain = "meet.jit.si";
    var options = {
        userInfo : { 
            email : '<?php echo $this->db->get_where('teacher', array('teacher_id' => $this->session->userdata('login_user_id')))->row()->email;?>' , 
            displayName : '<?php echo $this->crud_model->get_name('teacher', $this->session->userdata('login_user_id'));?>',
            moderator: true,
        },
        roomName: "<?php echo $row['room'];?>",
        width: "100%",
        height: "100%",
        parentNode: document.querySelector('#container'),
        configOverwrite: {},
        interfaceConfigOverwrite: {
            // filmStripOnly: true
        }
    }
    var api = new JitsiMeetExternalAPI(domain, options);
        api.executeCommand('subject', '<?php echo $row['title'];?>');
</script>
<?php endforeach;?>