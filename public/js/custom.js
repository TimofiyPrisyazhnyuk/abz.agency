/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 456);
/******/ })
/************************************************************************/
/******/ ({

/***/ 456:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(457);


/***/ }),

/***/ 457:
/***/ (function(module, exports) {

/*Author URI: http://webthemez.com/Note:Licence under Creative Commons Attribution 3.0Do not remove the back-link in this web template-------------------------------------------------------*/

$(document).ready(function () {
  $('#header_wrapper').scrollToFixed();
  $('.res-nav_click').click(function () {
    $('.main-nav').slideToggle();
    return false;
  });

  function resizeText() {
    var preferredWidth = 767;
    var displayWidth = window.innerWidth;
    var percentage = displayWidth / preferredWidth;
    var fontsizetitle = 25;
    var newFontSizeTitle = Math.floor(fontsizetitle * percentage);
    $(".divclass").css("font-size", newFontSizeTitle);
  }
  if ($('#main-nav ul li:first-child').hasClass('active')) {
    $('#main-nav').css('background', 'none');
  }
  $('#mainNav').onePageNav({
    currentClass: 'active',
    changeHash: false,
    scrollSpeed: 950,
    scrollThreshold: 0.2,
    filter: '',
    easing: 'swing',
    begin: function begin() {},
    end: function end() {
      if (!$('#main-nav ul li:first-child').hasClass('active')) {
        $('.header').addClass('addBg');
      } else {
        $('.header').removeClass('addBg');
      }
    },
    scrollChange: function scrollChange($currentListItem) {
      if (!$('#main-nav ul li:first-child').hasClass('active')) {
        $('.header').addClass('addBg');
      } else {
        $('.header').removeClass('addBg');
      }
    }
  });

  var container = $('#portfolio_wrapper');

  container.isotope({
    animationEngine: 'best-available',
    animationOptions: {
      duration: 200,
      queue: false
    },
    layoutMode: 'fitRows'
  });

  $('#filters a').click(function () {
    $('#filters a').removeClass('active');
    $(this).addClass('active');
    var selector = $(this).attr('data-filter');
    container.isotope({
      filter: selector
    });
    setProjects();
    return false;
  });

  function splitColumns() {
    var winWidth = $(window).width(),
        columnNumb = 1;

    if (winWidth > 1024) {
      columnNumb = 4;
    } else if (winWidth > 900) {
      columnNumb = 2;
    } else if (winWidth > 479) {
      columnNumb = 2;
    } else if (winWidth < 479) {
      columnNumb = 1;
    }

    return columnNumb;
  }

  function setColumns() {
    var winWidth = $(window).width(),
        columnNumb = splitColumns(),
        postWidth = Math.floor(winWidth / columnNumb);

    container.find('.portfolio-item').each(function () {
      $(this).css({
        width: postWidth + 'px'
      });
    });
  }

  function setProjects() {
    setColumns();
    container.isotope('reLayout');
  }

  container.imagesLoaded(function () {
    setColumns();
  });

  $(window).bind('resize', function () {
    setProjects();
  });
});

wow = new WOW({
  animateClass: 'animated',
  offset: 100
});
wow.init();
// document.getElementById('').onclick = function() {
//     var section = document.createElement('section');
//     section.className = 'wow fadeInDown';
//     section.className = 'wow shake';
//     section.className = 'wow zoomIn';
//     section.className = 'wow lightSpeedIn';
//     this.parentNode.insertBefore(section, this);
// };

/***/ })

/******/ });