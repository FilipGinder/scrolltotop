jQuery(document).ready(function(){
 pocetne_vrednosti_za_admin_stranu();

 function pocetne_vrednosti_za_admin_stranu()
 {
 	var pocetne_vrednosti = 'pocetne_vrednosti';
	        jQuery.post("../wp-content/plugins/scrolltotop/inc/rukovanje_bazom.php",{  //putanja za admin stranu
	             pocetne_vrednosti:pocetne_vrednosti
	        },function(data,status){
                var data = jQuery.parseJSON(data);       	
	        	var on_off = "";
	        	var position = "";
	        	var size = "";
	        	var slika = "";
	        	
	            
	            for( var i=0; i<data.length;i++)
	            {
	              var on_off = data[0];
	              var position = data[1];
	              var size = data[2];                                       
	              var slika = data[3];
	            }
                

                jQuery('input[name="velicine"]').filter('[value="' + size +'"]').prop('checked', true);
	            jQuery('input[name="odabir_slike"]').filter('[value="' + slika +'"]').attr('checked', true);
                
                if(on_off == "ukljuceno")
                {
                	jQuery('#upaljeno_ugaseno').prop('checked', true);
                }

                if(position == "levo")
                {
                	jQuery('#levo_desno').prop('checked', true);
                }

             
	        });
 }





	jQuery('#sacuvaj_podesavanja').click(function(){


		if(jQuery('#upaljeno_ugaseno').prop('checked') == true)  
		{     
              var ukljuceno = 'ukljuceno';
			        jQuery.post("../wp-content/plugins/scrolltotop/inc/rukovanje_bazom.php",{
			             ukljuceno:ukljuceno
			        },function(data,status){

			        });              
		}
		else
		{     
              var iskljuceno = 'iskljuceno';
			        jQuery.post("../wp-content/plugins/scrolltotop/inc/rukovanje_bazom.php",{
			             iskljuceno:iskljuceno
			        },function(data,status){
			        
			        });             
		}




		if(jQuery('#levo_desno').prop('checked') == true)  
		{
              //pozicioniranje dugmeta levo - belezenje u bazi

              var pozicioniranje_dugmeta_levo = 'pozicioniranje_dugmeta_levo';
			        jQuery.post("../wp-content/plugins/scrolltotop/inc/rukovanje_bazom.php",{
			             pozicioniranje_dugmeta_levo:pozicioniranje_dugmeta_levo
			        },function(data,status){
			         
			        });
		}
		else
		{
           //    //pozicioniranje dugmeta desno - belezenje u bazi

              var pozicioniranje_dugmeta_desno = 'pozicioniranje_dugmeta_desno';
			        jQuery.post("../wp-content/plugins/scrolltotop/inc/rukovanje_bazom.php",{
			             pozicioniranje_dugmeta_desno:pozicioniranje_dugmeta_desno
			        },function(data,status){
			         
			        });
		}




        var velicina_dugmeta = jQuery('input[name="velicine"]:checked').val();		
              //kreiranje najmanje velicine dugmeta - belezenje u bazi

			        jQuery.post("../wp-content/plugins/scrolltotop/inc/rukovanje_bazom.php",{
			             velicina_dugmeta:velicina_dugmeta
			        },function(data,status){
			         	
			        });


 
       var podaci_o_slici = jQuery('input[name="odabir_slike"]:checked').val();
       //uvek uzimamo putanju do odabrane slike prilikom cuvanja podesavanja

			        jQuery.post("../wp-content/plugins/scrolltotop/inc/rukovanje_bazom.php",{
			             podaci_o_slici:podaci_o_slici
			        },function(data,status){
			         
			        }); 

	
	alert('Uspesno sacuvani podaci');
	});




//ovim pozivamo rad dugmeta na pocetnoj strani
	jQuery(".dugme_za_gore_pocetna").click(function(){
	alert('radi');
});


//ovim pozivamo rad dugmeta na admin strani
	jQuery(document).on('click', '.dugme_za_gore_admin', function(){
		alert('radi admin');
	}) //SAMO OVAKO MOZEMO POZIVATI KLIK DINAMCIKI STVORENIH DUGMICA


});