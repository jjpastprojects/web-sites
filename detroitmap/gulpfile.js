/**
 * Created by georgi k on 27/09/15.
 */
var gulp = require('gulp');
var concat = require('gulp-concat');

gulp.task('default',['scripts_application', 'scripts_library', 'sass']);

// create application.js file\
gulp.task('scripts_application', function() {
  return gulp.src(['angular-init.js', './assets/**/*.js'], {newLine: ';'})
    .pipe(concat('application.js'))
    .pipe(gulp.dest('./public/js/'));
});

// create library.js file
gulp.task('scripts_library', function() {
  return gulp.src([
    './libs/angular/1.4.6/angular.min.js',
    './libs/angular-bootstrap/0.13.4/ui-bootstrap.min.js',
    './libs/angular-bootstrap/0.13.4/ui-bootstrap-tpls.min.js',
    './libs/angular-ui-router/0.2.15/angular-ui-router.min.js',
    './libs/ngstorage/0.3.9/ngStorage.min.js',
    './libs/underscore/1.8.3/underscore-min.js',
    './libs/underscore.string/3.2.2/underscore.string.min.js',
    //'./libs/angular-google-maps/2.2.1/angular-google-maps.min.js'
  ], {newLine: ';'})
    .pipe(concat('library.js'))
    .pipe(gulp.dest('./public/js/'));
});

var sass = require('gulp-sass');

gulp.task('sass', function () {
  gulp.src('./assets/stylesheets/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./public/stylesheets'));
});