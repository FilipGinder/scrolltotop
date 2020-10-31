<?php
/**
* @package scroll_to_top
*/
/*
Plugin name: Scroll to top - Ginder
Plugin URI: http://scroll_to_top.com/plugin
Description: Ovo je moj prvi napisani plugin.
Version: 1.0.0
Author: Filip ginder
Author URI: https://snimanjeizvazduha.rs/
license: GPLv2 or later
Text Domain: scroll_to_top-plugin
*/

defined( 'ABSPATH' ) or die('Hej, ne mozete pristupiti ovom failu');


if(file_exists( dirname(__FILE__) . '/vendor/autoload.php')){
  require_once dirname(__FILE__) . '/vendor/autoload.php';
}

use Inc\Activate;
use Inc\Deactivate;

 if( ! class_exists( 'ScrollToTop' ))
 {


class ScrollToTop
{
    public $plugin;

    function __construct(){
       $this->plugin = plugin_basename( __FILE__ );   //dinamicki uzimanje imena plagina
    }

    function register(){

        add_filter("plugin_action_links_$this->plugin", array( $this, 'settings_link') );  //uzimanje liste linkova od plagina i slanja u funkciju settings-link

        add_action('admin_menu', array($this, 'add_admin_pages'));

        add_action( 'admin_enqueue_scripts', array( $this, 'scripte_css_js') ); //ovde odredjujemo sa admin ili wp da li ce se prikazivati na admin strani ili na frontus 
        add_action( 'wp_enqueue_scripts', array( $this, 'scripta_home_page_js') );  

        add_action( 'init', array( $this, 'provera_tabele') );   
    }


    public function settings_link( $links ){
        $settings_link = '<a href="options-general.php?page=scroll_to_top_plugin">Podesavanja</a>';
        array_push($links, $settings_link);
        return $links;
    }

    public function add_admin_pages(){
      add_menu_page('Scroll-to-top Plugin', 'Scroll-to-top', 'manage_options', 'scroll_to_top_plugin', array($this, 'admin_index'), 'dashicons-twitter-alt', 110 );
    }

            public function admin_index(){
               require_once plugin_dir_path( __FILE__ ) . 'teamplates/admin.php';
            }

    function scripte_css_js()
    {
      wp_enqueue_style('mypluginstyle', plugins_url( '/src/mystyle.css', __FILE__ ) );
      wp_enqueue_script('mypluginscript', plugins_url( '/src/myscript.js', __FILE__ ),array('jquery') );   
    }                                  //ovaj dodatak array('jquery') je obavezan da bi na fron-page radio jquery


    function scripta_home_page_js()
    {  
      wp_enqueue_script('mypluginscript', plugins_url( '/src/myscripthomepage.js', __FILE__ ),array('jquery') );  
    }


   public function provera_tabele()
    {
      global $wpdb;   //konekcija sa bazom
      //KREIRANJE TABELE ginder
          $result = $wpdb->get_charset_collate();

          $sql = "CREATE TABLE `{$wpdb->base_prefix}scrolltotop` (
            id int NOT NULL auto_increment,
            on_off varchar(255) NOT NULL,
            position varchar(255) NOT NULL,
            size varchar(255) NOT NULL,
            images varchar(255) NOT NULL,
            PRIMARY KEY  (id)
          ) $result;";

          require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
          dbDelta($sql);
         //KREIRANJE TABELE scrolltotop


          
          $results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}scrolltotop");
          $redovi = $wpdb->num_rows; //provera da li u bazi postoji neki red unosa
              if($redovi == 0)  //ako ne postoji unosimo osnovne - default podatke
              {
                $table_name = $wpdb->prefix . 'scrolltotop';
                $wpdb->insert($table_name, array('on_off' => 'iskljuceno','position' => 'desno','size' => 'srednja','images' => 'wp-content/plugins/scrolltotop/images/arrow.png' ));
              }                
    }


    function activate(){
      Activate::activate();   //ovo cita klasu i funkciju sa stranice Activate.php koja je ucitana na ovoj stranici
    }


    




}


  $scrolltotop = new ScrollToTop();
  $scrolltotop->register();


 register_activation_hook( __FILE__, array( $scrolltotop , 'activate') );

 register_deactivation_hook( __FILE__, array( 'Deactivate' , 'deactivate') );



//instaliran je composer i inicijalizovan u folderu mog/ovog plugina, uneti su podaci osnovni bzv. i samim tim je automacki napravljen fail composer.json..... u njemu je dodat "autoload": { "psr-4": {"Inc\\": "./inc"}}  sto znaci da automacki poziva taj folder zatim u cmd-u kucano composer install time se dodaje i folder vendor automacki. Zatim samo jednom ucitavamo.... require_once dirname(__FILE__) . '/vendor/autoload.php';
}