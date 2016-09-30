<?php if (isset($_SESSION['logged_in'])): ?>
<div class="well">
   <?php echo form_open('main_ctrl/search', 'class="form-inline"'); ?> 
    <div class="form-group">
    	<label for="chan_name"></label>
     	<input type="text" class="form-control" size="20" id="chan_name" name="chan_name" placeholder="Channel" value='<?=$s_channel?>'/>
  	</div>
  	<input type="submit" class="btn btn-default" value="Search"/>
   </form>
</div>

<ul class="nav nav-tabs" role="tablist">
    <li role="presentation"><a href="#subscribed_chans" aria-controls="subscribed_chans" role="tab" data-toggle="tab">Subscribed</a></li>
    <li role="presentation" class="active"><a href="#nonsubscribed_chans" aria-controls="nonsubscribed_chans" role="tab" data-toggle="tab">Non-Subscribed</a></li>
</ul>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane" id="subscribed_chans">
		<?php if (isset($subscribed_channels)): ?>
			<table class="table table-hover">
				<tr>
				<th>Favourites</th>
				<th></th> 
				</tr>
				
			<?php foreach ($subscribed_channels as $sub): ?>
				<tr>
				<td>
					<?=$sub['channel_name']?>
				</td>
				<td>
					<?=$sub['channel_description']?>
				</td>
				<td>
				<button class="btn btn-danger" type="button"data-toggle="tooltip" data-placement="top" title="Remove from favourites">
				<a href="<?=site_url('bvb_task/subscriptions/unsubscribe/'.$sub['id'])?>">
				<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
				</a>
				</button>
				</td>
				</tr>
			<?php endforeach; ?>		
				</table>
			<?php endif; ?>
    </div>

    <div role="tabpanel" class="tab-pane active" id="nonsubscribed_chans">
    	<?php if (isset($nonsubscribed_channels)): ?>
		<table class="table">
			<tr><th>
				Channels
			</th><th></th><th></th></tr>
			<?php foreach ($nonsubscribed_channels as $channel): ?>
				<tr>
				<td>
			  		<?=$channel['channel_name']?>
				</td>
				<td>
			  		<?=$channel['channel_description']?>
				</td>
				<td>
					<button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to favourites">
			  		<a href="<?=site_url('bvb_task/subscriptions/subscribe/'.$channel['id'])?>">
			  		<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
			  		</a>
				</button>
				</td>
				</tr>
			<?php endforeach; ?>
		</table>
		<?php endif; ?>
    </div>
</div>
<?php endif; ?>
