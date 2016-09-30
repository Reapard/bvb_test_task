<div class="well">
	<h3>Login</h3>
   <?php echo validation_errors(); ?>
   <?php echo form_open('bvb_task/users/verify_login'); ?> 
    <div class="form-group">
    	<label for="email">Usermail:</label>
     	<input type="text" class="form-control" size="20" id="email" name="email"/>
  	</div>
  	<div class="form-group">
    	<label for="password">Password:</label>
     	<input type="password" class="form-control" size="20" id="password" name="password"/>
  	</div>
  	<input type="submit" class="btn btn-default" value="Login"/>
   </form>
</div>