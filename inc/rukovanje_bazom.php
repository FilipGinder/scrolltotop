<?php 
/**
* @package scroll_to_top
*/


class rukovanje_bazom
{

//POZICIONIRANJE DUGMETA
 function pozicioniranje_dugmeta_levo()
 {
  require_once('../../../../wp-load.php');
  global $wpdb;
   $table_name = $wpdb->prefix . 'scrolltotop';
  $wpdb->update($table_name, array('position' => 'levo'), array('id'=> '1'));
 }

 function pozicioniranje_dugmeta_desno()
 {
  require_once('../../../../wp-load.php');
  global $wpdb;
   $table_name = $wpdb->prefix . 'scrolltotop';
  $wpdb->update($table_name, array('position' => 'desno'), array('id'=> '1'));
 }
//POZICIONIRANJE DUGMETA


//VELICINE DUGMETA
function velicina_dugmeta()
 {
  require_once('../../../../wp-load.php');
  global $wpdb;
  $velicina_dugmeta = $_POST['velicina_dugmeta'];
   $table_name = $wpdb->prefix . 'scrolltotop';
  $wpdb->update($table_name, array('size' => $velicina_dugmeta), array('id'=> '1'));
 }
//VELICINE DUGMETA


//UKLJUCIVANJE - ISKLJUCIVANJE
function ukljuceno()
 {
  require_once('../../../../wp-load.php');
  global $wpdb;
   $table_name = $wpdb->prefix . 'scrolltotop';
  $wpdb->update($table_name, array('on_off' => 'ukljuceno'), array('id'=> '1'));
 }


//UKLJUCIVANJE - ISKLJUCIVANJE
 function iskljuceno()
 {
  require_once('../../../../wp-load.php');
  global $wpdb;
   $table_name = $wpdb->prefix . 'scrolltotop';
  $wpdb->update($table_name, array('on_off' => 'iskljuceno'), array('id'=> '1'));
 }
//UKLJUCIVANJE - ISKLJUCIVANJE


//PODACI O SLICI
  function podaci_o_slici()
 {
  require_once('../../../../wp-load.php');
  global $wpdb;
  $podaci_o_slici = $_POST['podaci_o_slici'];
   $table_name = $wpdb->prefix . 'scrolltotop';
  $wpdb->update($table_name, array('images' => $podaci_o_slici), array('id'=> '1'));
 }
//PODACI O SLICI



//POCETNE VREDNOSTI
   function pocetne_vrednosti()
 {
  require_once('../../../../wp-load.php');
  global $wpdb;
   $results = $wpdb->get_results( "SELECT on_off,position,size,images FROM {$wpdb->prefix}scrolltotop");
      
       foreach ($results as $red) {
         $red->on_off;
         $red->position;
         $red->size;
        // $red->images;
       };
        $ispis = array($red->on_off,$red->position,$red->size,$red->images);
      exit(json_encode($ispis));
 }
 //POCETNE VREDNOSTI

}





//POZICIONIRANJE DUGMETA
if(isset($_POST['pozicioniranje_dugmeta_levo']))
{
	$objekat = new rukovanje_bazom();
	$rezultat = $objekat->pozicioniranje_dugmeta_levo();    //pozicioniranje dugmeta levo
}

if(isset($_POST['pozicioniranje_dugmeta_desno']))
{
	$objekat = new rukovanje_bazom();
	$rezultat = $objekat->pozicioniranje_dugmeta_desno();    //pozicioniranje dugmeta desno
}
//POZICIONIRANJE DUGMETA


//VELICINE DUGMETA
if(isset($_POST['velicina_dugmeta']))
{
	$objekat = new rukovanje_bazom();
	$rezultat = $objekat->velicina_dugmeta();    //velicina dugmeta mala
}
//VELICINE DUGMETA


//UKLJUCIVANJE - ISKLJUCIVANJE
if(isset($_POST['ukljuceno']))
{
  $objekat = new rukovanje_bazom();
  $rezultat = $objekat->ukljuceno();    //ukljucivanje
}

if(isset($_POST['iskljuceno']))
{
  $objekat = new rukovanje_bazom();
  $rezultat = $objekat->iskljuceno();    //iskljucivanje
}
//UKLJUCIVANJE - ISKLJUCIVANJE


//PODACI O SLICI
if(isset($_POST['podaci_o_slici']))
{
  $objekat = new rukovanje_bazom();
  $rezultat = $objekat->podaci_o_slici();    //iskljucivanje
}
//PODACI O SLICI


//POCETNE VREDNOSTI
if(isset($_POST['pocetne_vrednosti']))
{
  $objekat = new rukovanje_bazom();
  $rezultat = $objekat->pocetne_vrednosti();    //iskljucivanje
  exit(json_encode($rezultat));
}
//POCETNE VREDNOSTI
