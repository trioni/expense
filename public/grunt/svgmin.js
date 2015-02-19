module.exports = function( grunt ) {
    // Docs: https://github.com/sindresorhus/grunt-svgmin
    grunt.config( 'svgmin', {
        options: { // Configuration that will be passed directly to SVGO
            plugins: [
                { removeViewBox: false },
                { removeUselessStrokeAndFill: false }
            ]
        },
        dist: {                     // Target
            files: [{               // Dictionary of files
                expand: true,       // Enable dynamic expansion.
                cwd: 'img/svg/',     // Src matches are relative to this path.
                src: ['**/*.svg','!**/minified-svg/**'],  // Actual pattern(s) to match.
                dest: 'img/minified-svg/',       // Destination path prefix.
                ext: '.svg'     // Dest filepaths will have this extension.
                // ie: optimise img/src/branding/logo.svg and store it in img/branding/logo.min.svg
            }]
        }
    });

    grunt.loadNpmTasks('grunt-svgmin');
};