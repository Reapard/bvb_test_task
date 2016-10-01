<div class="row">
<div class="btn-group-vertical" role="group">
	<button class="btn btn-default" type="button">
  		<a href="<?php echo site_url('main_ctrl');?>">Home</a>
	</button>
<?php if (! isset($_SESSION['logged_in'])): ?>
	<button class="btn btn-default" type="button">
  		<a href="<?php echo site_url('users/login');?>">Login</a>
	</button>
	<button class="btn btn-default" type="button">
  		<a href="<?php echo site_url('users/register');?>">Register</a>
	</button>
<?php else: ?>
	<button class="btn btn-default" type="button">
  		<a href="<?php echo site_url('main_ctrl/profile');?>">Account</a>
	</button>
	<button class="btn btn-default" type="button">
  		<a href="<?php echo site_url('users/logout');?>">Logout</a>
	</button>
<?php endif; ?>
</div>
</div>