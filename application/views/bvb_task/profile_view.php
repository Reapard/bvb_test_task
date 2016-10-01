<?php if (isset($_SESSION['channel_creation_message'])): ?>
	<p class=<?=$_SESSION['channel_creation_message']['message_type']?>>
		<?=$_SESSION['channel_creation_message']['message_body']?>
	</p>
<?php endif; ?>

<?php if (isset($_SESSION['channel_edit_message'])): ?>
	<p class=<?=$_SESSION['channel_edit_message']['message_type']?>>
		<?=$_SESSION['channel_edit_message']['message_body']?>
	</p>
<?php endif; ?>

<h3>Your channels</h3>

<?php if (isset($user_channels)): ?>
<table class="table table-hover">
	<tr>
	<th></th>
	<th></th>
	<th></th> 
	<th></th> 
	</tr>
<?php $counter = 0;?>
<?php foreach ($user_channels as $channel): ?>
	<tr>
	<td>
		<?=$channel['channel_name']?>
	</td>
	<td>
		<?=$channel['channel_description']?>
	</td>
	<td>
		<button class="btn btn-info" type="button"data-toggle="tooltip" data-placement="top" title="Edit channel">
		<a href="<?=site_url('channels/edit_chan_view/'.$channel['id'])?>">
		<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
		</a>
		</button>
	</td>
	<td>
		<button class="btn btn-danger" type="button"data-toggle="tooltip" data-placement="top" title="Remove channel">
		<a href="<?=site_url('channels/delete_channel/'.$channel['id'])?>">
		<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
		</a>
		</button>
	</td>
	</tr>
	<tr>
		<td>
			<?php foreach ($subscribers[$counter] as $local_subs): ?>
				<?=$local_subs." "?>
			<?php endforeach; ?>
		</td>
	</tr>
<?php $counter++;?>
<?php endforeach; ?>	
	</table>
<?php endif; ?>