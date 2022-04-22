 // ajax
 function ajax_transport_to_server() {
   var result = 1;
	 var formData = new FormData(document.forms.name_form);

   document.forms.name_form.querySelectorAll('input').forEach(function(el){
      if(el.name && el.value.replace(/\s+/g,'')=='')
        result *=0;
   })

   if(result!=1)
   {
    	document.getElementById("result").innerHTML = "<span style = 'color:red;'>Error</span>";
      return
   }

	 var xhr = new XMLHttpRequest();

   xhr.open("POST", "/email");
   xhr.send(formData);

	 xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            
              if(this.responseText==1)
                document.getElementById("result").innerHTML = "<span style = 'color:blue;'>Success Submit</span>";
            else
            	document.getElementById("result").innerHTML = "<span style = 'color:red;'>Error</span>";
        };

}
