var gulp = require('gulp');
var minifyCSS = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var sass = require('gulp-sass');
var rename = require('gulp-rename');


var assets_dir = 'resources/assets/';

var sass_dir = assets_dir+'sass/';
var acp_sass_dir = assets_dir+'sass/acp';
var site_sass_dir = assets_dir+'sass/acp';

var js_dir = assets_dir+'js/';
var acp_js_dir = assets_dir+'js/';
var site_js_dir = assets_dir+'js/';

var public_dir = 'public/';
var public_js_dir = public_dir+'js/';
var public_css_dir = public_dir+'css/';

var js_files = [
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js',
    'node_modules/select2/dist/js/select2.min.js',
    'node_modules/vue/dist/vue.js',
    'resources/assets/js/app.js',
];

var acp_js_files = [
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js',
    'node_modules/select2/dist/js/select2.min.js',
    'node_modules/vue/dist/vue.js',
    'resources/assets/js/acp/*',
];

var site_css_files = [
    'node_modules/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/font-awesome/css/font-awesome.min.css',
    'node_modules/select2/dist/css/select2.min.css',
    'resources/assets/css/app.css',
    ];

var acp_css_files = [
    'node_modules/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/font-awesome/css/font-awesome.min.css',
    'node_modules/select2/dist/css/select2.min.css',
    'resources/assets/css/acp.css',
    ];


gulp.task('site_css', function(){
    gulp.src(site_css_files)
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9'))
    .pipe(concat('app.css'))
    .pipe(gulp.dest(public_css_dir));
});

gulp.task('acp_css', function(){
    gulp.src(acp_css_files)
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9'))
    .pipe(concat('acp.min.css'))
    .pipe(gulp.dest(public_css_dir));
});


gulp.task('site_js', function(){
    gulp.src(js_files)
    .pipe(concat('app.min.js'))
    .pipe(gulp.dest(public_js_dir));
});

gulp.task('acp_js', function(){
    gulp.src(js_files)
    .pipe(concat('acp.min.js'))
    .pipe(gulp.dest(public_js_dir));
});

gulp.task('site_sass', function () {
  gulp.src(sass_dir+'app.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(rename('app.css'))
    .pipe(gulp.dest('resources/assets/css/'));
});

gulp.task('acp_sass', function () {
  gulp.src(acp_sass_dir+'/acp.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(rename('acp.css'))
    .pipe(gulp.dest('resources/assets/css/'));
});

gulp.task('sass:watch', function () {
  gulp.watch(sass_dir+'**/*.scss', ['sass', 'css']);
});

gulp.task('watch', ['sass:watch']);

gulp.task('default', ['sass', 'css','js', 'watch']);
