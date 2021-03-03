mvtSeoData.page.Home = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        components: [{
            xtype: 'mvtseodata-panel-home',
            renderTo: 'mvtseodata-panel-home-div'
        }]
    });
    mvtSeoData.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(mvtSeoData.page.Home, MODx.Component);
Ext.reg('mvtseodata-page-home', mvtSeoData.page.Home);