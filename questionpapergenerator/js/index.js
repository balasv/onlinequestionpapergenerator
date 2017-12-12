$('.form').find('input, textarea').on('keyup blur focus', function (e) {
  
  var $this = $(this),
      label = $this.prev('label');

	  if (e.type === 'keyup') {
			if ($this.val() === '') {
          label.removeClass('active highlight');
        } else {
          label.addClass('active highlight');
        }
    } else if (e.type === 'blur') {
    	if( $this.val() === '' ) {
    		label.removeClass('active highlight'); 
			} else {
		    label.removeClass('highlight');   
			}   
    } else if (e.type === 'focus') {
      
      if( $this.val() === '' ) {
    		label.removeClass('highlight'); 
			} 
      else if( $this.val() !== '' ) {
		    label.addClass('highlight');
			}
    }

});

$('.tab a').on('click', function (e) {
  
  e.preventDefault();
  
  $(this).parent().addClass('active');
  //$(this).parent().siblings().removeClass('active');
  
  target = $(this).attr('href');

  $('.tab-content > div').not(target).hide();
  
  $(target).fadeIn(600);
  
});
 var counter = 1;
function addInput(divName){
        if( !document.refreshForm.visited.value == "" )
  {counter = 1;
  }
          var newdiv = document.createElement('div');
          var newdiv1 = document.createElement('div');
          newdiv.innerHTML = "<input type='text' name='ques" + (counter + 1) + "' placeholder='Write Question Here'><br>"+
            "<input type='number' name='unit" + (counter + 1) + "' placeholder='Enter Unit' required>&nbsp;&nbsp;&nbsp;";
          
           newdiv1.innerHTML ="<input type='text' name='marks" + (counter + 1) + "' placeholder='Enter marks'>" ;
          document.getElementById(divName).appendChild(newdiv);
          document.getElementById(divName).appendChild(newdiv1);
          counter++;
          document.searchcust.counter.value = counter;
          

}
function addquestion(){
         var counter = 1;
         var char = 'A';
         var total =document.getElementById('tqno').value;
          var newdiv = document.createElement('div');
          $("#totalqno").show()
          // alert("We are here "+(total));
          while(counter <= total){ 
            newdiv.innerHTML ="QNo:- "+ (char) +" <input type='text' name='mainques" + (counter) + "' placeholder='Enter Sub Questions'><br>";
             
          document.getElementById("totalqno").appendChild(newdiv.cloneNode(true)); alert("We are here "+(counter));
          counter++;
          char= String.fromCharCode(char.charCodeAt(0) + 1);
          } 
          //document.Selectqno.totalqno.value = counter;
          

}
 