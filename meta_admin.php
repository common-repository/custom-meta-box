<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if( is_admin() ) 
{
	if(isset($_POST['pf_submit']))
	{
		if (isset( $_POST['pf_added'] ) && wp_verify_nonce($_POST['pf_added'], 'add-item') )
		{
			$_POST['default_option_name'];
			update_user_meta('1', 'default_option_name', sanitize_text_field($_POST['default_option_name']));	
		}
		else
		{
			wp_die('Our Site is protected!!');
		}
	}
	$user_meta = get_user_meta('1', 'default_option_name', $single);
?>

	<div class="wrap">
	<h2>Default Meta In Head</h2>

	<form method="post" action="">
	 <?php wp_nonce_field('add-item','pf_added'); ?>
		<table class="form-table" style="width: 100%">
			<tr valign="top">
			<th scope="row">Default Meta</th>
			<td>
			<textarea  name="default_option_name" placeholder="Default Meta" style="width: 50%;height: 251px;" ><?php print_r($user_meta['0']); ?></textarea>
			</td>
			</tr>
			<tr valign="top">
			<th scope="row"></th>
			<td>
	   <input type="submit" name="pf_submit" id="submit" class="button button-primary" value="Save Changes">
			</td>
			</tr>
		</table>
	</form>
	</div>
	
<?php } else {?> 

	<h3>You don't have permission only Admin have right to use this plugin.</h3>

<?php } ?>	