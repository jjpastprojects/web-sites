var gulp = require('gulp');
var minifyCSS = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var sass = require('gulp-sass');
var rename = require('gulp-rename');

var assets_dir = 'resources/assets/';

var sass_dir = assets_dir+'sass/';
var acp_sass_dir = assets_dir+'sass/acp/';
var site_sass_dir = assets_dir+'sass/site/';

var js_dir = assets_dir+'js/';
var acp_js_dir = js_dir+'acp/';
var site_js_dir = js_dir+'site/';

var public_dir = 'public/';
var public_js_dir = public_dir+'js/';
var public_css_dir = public_dir+'css/';

var site_js_files = [
    'bower_components/jquery/dist/jquery.min.js',
    'bower_components/jquery-ui/ui/jquery-1-7.js',
    'bower_components/jquery-ui/ui/widgets/datepicker.js',
    'bower_components/bootstrap/dist/js/bootstrap.min.js',
    'resources/assets/js/site/*.js',
];

var acp_js_files = [
    'bower_components/jquery/dist/jquery.js',
    'bower_components/vue/dist/vue.js',
    'bower_components/vue-resource/dist/vue-resource.js',
    'resources/assets/js/acp/*.js',
];

var site_css_files = [
    'bower_components/bootstrap/dist/css/bootstrap.min.css',
    'bower_components/bootstrap/dist/css/bootstrap-theme.css',
    'bower_components/jquery-ui/themes/base/all.css',
    'bower_components/jquery-ui/themes/base/datepicker.css',
    'bower_components/font-awesome/css/font-awesome.min.css',
    'resources/assets/css/app.css',
    ];

var acp_css_files = [
    'node_modules/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/font-awesome/css/font-awesome.min.css',
    'node_modules/select2/dist/css/select2.min.css',
    'resources/assets/css/acp.css',
    ];

var files_to_copy = [] ;

files_to_copy.push(['bower_components/bootstrap/fonts/*', 'public/fonts']);
files_to_copy.push(['bower_components/font-awesome/fonts/*', 'public/fonts']);

gulp.task('copy', function(){
    files_to_copy.map(function(file){
        gulp.src(file[0])
        .pipe(gulp.dest(file[1]));
    });
});

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
    gulp.src(site_js_files)
    .pipe(concat('app.js'))
    .pipe(gulp.dest(public_js_dir));
});

gulp.task('acp_js', function(){
    gulp.src(acp_js_files)
    .pipe(concat('acp.min.js'))
    .pipe(gulp.dest(public_js_dir));
});

gulp.task('site_sass', function () {
  gulp.src(site_sass_dir+'app.scss')
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


gulp.task('watch_acp_sass', function () {
  gulp.watch(acp_sass_dir+'**/*.scss', ['acp_sass', 'acp_css']);
});

gulp.task('watch_acp_js', function(){
    gulp.watch(acp_js_dir+'**/*.js', ['acp_js']);
});

gulp.task('watch', ['sass:watch']);

gulp.task('default', ['sass', 'css','js', 'watch']);
