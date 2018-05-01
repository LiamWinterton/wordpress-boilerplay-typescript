var gulp = require('gulp');
var download = require('gulp-download');

gulp.task('download-wordpress', function() {
    return download("https://wordpress.org/latest.zip")
        .pipe(gulp.dest('./'));
});