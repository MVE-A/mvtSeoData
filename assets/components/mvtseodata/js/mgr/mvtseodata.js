var mvtSeoData = function (config) {
    config = config || {};
    mvtSeoData.superclass.constructor.call(this, config);
};
Ext.extend(mvtSeoData, Ext.Component, {
    page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('mvtseodata', mvtSeoData);

mvtSeoData = new mvtSeoData();