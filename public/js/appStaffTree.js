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
/******/ 	return __webpack_require__(__webpack_require__.s = 10);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */,
/* 1 */,
/* 2 */,
/* 3 */,
/* 4 */,
/* 5 */,
/* 6 */,
/* 7 */,
/* 8 */,
/* 9 */,
/* 10 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(11);
__webpack_require__(12);
__webpack_require__(13);
__webpack_require__(14);
__webpack_require__(15);
__webpack_require__(16);
__webpack_require__(17);
__webpack_require__(18);
module.exports = __webpack_require__(19);


/***/ }),
/* 11 */
/***/ (function(module, exports) {

$(function () {
  // Container tree users
  var container = $('#staffTree');

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  /**     * Get tree users from database from start download     */
  $.ajax({
    type: "POST",
    url: '/staff_tree',
    data: JSON.stringify({}),
    success: function success(data) {
      container.jstree({
        'core': {
          'check_callback': true,
          'data': createTreeComponentUser(data)
          // "plugins" : [ "search", "dnd" ],
        } });
    }
  });

  /**     *  Create start tree users 1 pisition     */
  function createTreeComponentUser(user) {
    var childrenItems = [];

    user.map(function (items) {
      return childrenItems.push({
        "icon": checkIfImage(items.image),
        "text": ['<div class="app-right"><b class="app-badge-name">Name: ' + items.surname + ' ' + items.first_name + ' ' + items.patronymic + '</b>', '<b class="app-badge-posit">Position: ' + items.position.position_name + '</b>', '<br><b class="app-badge-date">Date Enagement: ' + items.date_engagement + '</b>', '<b class="app-badge-salary">Salary: ' + items.amount_of_wages + ' UAN</b></div>'],
        "id": items.id
      });
    });
    return childrenItems;
  }

  /**     *  Add new node under parent     */
  container.on("click", function (event) {
    var targetUserId = $(event.target).closest('.jstree-node').attr('id');

    $.ajax({
      type: "GET",
      url: "/staff_tree/" + targetUserId,
      data: JSON.stringify({}),
      success: function success(data) {
        if (data.length) {
          if (!container.jstree(true).get_node(data[0].child_users.id)) {
            data.map(function (items) {
              container.jstree().create_node(items.user_parent_id, {
                "icon": checkIfImage(items.child_users.image),
                "text": ['<div class="app-right"><b class="app-badge-name">Name: ' + items.child_users.surname + ' ' + items.child_users.first_name + ' ' + items.child_users.patronymic + '</b>', '<b class="app-badge-posit">Position: Worker Level ' + items.child_users.position_id + '</b>', '<br><b class="app-badge-date">Date Enagement: ' + items.child_users.date_engagement + '</b>', '<b class="app-badge-salary">Salary: ' + items.child_users.amount_of_wages + ' UAN</b></div>'],
                "id": items.child_users.id
              }, "last");
            });
          }
        }
      }
    });
    // }
  });

  /**     * Check user have own image or show default     *     * @param path_image     * @returns {*}     */
  function checkIfImage(path_image) {
    return path_image ? '/image_upload/' + path_image : '/img/default.png';
  }
});

/***/ }),
/* 12 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 13 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 14 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 15 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 16 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 17 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 18 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 19 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);