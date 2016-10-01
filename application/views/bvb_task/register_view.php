<div class="well">
	<h3>Register new account</h3>
   <?php echo validation_errors(); ?>
   <?php echo form_open('users/verify_registration'); ?> 
    <div class="form-group">
    	<label for="email">Email:</label>
     	<input type="text" class="form-control" size="20" id="email" name="email"/>
  	</div>
  	<div class="form-group">
    	<label for="password">Password:</label>
     	<input type="password" class="form-control" size="20" id="password" name="password"/>
  	</div>
    <div class="form-group">
      <label for="passconf">Confirm password:</label>
      <input type="password" class="form-control" size="20" id="passconf" name="passconf"/>
    </div>
  	<input type="submit" class="btn btn-default" value="Register"/>
   </form>
</div>