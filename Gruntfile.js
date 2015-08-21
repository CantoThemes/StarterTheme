module.exports = function(grunt) {
  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    less: {
      cssDist: {
        options: {
          banner: '',
          compress: false,
          sourceMap: true,
          sourceMapFilename: '_temp/style.css.map',
          sourceMapURL: '_temp/style.css.map'
        },
        files: {
          'style.css': 'less/style.less'
        }
      }
    },
    
  	autoprefixer: {
      options: {
          map: {
              inline: false
          }
      },
  		single_file: {
  			src: 'style.css',
        dest: 'style.css'
  		}
  	},

    copy: {
      fonts: {
        expand: true,
        flatten: true,
        src: '_temp/style.css.map',
        dest: '/',
        filter: 'isFile'
      }
    },

    watch: {
      less: {
        files: ['less/**/*.less'],
        tasks: ['less', 'autoprefixer', 'copy'],
        options: {
          livereload: true
        }
      }
    }

  });
  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-autoprefixer');
  // Default task(s).
  
  grunt.registerTask('lesscss', ['less', 'autoprefixer', 'copy']);
  grunt.registerTask('autosys', [ 'watch' ]);

  grunt.registerTask('default', ['lesscss']);
};