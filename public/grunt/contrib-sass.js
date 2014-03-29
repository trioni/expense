module.exports = function( grunt ) {
    grunt.config( 'sass', {
        dev: {
            options: {
                style: 'compressed', // compact / expanded / nested
                sourcemap: false

            },
            files: {
                'styles/css/style.css': 'styles/scss/style.scss'
            }
        },
        dist: {
            options: {
                style: 'compressed'
            },
            files: {
                'styles/css/style.css': 'styles/scss/style.scss'
            }
        }
    } );
};