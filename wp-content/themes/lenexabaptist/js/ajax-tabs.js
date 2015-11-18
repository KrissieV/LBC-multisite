function loadTabCampus(i){

	if (location.hash) {
		i = location.hash.replace("#/link","");
		$('.current').removeClass('current');
		$('.top-shadow').removeClass('top-shadow');
        $('.link' + i).addClass('current');
        $('.link' + i).addClass('top-shadow');
	}

  var dataString = 'i='+ i;
  $("#tab-content").fadeIn(600).
       html('<img src="/wp-content/themes/lenexabaptist/images/loading.gif" class="loading" alt="loading" width="200"  />');
  $.ajax({
      type: "POST",
      url: "/wp-content/themes/lenexabaptist/ajax-content/campuses.php",
      data: dataString,
      cache: false,
      success: function(result){
             $("#tab-content").fadeIn(600).html(result);
      }
   });
}

function changeTabCampus(i){

  var dataString = 'i='+ i;
  $("#tab-content").fadeIn(400).
       html('<img src="/wp-content/themes/lenexabaptist/images/loading.gif" class="loading" alt="loading" width="200"  />');
  $.ajax({
      type: "POST",
      url: "/wp-content/themes/lenexabaptist/ajax-content/campuses.php",
      data: dataString,
      cache: false,
      success: function(result){
      		$("#tab-content").fadeOut(400, function() {
	      		$("#tab-content").html(result);
	      		$("#tab-content").fadeIn(400)
      		});
             $('.current').removeClass('current');
		$('.top-shadow').removeClass('top-shadow');
        $('.link' + i).addClass('current');
        $('.link' + i).addClass('top-shadow');
      }
   });
}

function loadTabStaff(i){

	if (location.hash) {
		i = location.hash.replace("#/link","");
		$('.current').removeClass('current');
        $('.link' + i).addClass('current');
	}

  var dataString = 'i='+ i;
  $("#tab-content").fadeIn(600).
       html('<img src="/wp-content/themes/lenexabaptist/images/loading.gif" class="loading" alt="loading" width="200"  />');
  $.ajax({
      type: "POST",
      url: "/wp-content/themes/lenexabaptist/ajax-content/staff.php",
      data: dataString,
      cache: false,
      success: function(result){
             $("#tab-content").fadeIn(600).html(result);
      }
   });
}

function changeTabStaff(i){

  var dataString = 'i='+ i;
  $("#tab-content").fadeIn(400).
       html('<img src="/wp-content/themes/lenexabaptist/images/loading.gif" class="loading" alt="loading" width="200"  />');
  $.ajax({
      type: "POST",
      url: "/wp-content/themes/lenexabaptist/ajax-content/staff.php",
      data: dataString,
      cache: false,
      success: function(result){
      		$("#tab-content").fadeOut(400, function() {
	      		$("#tab-content").html(result);
	      		$("#tab-content").fadeIn(400)
      		});
             $('.current').removeClass('current');
             $('.link' + i).addClass('current');
      }
   });
}


function changeTabPage(i){

  var dataString = 'i='+ i;
  $("#tab-content").fadeIn(400).
       html('<img src="/wp-content/themes/lenexabaptist/images/loading.gif" class="loading" alt="loading" width="200"  />');
  $.ajax({
      type: "POST",
      url: "/wp-content/themes/lenexabaptist/ajax-content/pageTab.php",
      data: dataString,
      cache: false,
      success: function(result){
      		$("#tab-content").fadeOut(400, function() {
	      		$("#tab-content").html(result);
	      		$("#tab-content").fadeIn(400)
      		});
      		
      		 $('ul.pill-nav').removeClass('hide');
             $('.current').removeClass('current');
             $('ul.pill-nav .main_bkgd').removeClass('main_bkgd');
             $('.page' + i).addClass('current');
             $('ul.pill-nav .page' + i).addClass('main_bkgd');
             $('.overview').addClass('current');
      }
   });
}

function changePillPage(i){

  var dataString = 'i='+ i;
  $("#tab-content").fadeIn(400).
       html('<img src="/wp-content/themes/lenexabaptist/images/loading.gif" class="loading" alt="loading" width="200"  />');
  $.ajax({
      type: "POST",
      url: "/wp-content/themes/lenexabaptist/ajax-content/pageTab.php",
      data: dataString,
      cache: false,
      success: function(result){
      		$("#tab-content").fadeOut(400, function() {
	      		$("#tab-content").html(result);
	      		$("#tab-content").fadeIn(400)
      		});
      		 $('ul.pill-nav').removeClass('hide');
             $('ul.pill-nav .current').removeClass('current');
             $('ul.pill-nav .main_bkgd').removeClass('main_bkgd');
             $('.page' + i).addClass('current');
             $('ul.pill-nav .page' + i).addClass('main_bkgd');
      }
   });
}

function changeTabEvents(i){

  var dataString = 'i='+ i;
  $("#tab-content").fadeIn(400).
       html('<img src="/wp-content/themes/lenexabaptist/images/loading.gif" class="loading" alt="loading" width="200"  />');
  $.ajax({
      type: "POST",
      url: "/wp-content/themes/lenexabaptist/ajax-content/eventsTab.php",
      data: dataString,
      cache: false,
      success: function(result){
      		$("#tab-content").fadeOut(400, function() {
	      		$("#tab-content").html(result);
	      		$("#tab-content").fadeIn(400);
	      		
      		});
      		 $('ul.pill-nav').addClass('hide');
             $('.current').removeClass('current');
             $('.events').addClass('current');
      }
   });
}

function changeTabVolunteer(i){

  var dataString = 'i='+ i;
  $("#tab-content").fadeIn(400).
       html('<img src="/wp-content/themes/lenexabaptist/images/loading.gif" class="loading" alt="loading" width="200"  />');
  $.ajax({
      type: "POST",
      url: "/wp-content/themes/lenexabaptist/ajax-content/volunteerTab.php",
      data: dataString,
      cache: false,
      success: function(result){
      		$("#tab-content").fadeOut(400, function() {
	      		$("#tab-content").html(result);
	      		$("#tab-content").fadeIn(400)
      		});
      		 $('ul.pill-nav').addClass('hide');
             $('.current').removeClass('current');
             $('.volunteer').addClass('current');
      }
   });
}

function changeTabNews(i){

  var dataString = 'i='+ i;
  $("#tab-content").fadeIn(400).
       html('<img src="/wp-content/themes/lenexabaptist/images/loading.gif" class="loading" alt="loading" width="200"  />');
  $.ajax({
      type: "POST",
      url: "/wp-content/themes/lenexabaptist/ajax-content/newsTab.php",
      data: dataString,
      cache: false,
      success: function(result){
      		$("#tab-content").fadeOut(400, function() {
	      		$("#tab-content").html(result);
	      		$("#tab-content").fadeIn(400)
      		});
      		 $('ul.pill-nav').addClass('hide');
             $('.current').removeClass('current');
             $('.news').addClass('current');
      }
   });
}