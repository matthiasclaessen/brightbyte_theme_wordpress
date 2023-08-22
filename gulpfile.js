const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const babel = require('gulp-babel');
const concat = require('gulp-concat');
const browserSync = require('browser-sync').create();

const paths = {
    styles: {
        src: './source/scss/**/*.scss',
        dest: './build/css/'
    },
    scripts: {
        src: './source/scripts/**/*.js',
        dest: './build/js/'
    },
    php: '**/*.php'
}

// Compile Sass into CSS
function styles() {
    return gulp.src(paths.styles.src)
        .pipe(sass())
        .pipe(gulp.dest(paths.styles.dest))
        .pipe(browserSync.stream());
}

// Compile JavaScript
function scripts() {
    return gulp.src(paths.scripts.src)
        .pipe(babel())
        .pipe(concat('main.js'))
        .pipe(gulp.dest(paths.scripts.dest))
        .pipe(browserSync.stream());
}

// Watch for changes
function watch() {
    browserSync.init({
        proxy: 'http://localhost/base_theme_wordpress/',
        notify: false
    });

    gulp.watch(paths.styles.src, styles);
    gulp.watch(paths.scripts.src, scripts);
    gulp.watch(paths.php).on('change', browserSync.reload);
}

exports.default = watch;