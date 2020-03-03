<div class="page-body vertical-menu-mt">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-6">
          <!-- <h3><?php echo $title;?></h3> -->
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active"><?php echo $title;?></li>
          </ol>
        </div>
        <div class="col-lg-6">
          <ul class="menuBtn">
            <li> <a href="javascript:history.back()"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Back </a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <?php if ($this->session->flashdata('msg')) { ?>
  <?php echo $this->session->flashdata('msg'); ?>
  <?php } ?>
  <!-- Container-fluid starts-->
  <div class="container-fluid">        
  <div class="card">
              <div class="card-header" id="filtersticky">
                <h5><?php echo $title;?></h5>
              </div>
              <form name="addCMS" method="POST" action="<?php echo base_url('pages/saveCMS')?>">
                <?php

 if(isset($pages))
 {
        $title = $pages->title;
        $page_url = $pages->page_url;
        $page_content =  $pages->page_content;
        $meta_title = $pages->meta_title;
        $meta_keyword = $pages->meta_keyword;
        $meta_desc = $pages->meta_desc;

        $navigation_id = $pages->navigation_id;
        $category_id = $pages->category_id;
        $subcategory_id = $pages->subcategory_id;


        ?>
                <input type="hidden" name="id" value="<?php echo $pages->id ;?>" >
                <?php
 }
 else
 {
  $title = $page_url = $page_content =  $meta_title = $meta_keyword = $meta_desc = $navigation_id = $category_id = $subcategory_id = ''; 
 }
 ?>
                <div class="form-group row">
                  <label for="staticEmail" class="col-sm-2 col-form-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" required value="<?php echo $title; ?>" onckeypress />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="url" class="col-sm-2 col-form-label">Page URL</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="page_url" id="page_url" placeholder="this-is-example-url-pattern" required  value="<?php echo $page_url; ?>"/>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="url" class="col-sm-2 col-form-label">Description</label>
                  <div class="col-sm-10">
                    <textarea name="page_content" id="large-text-editor" required class="form-control"><?php echo $page_content; ?></textarea>
                  </div>
                </div>
                
                <!--<div class="form-group row">
    <label for="url" class="col-sm-2 col-form-label">Navigation Menu</label>
    <div class="col-sm-10">
    
    <select name="navigation_id" class="form-control" id="navigation_id">
                  <option value="">--Select Menu --</option>
                    <?php
                    foreach($menulist as $key=>$menu)
                    {
                    ?>
                    <option value="<?php echo $menu->id; ?>" <?php echo ($navigation_id!='' && $navigation_id==$menu->id)?'selected':''; ?>><?php echo $menu->menu; ?></option>
                    <?php } ?>
                </select>
    </div>
  </div>-->
                
                <div class="form-group row">
                  <label for="url" class="col-sm-2 col-form-label">Category</label>
                  <div class="col-sm-10">
                    <select name="category_id" class="form-control"  onchange="subcategory(this.value)">
                      <option value="">--Select Category --</option>
                      <?php
                    foreach($category as $key=>$role)
                    {
                    ?>
                      <option value="<?php echo $key; ?>" <?php echo ($category_id!='' && $category_id==$key)?'selected':''; ?>><?php echo $role; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                
                <!--<div class="form-group row">
    <label for="url" class="col-sm-2 col-form-label">Sub Category</label>
    <div class="col-sm-10">
  <select name="subcategory_id" id="subcategory_id" class="form-control">
     <option value="">--Select Subcategory --</option>
                    <?php
                    foreach($category as $key=>$role)
                    {
                    ?>
                    <option value="<?php echo $key; ?>" <?php echo ($subcategory_id!='' && $subcategory_id==$key)?'selected':''; ?>><?php echo $role; ?></option>
                    <?php } ?>
                </select>


           </select>     
    </div>
  </div>-->
                
                <div class="form-group row">
                  <label for="url" class="col-sm-2 col-form-label">Meta Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="meta_title" placeholder="" required value="<?php echo $page_url; ?>" id="meta_title"  maxlength="160"/>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="url" class="col-sm-2 col-form-label">Meta Keywords</label>
                  <div class="col-sm-10">
                    <textarea name="meta_keyword" class="form-control" required maxlength="160"><?php echo $meta_keyword; ?> </textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="url" class="col-sm-2 col-form-label">Meta Description</label>
                  <div class="col-sm-10">
                    <textarea name="meta_desc" class="form-control" required> <?php echo $meta_desc; ?></textarea>
                  </div>
                </div>
                <fieldset class="form-group">
                  <div class="row">
                    <div class="col-form-label col-sm-2 pt-0">Meta Noindex Tag</div>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="meta_noindex" id="gridRadios1" value="1" <?php echo (isset($pages) && $pages->meta_noindex=='1')?'checked="checked"':'';  ?>>
                        <label class="form-check-label" for="gridRadios1">Yes</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="meta_noindex" id="gridRadios2" value="0"  <?php echo (isset($pages)  && $pages->meta_noindex=='0')?'checked="checked"':'';  ?>>
                        <label class="form-check-label" for="gridRadios2">No</label>
                      </div>
                    </div>
                  </div>
                </fieldset>
                <fieldset class="form-group">
                  <div class="row">
                    <div class="col-form-label col-sm-2 pt-0">Disable In Service Menu</div>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="disable_top" id="gridRadios1" value="1"  <?php echo (isset($pages)  && $pages->disable_top=='1')?'checked="checked"':'';  ?>>
                        <label class="form-check-label" for="gridRadios1">Yes</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="disable_top" id="gridRadios2" value="0"  <?php echo (isset($pages)  && $pages->disable_top=='0')?'checked="checked"':'';  ?>>
                        <label class="form-check-label" for="gridRadios2">No</label>
                      </div>
                    </div>
                  </div>
                </fieldset>
                <div class="form-group">
                  <div class="col-sm-8 pull-right">
                    <button type="submit" class="btn btn-primary" name="save">SAVE</button>
                    <a href="<?php echo base_url('getpages')?>">
                    <button type="button" class="btn btn-danger" name="save">CANCEL</button>
                    </a> <br>
                    <br>
                  </div>
                </div>
              </form>
              <br>
            </div>    
  </div>
  <!-- Container-fluid Ends--> 
</div>
<style type="text/css">
 .row
 {
  padding: 20px;
 } 
</style>
<script src="https://cdn.ckeditor.com/4.9.2/full-all/ckeditor.js"></script> 
<script type="text/javascript">
CKEDITOR.replace('page_content');

 function subcategory(cate_id)
 {
  $.post("<?php echo base_url('pages/choosesubcategory'); ?>",{cate_id:cate_id},function(data) 
    {
          $('#subcategory_id').html(data);
    });
 }

$( "#title" ).keyup(function() {
  var dInput = this.value;
  $('#meta_title').val(dInput);

  var res = dInput.replace(" ", "-");
  var page_url = res.toLowerCase();
  $('#page_url').val(page_url);
});
</script>