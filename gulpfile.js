// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var jshint = require('gulp-jshint');
var less = require('gulp-less');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');

// Source and distribution paths

var src = 'resources/assets/';
var dest = 'public/assets/';

// Lint Task
gulp.task('lint', function () {
    return gulp.src(src+'js/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default'));
});

// Compile less
gulp.task('less', function () {
    return gulp.src(src+'less/*.less')
        .pipe(less())
        .pipe(gulp.dest(dest+'css'));
});

// Concatenate & Minify JS
gulp.task('scripts', function() {
    return gulp.src(src+'js/*.js')
        .pipe(concat('all.js'))
        .pipe(gulp.dest(dest))
        .pipe(rename('all.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(dest+'js'));
});

// Watch Files For Changes
gulp.task('watch', function() {
    gulp.watch(src+'js/*.js', ['lint', 'scripts']);
    gulp.watch(src+'less/*.less', ['less']);
});

// Default Task
gulp.task('default', ['lint', 'less', 'scripts', 'watch']);
