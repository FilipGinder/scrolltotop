jQuery(document).ready(function(){

var pocetne_vrednosti = 'pocetne_vrednosti';
	        jQuery.post("wp-content/plugins/scrolltotop/inc/rukovanje_bazom.php",{  //putanja za admin stranu
	             pocetne_vrednosti:pocetne_vrednosti
	        },function(data,status){
                var data = jQuery.parseJSON(data);
	        	var rezultat = "";	        	
	        	var on_off = "";
	        	var position = "";
	        	var size = "";
	        	var slika = "";
	        	
	            
	            for( var i=0; i<data.length;i++)
	            {
	             var rezultat = "<img src="+ data[3] +" class='dugme_za_gore_pocetna' alt='Povratak na vrh' >"
	                                                    //dinamicki izvlacimo iz baze putanju do slike
	              var on_off = data[0];
	              var position = data[1];
	              var size = data[2];                                       
	              var slika = data[3];
	            }

	            if(on_off == 'ukljuceno')
	            {
                   jQuery(".home").append(rezultat); //sliku dodajemo na pocetnu stranu
                   jQuery(".dugme_za_gore_pocetna").css({"display":"none"});  //ali je po default-u odmah nevidljivo..
                                                                             //pojavljuje se tek kada se zaskroluje 

                   if(position == "levo")
		                {
		                       jQuery(".dugme_za_gore_pocetna").css({"position":"fixed","left":"3%","right":"","bottom":"3%","z-index":"1"});	
		                }
		                else if(position == "desno")
		                {
		                       jQuery(".dugme_za_gore_pocetna").css({"position":"fixed","right":"3%","left":"","bottom":"3%","z-index":"1"});
		                }


		            if(size == 'mala')
			                {
			                   jQuery(".dugme_za_gore_pocetna").css({"width":"35px","height":"35px"});
			                }
			                else if(size == 'srednja')
			                {
			                   jQuery(".dugme_za_gore_pocetna").css({"width":"45px","height":"45px"});
			                }
			                else if(size == 'najveca')
			                {
			                	jQuery(".dugme_za_gore_pocetna").css({"width":"55px","height":"55px"});
			                }
	            }


	            else if(on_off == 'iskljuceno')
	            {
                    
                   jQuery(".dugme_za_gore_pocetna").css({"display":"none"});
          
	            }
            
	        });




		jQuery(window).scroll(function() {   //dugme je po defaultu nevidljivo

		       jQuery(".dugme_za_gore_pocetna").css("display","block"); //kad krene skrolovanje onda se pojavljuje
		       if(jQuery(this).scrollTop() == 0)   //i kad je ponovo stranica na vrhu
		       {
		         jQuery(".dugme_za_gore_pocetna").css("display","none"); //onda ga sklanja
		       }

		    });


	    jQuery(document).on('click','.dugme_za_gore_pocetna',function(){
	             //OVAKO MOZEMO DA SE POZIVAMO NA KLIK DINAMICKIH STVORENIH DUGMICA

	         jQuery('html, body').animate({
	            scrollTop: jQuery("body").offset() == 0   //a kada se klike na njega onda se stranica automacki skroluje ka vrhu
	         }, 500);
	         jQuery(".dugme_za_gore_pocetna").css("display","none");  //i sklanja dugme
	             });



});