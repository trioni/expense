module.exports = function( grunt ) {
    grunt.config('autoprefixer', {
        dist: {
            files: {
                'styles/css/style.css': 'styles/css/style.css'
            }
        }
    });

    grunt.loadNpmTasks('grunt-autoprefixer');
};