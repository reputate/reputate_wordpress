<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.reputate.io
 * @since      1.0.0
 *
 * @package    Reputate_wordpress
 * @subpackage Reputate_wordpress/admin/partials
 */

/*
 * Register the settings
 */
// Save/Update our plugin options
?>
<script>

window.onload="reputateSetUpAjaxRep()"

function reputateSetUpAjaxRep() {
  var testAuthButton = document.getElementById('testAuthButton')
  testAuthButton.onclick = function(e) {
    var url = 'https://api.reputate.io/api/v1/testIntegrationAuth';
    var req = new XMLHttpRequest();
    req.open("GET", url, true);
    req.setRequestHeader("Authorization", "Basic " + btoa(document.getElementById('reputate_api_code').value + ":" + document.getElementById('reputate_api_key').value)); 
    req.onreadystatechange = function (aEvt) {
      if (req.readyState == 4) {
         if(req.status == 200) {
            document.getElementById('testResult').innerHTML = "Success, your code and key have been verified. Make sure you click the Save button to save your changes."
            console.log("Success!")
         }
         else{
            document.getElementById('testResult').innerHTML = "Failed, please check your code and key"
            console.log("Sheeeet")
         }
      } else {
        document.getElementById('testResult').innerHTML = "Failed: please check your code and key"
        console.log("Sheeeet2")
      }
    };
    req.send();
  }
  if (document.getElementById('reputate_opt_in_verbiage').value.length < 5) {
    document.getElementById('reputate_opt_in_verbiage').value = "Subscribe to our marketing and promotions, including potential offers and deals!"
  }
}

</script>
<style>
#testAuthButton {
  left: 5px;
  position: relative;
  top: 20px;
}
.testHeader {
  vertical-align: top;
  text-align: left;
  padding: 20px 10px 20px 0;
  width: 200px;
  line-height: 1.3;
  font-weight: 600;
  display: inline-block;
}
.customContainer {
  position: relative;
  top: -40px;
}
</style>
<h1 class="wp-heading-inline">Repuate.io Plugin Settings Page</h1>
<div class="postbox">
	<br>
	<div style="padding-left:15px;" class="inside"><p>This page contains the options for the Reputate.io plugin. Make sure to go to your Reputate Dashboard, click the Gear Icon at the bottom left (settings button), then on the Integrations Tab click "Generate API Key". Copy that key into the text box below, save it, then re-fresh the page and click Test Connection. If all tests well then your plugin installation and configuration was successful!</p>
	</div>
	<!-- .inside -->

</div>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<br>
  <form method="post" action="options.php">
    <?php settings_fields( 'reputate-settings' ); ?>
    <?php do_settings_sections( 'reputate-settings' ); ?>
    <table class="form-table">
      <tr valign="top">
      <th scope="row">Checkout Opt-In Verbiage:</th>
      <td><input type="text" id="reputate_opt_in_verbiage" name="reputate_opt_in_verbiage" value="<?php echo get_option( 'reputate_opt_in_verbiage' ); ?>" style="display: inline-block; width: 80%" class="regular-text code" /> </td>
      </tr>
      <tr>
      <tr valign="top">
      <th scope="row">Reputate API Code:</th>
      <td><input type="text" id="reputate_api_code" name="reputate_api_code" value="<?php echo get_option( 'reputate_api_code' ); ?>" style="display: inline-block;" placeholder=="Enter API Key from your Reputate Dashboard Here" class="regular-text code" /> </td>
      </tr>
      <tr>
      <th scope="row">Reputate API Key:</th>
      <td><input type="text" id="reputate_api_key" name="reputate_api_key" value="<?php echo get_option( 'reputate_api_key' ); ?>" style="display: inline-block;" placeholder=="Enter API Key from your Reputate Dashboard Here" class="regular-text code" /> <?php submit_button(); ?></td>
      </tr>
    </table>
  </form>
  <div class="customContainer">
    <div class="testHeader form-table th">Test Connection:</div>
    <div id="testAuthButton" class="button-secondary">Test Connection</div>
    <div id="testResult"></div>
  </div>
  <script>
    reputateSetUpAjaxRep()
  </script>
<br>
<br>

