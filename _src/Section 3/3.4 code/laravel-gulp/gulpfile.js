var gulp = require('gulp');
var exec = require('child_process').exec;

gulp.task('deploy', function (cd) {
    exec('scp -r /Applications/MAMP/htdocs/laravel-gulp jamesdme@jamesd.me:~/public_html/laravel-deployment', function (err, stdout, stderr) {
        console.log(stdout);
        console.log(stderr);
        cd(err);
    });
});
