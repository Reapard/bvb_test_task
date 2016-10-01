<div class="row">
<div class="btn-group-vertical" role="group">
	<button class="btn btn-success" type="button" id="add_channel_button">
  		Add channel
	</button>
</div>

<div class="row" id="add_channel_form" hidden>
			<div class="well">
				<h3>Add channel</h3>
			   <?php echo validation_errors(); ?>
			   <?php echo form_open('channels/add_channel'); ?> 
			    <div class="form-group">
			    	<label for="chan_name">Channel name:</label>
			     	<input type="text" size="20" class="form-control" id='chan_name' name="chan_name"/>
			  	</div>
			  	<div class="form-group">
			    	<label for="chan_desc">Description:</label>
			     	<textarea class="form-control" size="80" rows='3' id='chan_desc' name="chan_desc"/></textarea>
			  	</div>
			  	<input type="submit" class="btn btn-success" value="Add"/>
			   </form>
			</div>
</div>
</div>