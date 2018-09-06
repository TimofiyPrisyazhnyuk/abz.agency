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
/******/ 	return __webpack_require__(__webpack_require__.s = 24);
/******/ })
/************************************************************************/
/******/ ({

/***/ 24:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(25);


/***/ }),

/***/ 25:
/***/ (function(module, exports) {

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(document).ready(function () {
  bossUpdate();
});
$(document).on('change', '#position_id', function () {
  bossUpdate();
});

function bossUpdate() {
  var positionId = $('#position_id').val();
  var boss = $('#boss_id');

  boss.find('option').remove();
  console.log($('#parentBoss').val());

  $.ajax({
    type: "POST",
    url: '/staff_list/boss',
    data: { 'position_id': positionId },

    success: function success(data) {
      if (data.length === 0) {
        boss.append('<option value="null" selected="" disabled="">Boss Name</option>');
      } else {
        for (var i = 0; i < data.length; i++) {
          if (data[i].id == $('#parentBoss').val()) {
            boss.append('<option selected value="' + data[i].id + '" >' + (data[i].surname + ' ' + data[i].first_name + ' ' + data[i].patronymic).slice(0, 14) + '...' + '</option>');
          } else {
            boss.append('<option value="' + data[i].id + '" >' + (data[i].surname + ' ' + data[i].first_name + ' ' + data[i].patronymic).slice(0, 14) + '...' + '</option>');
          }
        }
      }
      // console.log($('#parentBoss').val());
    }
  });
}

/***/ })

/******/ });