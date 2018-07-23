<?php
/**
* Plugin Name: NU Loader
* Plugin URI: http://brand.northeastern.edu/wp/plugins/nuloader
* Description: This plugin adds global university system functionality to your site, including: styles, super nav, utility nav, and footer.  If needed, this plugin will automatically add custom hooks to various locations within your sites theme files.  This is to allow custom content to be delivered and shown according to university brand guidelines.
* Version: 1.0.0
* Author: Northeastern University System
* Author URI: http://www.northeastern.edu/externalaffairs
* License: GPL2
*/





class NUModuleLoader{

  var $resourcesUrl;

  // initialize
  function __construct(){

    $this->resourcesUrl = array('https://www.northeastern.edu');

    if(is_admin()){ // this is a back-end page request (so it can be a little slower)
      // check the page templates and other resources to make sure that we have everything that we need in place
      if(null !== get_option('global_header') && get_option('global_header') == 'on'){
        $this->check_customhook_header();
      }
      if(null !== get_option('global_footer') && get_option('global_footer') == 'on'){
        $this->check_customhook_footer();
      }

      $this->admin_tools(); // add the tools to manage settings

    }else if(!is_admin()){ // this is a front-end request
      $this->frontend();
    }

  }





  // check to see if the requested module has already been initialized
  function check_customhook_header(){

    $p = get_template_directory().'/header.php';
    $f = fopen($p, "r") or die('Unable to open file!');
    $d = fread($f,filesize($p));
    fclose($f);

    if(!strpos($d,' ?><header')){ // we need to update the template
      $d = str_replace('<header','<?php if(function_exists("NUML_globalheader")){NUML_globalheader();} ?><header',$d);
      $f = fopen($p, "w+") or die('Unable to edit header file!');
      fwrite($f,$d);
      fclose($f);
    }

    unset($p,$f,$d);

  }

  function check_customhook_footer(){

    $p = get_template_directory().'/footer.php';
    $f = fopen($p, "r") or die('Unable to open file!');
    $d = fread($f,filesize($p));
    fclose($f);

    if(!strpos($d,'footer><?php')){ // we need to update the template
      $d = str_replace('</footer>','</footer><?php if(function_exists("NUML_globalfooter")){NUML_globalfooter();} ?>',$d);
      $f = fopen($p, "w+") or die('Unable to edit footer file!');
      fwrite($f,$d);
      fclose($f);
    }

    unset($p,$f,$d);

  }





  // this function gets run when on the admin pages
  function admin_tools():void{

    add_action( 'admin_menu','nuloader_add_admin_menu'); // adds menu item to wp dashboard
    add_action( 'admin_init','register_mysettings');

    function nuloader_add_admin_menu():void{
      add_menu_page( 'NU Loader Settings', 'NU Loader', 'manage_options', 'nu_loader', 'nuloader_options_page', plugin_dir_url( __FILE__ ) . '_ui/n.png' );
    }

    function register_mysettings():void{ // whitelist options
      register_setting( 'nu-loader-settings', 'global_material_icons' );
      register_setting( 'nu-loader-settings', 'global_header' );
      register_setting( 'nu-loader-settings', 'global_footer' );
    }

    function nuloader_options_page():void{
     ?>
       <div class="wrap">
         <?php settings_errors(); ?>
         <h1>NU Loader Settings</h1><br>
         <h3>Check off what you'd like to load into your site below.</h3>
         <form action="options.php" method="post">
           <?php
           settings_fields( 'nu-loader-settings' );
           do_settings_sections( 'nuloader_options_page' );
           ?>
           <table class="form-table">
             <tr valign="top">
               <th scope="row">Assets Needed</th>
               <td valign="top">
                 <label>
                   <input type="checkbox" name="global_material_icons" <?php echo esc_attr( get_option('global_material_icons') ) == 'on' ? 'checked="checked"' : ''; ?> />Global Google Material Icons?
                 </label><br/>
                 <p class="description" id="tagline-description">The <strong>Global Northeastern Header</strong> requires Google Material Icons.  If your theme is not loading them please check the box above.</p>
               </td>
             </tr>
             <tr valign="top">
               <th scope="row">Loader Options</th>
               <td valign="top">
                 <label>
                   <input type="checkbox" name="global_header" <?php echo esc_attr( get_option('global_header') ) == 'on' ? 'checked="checked"' : ''; ?> />Global Northeastern Header?
                 </label><br/>
                 <label>
                   <input type="checkbox" name="global_footer" <?php echo esc_attr( get_option('global_footer') ) == 'on' ? 'checked="checked"' : ''; ?> />Global Northeastern Footer?
                 </label>
               </td>
             </tr>
             <tr>
               <td><?php submit_button(); ?></td>
             </tr>
           </table>
           <h2>Need Help?</h2>
           <div id="nu_settings-help">
             If you need help or something isn't working please <a href="mailto:nudev@northeastern.edu?subject=NU Loader Plugin Help">contact us</a>.
           </div>
         </form>
       </div>
     <?php
    }
  }

  function frontend():void{

    // do we want to add in material icons?
    if(null !== get_option('global_material_icons') && get_option('global_material_icons') == 'on'){
      add_action('wp_head',array($this,'nu_materialicons'));//CSS
    }

    // add in the footer CSS if they have activated that module
    if(null !== get_option('global_footer') && get_option('global_footer') == 'on'){
      add_action('wp_head',array($this,'nu_footerstyles'));
    }

    // add in the header CSS and JS if they activated that module
    if(null !== get_option('global_header') && get_option('global_header') == 'on'){
      add_action('wp_head',array($this,'nu_headerstyles'));//CSS
      add_action('wp_footer',array($this,'nu_scripts'));//JS
    }

  }


  // build out the footer to be shown on the site
  public function build_footer(){

    if(null !== get_option('global_footer') && get_option('global_footer') == 'on'){

      $curl = curl_init($this->resourcesUrl[0].'/resources/includes/?r=footer');
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
      echo '<div id="nu__global-footer">'.curl_exec($curl).'</div>';
      curl_close($curl);

      unset($curl);

    }

  }

  // add the footer styles to the header
  function nu_footerstyles():void{
    echo '<link  rel="stylesheet" id="global-footer-style-css"  href="'.$this->resourcesUrl[0].'/nuglobalutils/common/css/footer.css" /> ';
  }


  // build out the header to be shown on the site
  public function build_header(){

    if(null !== get_option('global_header') && get_option('global_header') == 'on'){

      $curl = curl_init($this->resourcesUrl[0].'/resources/components/?return=main-menu');
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
      echo '<div id="nu__globalheader">'.curl_exec($curl).'</div>';
      curl_close($curl);

      unset($curl);

    }

  }

  // add in the JS for the global header
  function nu_scripts():void{
   echo '<script src="'.$this->resourcesUrl[0].'/nuglobalutils/common/js/navigation-min.js"></script>';
  }

  function nu_headerstyles():void{
    echo '<link  rel="stylesheet" id="global-header-style-css"  href="'.$this->resourcesUrl[0].'/nuglobalutils/common/css/utilitynav.css"  />';
  }

  function nu_materialicons():void{
    echo '<link  rel="stylesheet" id="global-font-css"  href="'.$this->resourcesUrl[0].'/nuglobalutils/common/css/material-icons.css"/>';
  }

}





// initialize new object
$NUML = new NUModuleLoader();

if(!is_admin()){ // only run this if the user in on the front-end pages
  function NUML_globalfooter(){
    global $NUML;
    $NUML->build_footer();
  }

  function NUML_globalheader(){
    global $NUML;
    $NUML->build_header();
  }
}
