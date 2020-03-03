  <?php include_once ('top_content.php'); ?>


   <h2 class="orderview-title"> Generate Letter</h2>
<br>

          <form name="addform" method="POST" action="<?php echo site_url('Order/submitletters')?>">

            
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">

                  <input type="hidden" name="OrderId" id="OrderId" value="<?php echo $order_id; ?>">
                  <input type="hidden" name="letter_id" id="letter_id" value="<?php echo $letter_id; ?>">
                  <input type="hidden" name="commonletterid" id="commonletterid" value="<?php echo $commonletterid; ?>">
          
          
  <ul class="nav nav-tabs subNavTab">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#experians">Experians</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#equifax">Equifax</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#transunion">Transunion</a>
    </li>
  </ul>  
  
   <div class="tab-content">
    <div id="experians" class="tab-pane active"><br>
     <div class="form-group">
         <textarea name="message" id="messagehere"><?php echo $letters[0]['message']; ?></textarea>
        </div>
    </div>
    <div id="equifax" class="tab-pane fade"><br>
      <div class="form-group">
        <textarea name="message1" id="message1"><?php echo $letters[1]['message']; ?></textarea>
        </div>
    </div>
    <div id="transunion" class="tab-pane fade"><br>
     <div class="form-group">
        <textarea name="message2" id="message2"><?php echo $letters[2]['message']; ?></textarea>
        </div>
    </div>
  </div> 
  <button type="submit" class="btn btn-primary">Submit</button>       
      </form>


<script src="https://cdn.ckeditor.com/4.9.2/full-all/ckeditor.js"></script>   
<script>
CKEDITOR.replace('messagehere');
CKEDITOR.replace('message1');
CKEDITOR.replace('message2');
</script> 

  
<?php include_once ('bottom_content.php');