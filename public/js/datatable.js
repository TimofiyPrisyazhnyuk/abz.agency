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
/******/ 	return __webpack_require__(__webpack_require__.s = 21);
/******/ })
/************************************************************************/
/******/ ({

/***/ 21:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(22);


/***/ }),

/***/ 22:
/***/ (function(module, exports) {

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(document).ready(function () {

  var dataTable = $('#myTable').on('preXhr.dt', function (e, settings, data) {}).DataTable({
    serverSide: true,
    searchDelay: 700,
    // responsive: true,
    pageLength: 10,
    scrollX: true,
    scrollY: false,
    autoWidth: false,
    // columnDefs: [
    //     { orderable: false, targets: -2, },
    //     { orderable: false, targets: -1, }
    // ],
    ajax: {
      url: '/staff_list',
      type: 'POST'
    },
    columns: [{
      title: 'ID',
      data: 'id',
      className: 'text-center'
    }, {
      title: 'Image',
      className: 'text-center',
      render: function render(s, d, item) {
        if (item.image) {
          return '<img src="image_upload/' + item.image + '" class="app-list-image" alt="user" >';
        } else {
          return '<img src="/img/default.png" class="app-list-image" alt="user" >';
        }
      }
    }, {
      title: 'Surname',
      data: 'surname',
      className: 'text-center'
    }, {
      title: 'First name',
      data: 'first_name',
      className: 'text-center'
    }, {
      title: 'Patronymic',
      data: 'patronymic',
      className: 'text-center'
    }, {
      title: 'Email',
      data: 'email',
      className: 'text-center'
    }, {
      title: 'Date engagement',
      data: 'date_engagement',
      className: 'text-center'
    }, {
      title: 'Amount of wages',
      data: 'amount_of_wages',
      className: 'text-center'
    }, {
      title: 'Position',
      className: 'text-center',
      render: function render(s, d, item) {
        return item.position.position_name;
      }
    }, {
      title: 'Control',
      className: 'text-center',
      render: function render(s, d, item) {
        return ' <a href="/staff_list/' + item.id + '" class="btn btn-info btn-xs"><i class="fa fa-eye fa-2x"></i></a>' + ' <a href="/staff_list/' + item.id + '/edit" class="btn btn-warning btn-xs" ><i class="fa fa-edit fa-2x"></i></a>' + '<a href="#" class="btn  btn-xs">' + '<form id="userDelete"  action="/staff_list/' + item.id + '" method="POST">' + '   <input type="hidden" name="_method" value="delete" />' + '   <input type="hidden" name="_token" value="' + document.getElementsByName('csrf-token')[0].content + '">' + '   <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-close fa-2x"></i></button>' + '</form>' + '</a>';
      }
    }]
  });
  $(window).resize(function () {
    dataTable.ajax.reload();
  });
});

/***/ })

/******/ });