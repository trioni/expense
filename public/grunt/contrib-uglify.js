module.exports = function( grunt ) {
    grunt.config( 'uglify', {
        options: {
            preserveComments: false,
            mangle: false
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
        },
        angular: {
            files: {
                'js/dist/<%= pkg.name %>.app.min.js': [
                    'bower_components/angular/angular.min.js',
                    'bower_components/angular-route/angular-route.js',
                    'bower_components/angular-google-chart/ng-google-chart.js',
                    'js/lib/ui-bootstrap-custom-0.12.0.js',
                    'js/lib/ui-bootstrap-custom-tpls-0.12.0.js',
                    'js/app/app.js',
                    'js/app/filters.js',
                    'js/app/directives.js',
                    'js/app/message.js',
                    'js/app/main-navigation.js',
                    'js/app/factories.js',
                    'js/app/controllers.js',
                    'js/app/edit.js',
                    'js/app/create.js',
                    'js/app/statistics.js',
                    'js/app/filter.js'
                ]
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
};

