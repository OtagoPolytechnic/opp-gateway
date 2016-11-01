var source = require('vinyl-source-stream');
var gulp = require('gulp');
var gutil = require('gulp-util');
var browserify = require('browserify');
var reactify = require('reactify');
var babelify = require('babelify');
var watchify = require('watchify');
var notify = require('gulp-notify');
var rename = require('gulp-rename');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var minifycss = require('gulp-minify-css');

var paths = {
    sassFiles: './resources/styles/**/*.scss',
    reactSource: './resources/react/',
    reactEntry: './resources/react/index.jsx',
    cssDest: './public/css/',
    jsDest: './public/js/',
};

function handleErrors() {
    var args = Array.prototype.slice.call(arguments);

    notify.onError({
        title: 'Compile Error',
        message: '<%= error.message %>'
    }).apply(this, args);

    this.emit('end'); // Keep gulp from hanging on this task
}

function buildScript(watch) {
    var props = {
        entries: [paths.reactEntry],
        extensions: ['.js', '.jsx'],
        debug: true,
        transform: [babelify, reactify]
    };

    // watchify() if watch requested, otherwise run browserify() once 
    var bundler = watch ? watchify(browserify(props)) : browserify(props);

    function rebundle() {
        var stream = bundler.bundle();
        
        return stream
            .on('error', handleErrors)
            .pipe(source('bundle.js'))
            .pipe(gulp.dest(paths.jsDest))
            .pipe(notify('React build complete'));
    }

    // listen for an update and run rebundle
    bundler.on('update', function() {
        rebundle();
        gutil.log('Rebundle...');
    });

    // run it once the first time buildScript is called
    return rebundle();
}

gulp.task('sass', function() {
    return gulp.src(paths.sassFiles)
               .pipe(sass({ errLogToConsole: true }))
               .pipe(autoprefixer('last 2 versions', 'ie 9', 'ios 6', 'android 4'))
               .pipe(gulp.dest(paths.cssDest))
               .pipe(rename({ suffix: '.min' }))
               .pipe(minifycss())
               .pipe(gulp.dest(paths.cssDest));
});

// run once
gulp.task('react', function() {
    return buildScript(false);
});

// run 'scripts' task first, then watch for future changes
gulp.task('default', ['react', 'sass'], function() {
    gulp.watch(paths.sassFiles, ['sass']);
    return buildScript(true);
});
