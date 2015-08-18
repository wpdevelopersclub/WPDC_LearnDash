var gulp = require('gulp'),
    notify = require('gulp-notify'),
    sass = require('gulp-ruby-sass'),
    uglify = require('gulp-uglify'),
    concat = require('gulp-concat');

gulp.task('js', function() {
    gulp.src('assets/js/*.js')
        .pipe(concat('jquery.plugin.min.js'))
        .pipe(uglify({ preserveComments: 'some' }))
        .pipe(gulp.dest('assets/build'))
        .pipe(notify({ message: 'Scripts are updated' }));
});

gulp.task('sass', function(){
    return sass('assets/sass/style.scss', { style: 'compressed' })
        .pipe(concat('plugin.min.css'))
        .pipe(gulp.dest('assets/build'))
        .pipe(notify({ message: 'Styles are updated' }));
});

gulp.task('watch', function(){
    gulp.watch('assets/sass/**/*.scss', ['sass']);
    gulp.watch('assets/js/*.js', ['js']);
});

gulp.task('default', ['js', 'sass', 'watch']);