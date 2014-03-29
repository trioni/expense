module.exports = function( grunt ) {
    grunt.config( 'uglify', {
        options: {
            preserveComments: false,
            mangle: true
        },
        dist: {
            files: {
                'js/dist/<%= pkg.name %>.min.js': [
                    'bower_components/bootstrap/dist/js/bootstrap.min.js',
                    'bower_components/fastclick/lib/fastclick.js',
                    'bower_components/typeahead.js/dist/typeahead.bundle.min.js',
                    'js/Autocomplete.js',
                    'js/Validator.js',
                    'js/scripts.js'
                ]
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
};

