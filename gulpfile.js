var gulp = require('gulp');
var concat = require('gulp-concat');
var minify = require('gulp-minify');
var gulpCopy = require('gulp-copy');

function createJavascript(){
    gulp.src([
        './includes/vendor/jquery/dist/jquery.js'
    ])
    .pipe(gulpCopy('./js/', {prefix: 100}));
    
    gulp.src([
        './includes/js/rwdImageMaps.js',
        './includes/js/maphighlight.js',
        './includes/js/uk-map.js'
    ])
    .pipe(concat('uk-map.js'))
    .pipe(minify({
        ext:{
            min: '.min.js'
        },
        mangle: true
    }))
    .pipe(gulp.dest('./js/'));
}

gulp.task('default', function(){
    createJavascript();
});
