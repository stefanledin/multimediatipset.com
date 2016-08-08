var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.scripts([
    	'jquery.min.js',
    	'jquery-ui.min.js',
    	'materialize.min.js',
    	'vue.js',
    	'app.js'
	])
	.styles([
		'materialize.css',
        'admin.css',
        'app.css'
	]);
    mix.version(['css/all.css', 'js/all.js']);
});
