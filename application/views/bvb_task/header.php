<div class="container">
	<div class="page-header">
	  <h1>BVB Task <small>This is gonna be tough </small></h1>
	  <?php if (isset($_SESSION['logged_in'])): ?>
	  <h1><small> <?php echo($_SESSION['logged_in']['username']); ?></small></h1>
	  <?php endif; ?>
	</div>
</div>