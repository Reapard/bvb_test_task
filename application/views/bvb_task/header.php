<div class="container">
	<div class="page-header">
	  <?php if (isset($_SESSION['logged_in'])): ?>
	  <h3><small>Logged in as</small></h3>
	  <h2><small> <?php echo($_SESSION['logged_in']['username']); ?></small></h2>
	  <?php else: ?>
	  	<h2>Log in to view channels</h2>
	  <?php endif; ?>
	</div>
</div>