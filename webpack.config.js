const Encore = require('@symfony/webpack-encore');

Encore
	.setOutputPath('web/build/')
	.setPublicPath('/web')
	.cleanupOutputBeforeBuild()
	.enableSourceMaps(!Encore.isProduction())
	.enableSassLoader()
	.enableBuildNotifications()
	.addEntry('js/app', './assets/js/index.js')
	.addStyleEntry('css/style', './assets/scss/style.scss')
	.autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();