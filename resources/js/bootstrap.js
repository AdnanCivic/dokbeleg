window._ = require('lodash');

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    require('bootstrap/dist/js/bootstrap.js');
    require('bootstrap/dist/css/bootstrap.css');
    require('summernote/dist/summernote-bs4.js');
    require('summernote/dist/summernote-bs4.css');
} catch (e) {}

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
