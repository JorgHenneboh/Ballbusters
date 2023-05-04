$('.no-js').removeClass('no-js').addClass('js');

var template_path = $('html').data('path');

// SVG-Unterstützung für IE laden.
svg4everybody();

function setCookie(cname, cvalue, exdays = 0) {
  var date, expires;
  if (exdays) {
    date = new Date();
    date.setTime(date.getTime() + (exdays * 24 * 60 * 60 * 1000));
    expires = ' expires=' + date.toGMTString();
  }
  document.cookie = cname + '=' + cvalue + '; path=/;' + expires;
}

function hasCookieVal(cname, val) {
  if (document.cookie.indexOf(cname + '=' + val) >= 0) {
    return true;
  }
  return false;
}

function hasCookie(cname) {
  if (hasCookieVal(cname, 'true')) {
    return true;
  }
  return false;
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function hasCookieSplitVal(cname, val) {
  var value = getCookie(cname);
  var split = value.split('|');
  for (var i = 0; i < split.length; i++) {
    var c = split[i];
    if (c.indexOf(val) == 0) {
      return true;
    }
  }
  return false;
}

function addCookieSplitVal(cname, val, exdays = 0) {
  var newval;
  var value = getCookie(cname);
  if (value) {
    var split = value.split('|');
    for (var i = 0; i < split.length; i++) {
      var c = split[i];
      if (c == val) {
        return false;
      }
    }
    split.push(val);
    newval = split.join('|');
  } else {
    newval = val;
  }
  setCookie(cname, newval, exdays);
}

function removeCookieSplitVal(cname, val, exdays = 0) {
  var value = getCookie(cname);
  var split = value.split('|');
  var filtered = split.filter(function(value, index, arr) {
    return value != val;
  });
  var newval = filtered.join('|');
  setCookie(cname, newval, exdays);
}

function removeCookie(cname) {
  document.cookie = cname + '= ;  path=/; expires = Thu, 01 Jan 1970 00:00:00 GMT';
}

/**
 * Add hash to url without scrolling
 *
 * @param String $url - it could be hash or url with hash
 *
 * @return void
 */
function addHashToUrl($url) {
  if ('' == $url || undefined == $url) {
    $url = '_'; // it is empty hash because if put empty string here then browser will scroll to top of page
  }
  $hash = $url.replace(/^.*#/, '');
  var $fx, $node = $('#' + $hash);
  if ($node.length) {
    $fx = $('<div></div>')
      .css({
        position: 'absolute',
        visibility: 'hidden',
        top: $(window).scrollTop() + 'px'
      })
      .attr('id', $hash)
      .appendTo(document.body);
    $node.attr('id', '');
  }
  document.location.hash = $hash;
  if ($node.length) {
    $fx.remove();
    $node.attr('id', $hash);
  }
}

// debulked onresize handler
function on_resize(c,t){onresize=function(){clearTimeout(t);t=setTimeout(c,100)};return c};

var mobile = true;

if (window.innerWidth >= 1440) {
	mobile = false
}

on_resize(function() {
  // handle the resize event here
  if (window.innerWidth >= 1440) {
  	mobile = false
  } else {
		focusout_close();
		mobile = true
  }
})();

var focusableElementsString = "a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, *[tabindex], *[contenteditable]";
var focusedElementBeforeModal;

function trapTabKey(obj, evt) {
	if (evt.which == 9) {
			var o = obj.find("*");
			var focusableItems;
			focusableItems = o.filter(focusableElementsString).filter(":visible")
			var focusedItem;
			focusedItem = $(":focus");
			var numberOfFocusableItems;
			numberOfFocusableItems = focusableItems.length
			var focusedItemIndex;
			focusedItemIndex = focusableItems.index(focusedItem);

			if (evt.shiftKey) {
					if (focusedItemIndex == 0) {
							focusableItems.get(numberOfFocusableItems - 1).focus();
							evt.preventDefault();
					}

			} else {
					if (focusedItemIndex == numberOfFocusableItems - 1) {
							focusableItems.get(0).focus();
							evt.preventDefault();
					}
			}
	}
}

function setInitialFocusModal(obj) {
	var o = obj.find("*");
	var focusableItems;
	focusableItems = o.filter(focusableElementsString).filter(":visible").first().focus();
}

function setFocusToFirstItemInModal(obj){
	var o = obj.find("*");
	o.filter(focusableElementsString).filter(":visible").first().focus();
}

function showModal(content, overlay, modal, displayMode = 'flex') {
	$(content).attr("aria-hidden", "true");
	$(overlay).css("display", "block");
	$(modal).css("display", displayMode);
	$(modal).attr("aria-hidden", "false");
	$("body").on("focusin",content,function() {
			setFocusToFirstItemInModal($(modal));
	})

	focusedElementBeforeModal = $(":focus");
	setFocusToFirstItemInModal($(modal));
}

function hideModal(content, overlay, modal) {
	$(overlay).css("display", "none");
	$(modal).css("display", "none");
	$(modal).attr("aria-hidden", "true");
	$(content).attr("aria-hidden", "false");
	$("body").off("focusin",content);
	focusedElementBeforeModal.focus();
}

// Menü ein-/ausblenden.
$('.toggle').each(function() {

  var toggle_for = $('#' + $(this).attr('aria-controls'));

  toggle_for.hide();

  $(this).click(function(e) {
		$(this).toggleClass('active');
		toggle_for.slideToggle({
			duration: 'fast',
			step: function() {
				if ($(this).css('display') == 'flex') {
					$(this).css('display', 'block');
				}
			},
			complete: function() {
				if ($(this).css('display') == 'flex') {
					$(this).css('display', 'block');
				}
			}
		})

    $(this).attr('aria-expanded', function(i, attr) {
      return attr === 'false';
    });

    $(this).attr('aria-label', function(i, attr) {
      if (attr === 'Menü öffnen') {
        attr = 'Menü schließen'
      } else if (attr === 'Menü schließen') {
        attr = 'Menü öffnen'
      }
      return attr
    });

  });
});

var $mainmenu = $(".main-nav"),
	undef = undefined,
	$activeContainer = undef,
	suspendFocusOut = undef;

$mainmenu.on("mousedown", function(e) {
	suspendFocusOut = true;
});
$mainmenu.on("mouseup", function(e) {
	suspendFocusOut = undef;
});
$(window).on("mouseup", function(e) {
	suspendFocusOut = undef;
});

function focusout_close() {
  $(".main-nav").on("focusout", "#mobile-search", function() {
		// we need to defer the check, because a bug in chrome:
		// document.activeElement is set to the body temporarily when focus moves
		if(suspendFocusOut) return;
		var content = this;
		setTimeout(function() {
			//			console.log("out", $(content).has(document.activeElement).length, document.activeElement, content);
			if(!$(content).has(document.activeElement).length) closeContainer();
		}, 0);
	});
}

if (mobile) {
	focusout_close();
}
//
// on_resize(function () {
// 	if (mobile) {
//
// 	}
// });

function closeContainer() {
	$('#mobile-search').slideUp('fast');
	$('.toggle').attr('aria-expanded', 'false');
	$('.toggle').attr('aria-label', 'Menü öffnen');
	$('.toggle').removeClass('active');
}

function count_parents() {
  return $('.current').parents('.active').length;
}


// Menü ein-/ausblenden
$('#main-menu li.has-sub > a').on('click', function(e) {
  e.preventDefault();
  var element = $(this).parent('li');
  if (element.hasClass('open')) {
    element.removeClass('open');
    element.children('a').attr('aria-expanded', false);
    element.children('div').slideUp();
    element.children('ul').slideUp();
  } else { // Falls geschlossen.
    element.addClass('open');
    element.siblings('li').removeClass('open');
    element.children('a').attr('aria-expanded', true);
    element.siblings('li.has-sub').children('a').attr('aria-expanded', false);
    element.siblings('li').children('div').slideUp();
    element.siblings('li').children('ul').slideUp();
    element.children('div').slideDown();
    element.children('ul').slideDown();
  }
});




// Suchfeld öffnen.
$('.meta-search').click(function(e) {
  e.preventDefault();

  $(this).toggleClass('active');

  var search = $('.search-box');

  if (search.hasClass('open')) {
    search.removeClass('open').slideUp('fast');
  } else {
    search.addClass('open').slideDown('fast');
    $('.field').focus();
  }
});

// Zum Suchfeld springen.
$('.search-jump').click(function(e) {
  e.preventDefault();

  $('.search-box').addClass('open').slideDown('fast');
  $('.field').focus();
});

// Suchfeld schließen.
$('.btn-cancel').click(function() {
  $('.search-box').removeClass('open').slideUp('fast');
  $('.meta-search').removeClass('active').focus();
});

// Suchfeld mit Esc-Taste schließen.
$(document).on('keyup', function(e) {
  if (e.keyCode == 27 && $('.search-box').hasClass('open')) {
    $('.search-box.open .field').val('');
    $('.search-box').removeClass('open').slideUp('fast');
    $('.meta-search').removeClass('active').focus();
  }
});


$(function() {
  $(window).scroll(function() {
    // Show button for jumping to top when scrolling.
    var scroll = $(window).scrollTop();

    if (scroll > 150) {
      $('#btn-top').show();

    } else {
      $('#btn-top').hide();
    }
    //Add sticky class to body when scrolling
    if (scroll > 150) {
      $('html').addClass('sticky');

    } else {
      $('html').removeClass('sticky');
    }
  });
});
// Tabellen für Mobil
$(document).ready(function() {
	$('#content table').each(function(i) { // geht jede Tabelle der aktuellen Seite durch
		$(this).addClass('table-' + (i + 1));
		var currentTable = '.table-' + (i + 1);

		if ($(currentTable + ' thead').length) {
			$(currentTable + ' thead tr').children().each(function(index) {
				var tableText = $(this).text();
				$(currentTable + ' tbody td:nth-of-type(' + (index + 1) + ')').wrapInner('<p> </p>').prepend('<p class="res-thead">' + tableText + '</p>');
			});
		}
	});
});

// Google map.
$("a.gmap-overlay").click(function(e) {
  e.preventDefault();
  $(this).parent(".google-map").html("<iframe class=\"gmap-iframe\" src=\"" + $(this).attr("href") + "\"></iframe>");
});

$('.search-btn-1').keydown(function(e) {
    var code = e.keyCode || e.which;

    if (code === 9) {
        e.preventDefault();
				$('.search-box.open .field').val('');
		    $('.search-box').removeClass('open').slideUp('fast');
				$('.meta-search').focus();
    }
});

// Custom HTML5 validation for comments.
// $(document).ready(function() {
// 	$('#commentform').attr('novalidate', 'novalidate');
//
// 	const form = document.getElementsByTagName("form")["commentform"];
//
// 	const email = document.getElementById('email');
// 	const emailError = document.querySelector('#email + span.error');
//
// 	email.addEventListener('input', function (event) {
// 	  // Each time the user types something, we check if the
// 	  // form fields are valid.
// 	  if (email.validity.valid) {
// 	    // In case there is an error message visible, if the field
// 	    // is valid, we remove the error message.
// 	    emailError.innerHTML = ''; // Reset the content of the message
// 	    emailError.className = 'error'; // Reset the visual state of the message
// 	  } else {
// 	    // If there is still an error, show the correct error
// 	    showEmailError();
// 	  }
// 	});
//
// 	form.addEventListener('submit', function (event) {
// 	  // if the email field is valid, we let the form submit
//
// 	  if(!email.validity.valid) {
// 	    // If it isn't, we display an appropriate error message
// 	    showEmailError();
// 	    // Then we prevent the form from being sent by canceling the event
// 	    event.preventDefault();
// 	  }
// 	});
//
// 	function showEmailError() {
// 	  if(email.validity.valueMissing) {
// 	    // If the field is empty
// 	    // display the following error message.
// 	    emailError.textContent = 'Bitte füllen Sie das Feld "E-Mail" aus.';
// 	  } else if(email.validity.typeMismatch) {
// 	    // If the field doesn't contain an email address
// 	    // display the following error message.
// 	    emailError.textContent = 'Sie müssen eine E-Mail-Adresse eingeben.';
// 	  }
//
// 	  // Set the styling appropriately
// 	  emailError.className = 'error active';
// 	}
//
// 	const author = document.getElementById('author');
// 	const authorError = document.querySelector('#author + span.error');
//
// 	author.addEventListener('input', function (event) {
// 	  // Each time the user types something, we check if the
// 	  // form fields are valid.
//
// 	  if (author.validity.valid) {
// 	    // In case there is an error message visible, if the field
// 	    // is valid, we remove the error message.
// 	    authorError.innerHTML = ''; // Reset the content of the message
// 	    authorError.className = 'error'; // Reset the visual state of the message
// 	  } else {
// 	    // If there is still an error, show the correct error
// 	    showAuthorError();
// 	  }
// 	});
//
// 	form.addEventListener('submit', function (event) {
// 	  // if the author field is valid, we let the form submit
//
// 	  if(!author.validity.valid) {
// 	    // If it isn't, we display an appropriate error message
// 	    showAuthorError();
// 	    // Then we prevent the form from being sent by canceling the event
// 	    event.preventDefault();
// 	  }
// 	});
//
// 	function showAuthorError() {
// 	  if(author.validity.valueMissing) {
// 	    // If the field is empty
// 	    // display the following error message.
// 	    authorError.textContent = 'Bitte füllen Sie das Feld "Name" aus.';
// 	  }
//
// 	  // Set the styling appropriately
// 	  authorError.className = 'error active';
// 	}
// });
function activateVideo(object, single = false) {
  if (single) {
    var videourl = object.data('url') + '&autoplay=1';
    object.parent().siblings('iframe').attr('src', videourl);
  } else {
    object.each(function() {
      var videourl = jQuery(this).data('url');
      jQuery(this).parent().siblings('iframe').attr('src', videourl);
    });
  }
  object.parent().parent().css('margin-bottom', 0);
	object.parent().siblings('.overlay-img-video-gallery').hide();
  object.parent().hide();
}

function checkCookie() {
  if (hasCookieSplitVal('ww-cookies', 'youtube')) {
    activateVideo(jQuery('.js-start-youtube'));
  }
	if (hasCookieSplitVal('ww-cookies', 'vimeo')) {
    activateVideo(jQuery('.js-start-vimeo'));
  }
}

jQuery('.youtube-active').click(function() {
  if (jQuery(this).is(':checked')) {
		activateVideo(jQuery('.js-start-youtube'));
    addCookieSplitVal('ww-cookies', 'youtube', 30);
  }
});

jQuery('.js-start-youtube').click(function(e) {
  e.preventDefault();
  activateVideo(jQuery(this), true);
});

jQuery('.vimeo-active').click(function() {
  if (jQuery(this).is(':checked')) {
		activateVideo(jQuery('.js-start-vimeo'));
    addCookieSplitVal('ww-cookies', 'vimeo', 30);
  }
});

jQuery('.js-start-vimeo').click(function(e) {
  e.preventDefault();
  activateVideo(jQuery(this), true);
});

jQuery(document).ready(function() {
  checkCookie();
});
