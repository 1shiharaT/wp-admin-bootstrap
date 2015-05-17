var gulp = require('gulp');
var browserSync = require('browser-sync');
var $ = require('gulp-load-plugins')();
var cp = require('child_process');
var sass = require('gulp-sass');
var prefix = require('gulp-autoprefixer');

// sass のコンパイル
gulp.task('sass', function () {
  return gulp.src('assets/scss/bootstrap.scss')
    .pipe($.plumber())
    .pipe(sass({
      includePaths: ['scss'],
      onError: browserSync.notify
    }))
    .pipe(prefix(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], {cascade: true}))
    .pipe(gulp.dest('assets/css'))
    .pipe($.rename({suffix: '.min'}))
    .pipe($.minifyCss({keepBreaks: false}))
    .pipe(gulp.dest('assets/css'))
    .pipe(browserSync.reload({stream: true}))
    .pipe($.notify({message: 'Styles task complete.'}));
});
// 管理画面用 sass の コンパイル
gulp.task('wpa-sass', function () {
  return gulp.src('assets/scss/wpa-bootstrap.scss')
    .pipe($.plumber())
    .pipe(sass({
      includePaths: ['scss'],
      onError: browserSync.notify
    }))
    .pipe(prefix(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], {cascade: true}))
    .pipe(gulp.dest('assets/css'))
    .pipe($.rename({suffix: '.min'}))
    .pipe($.minifyCss({keepBreaks: false}))
    .pipe(gulp.dest('assets/css'))
    .pipe(browserSync.reload({stream: true}))
    .pipe($.notify({message: 'Styles task complete.'}));
});

/**
 * Wait for jekyll-build, then launch the Server
 */
gulp.task('browser-sync', ['sass','wpa-sass'], function () {
  browserSync({
    server: {
      baseDir: ''
    }
  });
});

/**
 * Watch scss files for changes & recompile
 * Watch html/md files, run jekyll & reload BrowserSync
 */
gulp.task('watch', function () {
  gulp.watch('assets/scss/**/*.scss', ['sass','wpa-sass']);
});

gulp.task('default', ['browser-sync', 'watch']);
