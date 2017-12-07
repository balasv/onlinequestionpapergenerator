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

function addInput(divName){
  var counter = 1; 
          if(delete_cookie("counter")){
            alert("Deleted sucessfully");
          }
          else{
            alert("Delted unsucessfully");
          }
          var newdiv = document.createElement('div');
          var newdiv1 = document.createElement('div');
          newdiv.innerHTML = "<input type='text' name='ques" + (counter + 1) + "' placeholder='Write Question Here'><br>Difficulty:- <select name='diff" + (counter + 1) + "'>"+
            "<option value='E'>Easy</option><option value='M'>Medium</option><option value='H'>Hard</option></select>&nbsp;&nbsp;&nbsp;";
          
           newdiv1.innerHTML ="<input type='text' name='marks" + (counter + 1) + "' placeholder='Enter marks'>" ;
          document.getElementById(divName).appendChild(newdiv);
          document.getElementById(divName).appendChild(newdiv1);
          counter++;
          createCookie("counter", counter, "1");   
          

}
 function createCookie(name, value, days) {
 var expires;
 if (days) {
  var date = new Date();
  date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
  expires = "; expires=" + date.toGMTString();
 } else {
  expires = "";
 }
  document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
 }
 function delete_cookie(name) {
  document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}