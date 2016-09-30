<div class="well">
	<h3>Edit your channel's info</h3>
   <?php echo validation_errors(); ?>
   <?php if (isset($_SESSION['channel_edit_message'])): ?>
         <p class=<?=$_SESSION['channel_edit_message']['message_type']?>>
         <?=$_SESSION['channel_edit_message']['message_body']?>
         </p>
         <?php endif; ?>
   <?php echo form_open('channels/edit_channel/'.$info[0]['id']); ?> 
    <div class="form-group">
    	<label for="chan_name">Channel name:</label>
     	<input type="text" class="form-control" size="20" id="chan_name" name="chan_name" value="<?=$info[0]['channel_name']?>"/>
  	</div>
  	<div class="form-group">
    	<label for="chan_desc">Channel description:</label>
     	<textarea type="text" class="form-control" size="80" id="chan_desc" name="chan_desc" value="<?=$info[0]['channel_description']?>" /></textarea>
  	</div>
  	<input type="submit" class="btn btn-default" value="Apply"/>
   </form>
</div>