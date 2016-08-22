// Gulp
var gulp = require('gulp');

// SCSS
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var minifycss = require('gulp-minify-css');
var rename = require('gulp-rename');

// React
var browserify = require('browserify');
var babelify = require('babelify');
var source = require('vinyl-source-stream');

// Paths
var scssSource       = './resources/styles/**/*.scss';
var cssDestination   = './public/css/';

// Styles task (SCSS)
gulp.task('styles', function() {
    return gulp.src(scssSource)
               .pipe(sass({ errLogToConsole: true }))
               .pipe(autoprefixer('last 2 versions', 'ie 9', 'ios 6', 'android 4'))
               .pipe(gulp.dest(cssDestination))
               .pipe(rename({ suffix: '.min' }))
               .pipe(minifycss())
               .pipe(gulp.dest(cssDestination));
});

// React task
gulp.task('react', function() {
    return browserify('./resources/react/index.jsx', {extensions: ['.js', '.jsx']})
            .transform(babelify, {presets: ['es2015', 'react']})
            .bundle()
            .pipe(source('bundle.js'))
            .pipe(gulp.dest('./public/js/'));
});

// Watch gulp task
gulp.task('watch', function() {
    return gulp.watch(
        [scssSource, './resources/react/*.jsx'], // Watch these directories
        ['styles', 'react'] // Run these commands
    );
});

// Default gulp task
gulp.task('default', ['styles', 'react']);
