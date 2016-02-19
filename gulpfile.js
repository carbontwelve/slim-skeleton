// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var jshint = require('gulp-jshint');
var less = require('gulp-less');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var imagemin = require('gulp-imagemin');
var cache = require('gulp-cache');

// Source and distribution paths

var paths = {
    src: 'resources/assets/',
    dest: 'public/assets/',
    tmp: 'resources/.tmp/'
};

// Lint Task
gulp.task('lint', function () {
    return gulp.src(paths.src+'js/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default'));
});

// Compile less
gulp.task('less', function () {
    return gulp.src(paths.src+'less/*.less')
        .pipe(less())
        .pipe(gulp.dest(paths.dest+'css'));
});

// Optomise and publish images
gulp.task('images', function(){
    return gulp.src(paths.src+'img/**/*')
        .pipe(cache(imagemin({ optimizationLevel: 5, progressive: true, interlaced: true })))
        .pipe(gulp.dest(paths.dest+'img'));
});

// Concatenate & Minify JS
gulp.task('scripts', function() {
    return gulp.src(paths.src+'js/*.js')
        .pipe(concat('all.js'))
        .pipe(gulp.dest(paths.dest+'js'))
        .pipe(rename({suffix: '.min'}))
        .pipe(uglify())
        .pipe(gulp.dest(paths.dest+'js'));
});

// Watch Files For Changes
gulp.task('watch', function() {
    gulp.watch(paths.src+'js/*.js', ['lint', 'scripts']);
    gulp.watch(paths.src+'less/*.less', ['less']);
    gulp.watch(paths.src+'img/**/*', ['images']);
});

// Default Task
gulp.task('default', ['lint', 'less', 'scripts', 'images', 'watch']);
