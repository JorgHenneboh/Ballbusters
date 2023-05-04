const gulp          = require('gulp');
const browserSync   = require('browser-sync').create();
const $             = require('gulp-load-plugins')({
    pattern: ['!gulp-sass', 'gulp-*', 'gulp.*', '@*/gulp{-,.}*'], // the glob(s) to search for
    overridePattern: true
});
const autoprefixer  = require('autoprefixer');
const minimist      = require('minimist');
const sourcemaps    = require('gulp-sourcemaps');
const uglify = require('gulp-uglify-es').default;
const sass = require('gulp-sass')(require('node-sass'));

const knownOptions = {
  string: 'env',
  default: {
    env: process.env.NODE_ENV || 'production'
  }
};

const options = minimist(process.argv.slice(2), knownOptions);

const sassPaths = [
  'node_modules/foundation-sites/scss',
  'node_modules/motion-ui/src'
];

function swallowError(error) {
  // If you want details of the error in the console
  console.log(error.toString())
  this.emit('end')
}

// SASS Compiler + autoprefixer
function scss() {
  return gulp.src(['scss/layout.scss', 'scss/block.scss', 'scss/gutenberg.scss'])
    .pipe(sourcemaps.init())
    .pipe(sass({
        includePaths: sassPaths
      })
    .on('error', swallowError))
    .pipe($.postcss([autoprefixer()]))
    .pipe($.cssUrlencodeInlineSvgs())
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('css'))
    .pipe(browserSync.stream());
}

function concat_min_front() {
  return gulp.src(['css/layout.css', 'css/block.css'], { allowEmpty: true })
    .pipe(sourcemaps.init({loadMaps: true}))
    .pipe($.cleanCss())
    .on('error', swallowError)
    .pipe($.concat('frontend.min.css'))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('css'));
}

function concat_min_back() {
  return gulp.src(['css/gutenberg.css', 'css/block.css'], { allowEmpty: true })
    .pipe(sourcemaps.init({loadMaps: true}))
    .pipe($.cleanCss())
    .on('error', swallowError)
    .pipe($.concat('backend.min.css'))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('css'));
}

// JS Minify + rename to *.min.js
function minify_js() {
  return gulp.src(['js/*.js', '!js/*.min.js'], { allowEmpty: true })
    .pipe(sourcemaps.init())
		.pipe($.babel())
    .pipe(uglify())
    .on('error', swallowError)
    .pipe($.rename({
      suffix: '.min'
    }))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('js'));
};

// Browsersync reload
function reload(done) {
  browserSync.reload();
  done();
}

// Static Server + watching scss/html files
function serve() {
  if (options.env === 'wp') {
    browserSync.init({
      proxy: "localhost/webhenneboh"
    });
  } else if (options.env === 'nb') {
    // browserSync disabled
  } else {
    browserSync.init({
      server: {
        baseDir: "./html",
        directory: true,
        routes: {
          "/node_modules": "node_modules",
          "/js": "js",
          "/img": "img",
          "/css": "css"
        },
      }
    });
  }

  gulp.watch("./scss/*.scss", gulp.series(scss, gulp.parallel(concat_min_front, concat_min_back)));
  gulp.watch(["./js/*.js", "!./js/*.min.js"], minify_js);
  gulp.watch(["./html/*.html", "*.php", "./js/*.js", "!./js/*.min.js", "./css/*.css", "!./css/*.min.css"], reload);
}

// Tasks
gulp.task('default', gulp.series(scss, gulp.parallel(concat_min_front, concat_min_back, minify_js), serve));
