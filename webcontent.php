<?php 
ob_start();
include('./data_control/conn.php');
include('./data_control/phpmagicbits.php');
include('./data_control/gwdna.php');
include('./data_control/datahandler.php');
include('./data_control/requesthandler.php');

$web_content_node=initialize_web_content();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Web Content</title>

    <!-- Bootstrap core CSS -->
<?php include("./includes/header_css_scripts.php");?> 
</head>

<body>
    <form method="post" enctype="multipart/form-data" id="editor_form">
    <main role="main" class="container-fluid skin_plasma " style="min-height:100vh;">
      <div class="row  justify-content-center pl-1 pr-1">
        <div class="row justify-content-center m-0 p-0 col-md-12 mb-3 ">  		              	
  			<div class="col-md-12 border-bottom text-center p-3 h2 d-none d-lg-block "> <span class="text-info">Light</span><span class="text-dark">speed</span> copy editor </div>
  			<div class="col-md-12 border-bottom text-center p-3 d-lg-none  "> <b><span class="text-info">Light</span><span class="text-dark">speed</span> copy editor</b> </div>
       </div>
          <!-- <{ncgh}/> - new code will replace this tag. Place it where you want the terminal to write new code-->
 
        <div class="row justify-content-center m-0 p-0 col-md-12 skin_plasma">
          <div class="col-md-2 p-0">
           <input type="text" id="txt_qcont" name="txt_qcont" class="form-control mosy_tup" data-mosy_tup="load_cont(get_newval('txt_qcont'))" value="" placeholder="Search Content"/>
            <div class="col-md-12 text-right cpointer p-0  "><span class="badge mosy_msdn" data-mosy_msdn="load_cont()" >Refresh</span></div>
            <div class="col-md-12 pt-1 "></div>
           <div class="row justify-content-center m-0 p-0 col-md-12" style="max-height:90vh; overflow:auto;" id="web_content_tbl_list"></div>
            <template id="load_elems">
                                <!-- Start side bar image card list -->
                    <div onclick="push_newval('web_content_uptoken', btoa('{{primkey}}'));initialize_web_content();mosyshow_elem('update_btn','');mosyshow_elem('del_btn','');load_token();" class=" cpointer row mb-2 skin_plasma text-dark mb-2 pt-2 pb-2 justify-content-center m-0 col-md-12  border-bottom shadow-sm" style="border-left:2px solid <?php echo $btn_bg ?>">
                      <div class="col-4 p-0">
                        <img src="{{section_pic}}" class=" "  onerror="this.src='img/useravatar.png'"  style="width:50px; height:50px; border-radius:50%;" id=""/>
                      </div>
                      <div class="col-8  text-left p-0 pl-2 "  style="font-size:12px">
                        <div class="trim_text"><b>{{section_title}} </b></div>
                        <div class="trim_text"><span>{{dna_remark}} </span></div>
                      </div>
                              
                      <div class=" border-top row justify-content-center m-0 p-0 col-md-12  ">
                        <div class="col-6 text-left badge p-2" style="font-size:12px;">Content Key : </div>
                        <div class="col-6 text-left badge p-2" style="font-size:12px;">{{site_cont_key}}</div>                        
                      </div>                      
                    </div>
                    <!-- End side bar image card list-->
            </template>
            <input type="hidden" id="web_content_uptoken" name="web_content_uptoken" value="<?php echo $web_content_uptoken ?>"/>
            <input type="hidden" id="txt_site_cont_key" name="txt_site_cont_key"/>
          </div>
          <div class="col-md-9">                                  
            <div class="col-md-12 mb-3 h4 text-info"> <span id="txt_section_title_disp"><?php echo $web_content_node['section_title'];?></span> / <span id="txt_site_cont_key_disp"><?php echo $web_content_node['site_cont_key'];?></span></div>

            <div class="row justify-content-left m-0 p-0 col-md-12">
			                         
              <div class="row justify-content-left p-2 border rounded_big mb-3 m-0 col-md-12 bg-light sticky_scroll" style="z-index:99">
                <img src="<?php echo $web_content_node['section_pic'];?>" onerror="this.src='img/useravatar.png'" id="src_section_pic" class="useravatar_small mr-3 cpointer mosy_msdn " data-mosy_msdn="mosy_img_pop(get_src('src_section_pic'), 'max-width:100%; max-height:70vh');glass_modal()"/>
                <span class="mr-3 badge text-secondary cpointer pt-3  mosy_msdn" data-mosy_msdn="mosytoggle_class('del_btn','d-block');mosytoggle_class('update_btn','d-block')" ><i class="fa fa-edit"></i> Toggle Editor </span>
                <span class="mr-3 badge text-secondary cpointer pt-3  mosy_msdn " id="update_btn" style="display:none" data-mosy_msdn="web_content_updt_('editor_form',['txt_section_title'],'load_cont:'+get_newval('txt_qcont'));magic_message('Processing...','alert_box')"><i class="fa fa-send"></i> Update  </span>                            
                <span class="mr-3 badge text-secondary cpointer pt-3 mosy_msdn " data-mosy_msdn="web_content_ins_('editor_form',['txt_section_title'],'load_cont:'+get_newval('txt_qcont'));magic_message('Processing...','alert_box')">
                  <i class="fa fa-save"></i> Add As New 
                </span>                            
                <span class="mr-3 badge text-secondary cpointer pt-3 mosy_msdn" id="del_btn" data-mosy_msdn="magic_yes_no_alert('Delete Item?', 'alert_box', 'web_content_rem_(get_newval(\'web_content_uptoken\'), \'load_cont\')', 'blackhole')" style="display:none"><i class="fa fa-trash text-danger"></i> Delete </span> 
                <label class="  mr-3 badge text-secondary cpointer pt-3">
                  <i class="fa fa-upload"></i> Upload Image <em id="file_name" class=""></em>
                  <input type="file" id="txt_web_content_section_pic"  name="txt_web_content_section_pic" style="display: none;" onchange="push_html('file_name', (this.value).replace('C:\\fakepath\\', ' | '))">
                </label> 
			    <span class="mr-3 badge text-secondary cpointer pt-3 mosy_msdn" data-mosy_msdn="mosy_refresh()" >Reload page</span>                
              </div> 
              <div class="row justify-content-center m-0 p-0 col-md-12">
               
                <div class="form-group col-md-12">
                  <label >Section Title</label>
                  <input class="form-control" id="txt_section_title" name="txt_section_title" placeholder="Section Title" type="text" value="<?php echo $web_content_node['section_title'];?>">
                </div>

                <div class="form-group col-md-12 text-left">
                  <label > Content </label>
                  <textarea class="form-control" name="txt_dna_remark" id="txt_dna_remark" class="form-control" placeholder="Section Content " style="min-height:70vh;"><?php echo $web_content_node['dna_remark'];?></textarea>
                </div>
              </div>
            </div>
          </div>
		</div>

          <!--<{ncgh}/>-->
      </div>

    </main><!-- /.container -->


 <!-- Bootstrap core JavaScript -->
 <!-- Placed at the end of the document so the pages load faster -->
    
<?php include("./includes/footer.php");?>
<script type="text/javascript">
function load_cont(qstr="",callbacks="")
  {
    if(callbacks!='')
      {
        qstr=callbacks;
      }

    qkload_web_content(qstr, 'push_grid_result:web_content_tbl_list', get_html("load_elems"));
    
    push_html('alert_box','');
    mosyhide_elem('update_btn');
    mosyhide_elem('del_btn')
  }
  load_cont();
  
  function load_token()
  {
  	window.history.replaceState(null, null, "?web_content_uptoken="+(get_newval('web_content_uptoken'))+"");
  }
</script>      
    </form>
</body>
</html>