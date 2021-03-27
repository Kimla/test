module.exports = {
    plugins: [
        require('postcss-import'),
        require('postcss-preset-env')({
            stage: 0,
            preserve: false,
            importFrom: 'resources/css/variables.css',
            features: {
                'custom-properties': false
            }
        }),
        require('postcss-calc')(),
        require('tailwindcss'),
        require('autoprefixer')
    ]
}
;
