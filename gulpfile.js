//const elixir = require('laravel-elixir');

//require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

// elixir(mix => {
//     mix.sass('app.scss')
//        .webpack('app.js');
// });

var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglifycss = require('gulp-uglifycss');

var DIR_ASSETS = './resources/assets';
var DIR_CSS = DIR_ASSETS + '/css';
var CSS_FILES = DIR_CSS + '/app.scss';
var CSS_OUTPUT = './public/assets/css';

gulp.task('css', function() {
        gulp.src(CSS_FILES)
                .pipe(sass())
                .pipe(concat('app.css'))
                .pipe(gulp.dest(CSS_OUTPUT))
                .pipe(rename({
                        suffix: '.min'
                }))
                .pipe(uglifycss({
                        // maxLineLen: 160
                }))
                .pipe(gulp.dest(CSS_OUTPUT));
});

gulp.task('watch', function() {
        console.log(CSS_FILES);
        gulp.watch(CSS_FILES, ['css']);        
});

gulp.task('default', ['watch', 'css']);
