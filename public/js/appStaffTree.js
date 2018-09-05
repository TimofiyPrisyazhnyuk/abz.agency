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
__webpack_require__(14);
__webpack_require__(15);
__webpack_require__(16);
__webpack_require__(17);
__webpack_require__(18);
__webpack_require__(19);
module.exports = __webpack_require__(20);


/***/ }),
/* 11 */
/***/ (function(module, __webpack_exports__) {

"use strict";
// Old tree Users react

// import React from "react";
// import ReactDOM from "react-dom";
//
// import Tree from "./components/TreeIndex";
//
// ReactDOM.render(
//     <Tree/>,
//     document.getElementById('staffTree')
// );


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
        }
      });
    }
  });

  /**     *  Create start tree users 1 and 2 positions     */
  function createTreeComponentUser(user) {
    var childrenItems = [];

    user.map(function (items) {
      return childrenItems.push({
        "text": [items.surname, items.position_id, items.id],
        "id": items.id,
        "children": []
      });
    });
    return childrenItems;
  }

  /**     *  Add new node under parent     */
  container.on("click", function (event) {
    var targetUserId = $(event.target).closest('.jstree-node').attr('id');

    // if (targetUserId !== '1') {
    $.ajax({
      type: "GET",
      url: "/staff_tree/" + targetUserId,
      data: JSON.stringify({}),
      success: function success(data) {
        if (data.length) {
          if (!container.jstree(true).get_node(data[0].child_users.id)) {
            data.map(function (item) {
              container.jstree().create_node(item.user_parent_id, {
                "text": [item.child_users.surname, item.child_users.position_id, item.child_users.id],
                "id": item.child_users.id
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
    return path_image ? path_image : 'img/default.png';
  }
});

/***/ }),
/* 12 */,
/* 13 */,
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

/***/ }),
/* 20 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);