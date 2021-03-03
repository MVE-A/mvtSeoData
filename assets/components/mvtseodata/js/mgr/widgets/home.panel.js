mvtSeoData.panel.Home = function (config) {
    config = config || {};
	
	var tabs = [
		{
			title: _('mvtseodata_common_templates'),
			layout: 'anchor',
			items: [{
				xtype: 'mvtseodata-grid-common-templates',
				cls: 'main-wrapper',
			}]
		} ,	{
			title: _('mvtseodata_resource_templates'),
			layout: 'anchor',
			items: [{
				xtype: 'mvtseodata-resource-templates',
				cls: 'main-wrapper',
			}],
			/*listeners:{
				'activate':{
					fn:function(tab) {
						Ext.getCmp('mvtseodata-grid-resource-tepmplates'). store.reload();
					}
				}
			}*/
		} , {
			title: _('mvtseodata_index'),
			layout: 'anchor',
			items: [{
				xtype: 'mvtseodata-form-index',
				cls: 'main-wrapper',
			}]
		}
	];
	
	Ext.apply(config, {
        baseCls: 'modx-formpanel',
        layout: 'anchor',
        hideMode: 'offsets',
        items: [{
            html: '<h2>' + _('mvtseodata') + '</h2>',
            cls: '',
            style: {margin: '15px 0'}
        }, {
            xtype: 'modx-tabs',
            defaults: {border: false, autoHeight: true},
            border: true,
            hideMode: 'offsets',
            items: tabs
        }]
    });
	
	
    mvtSeoData.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(mvtSeoData.panel.Home, MODx.Panel);
Ext.reg('mvtseodata-panel-home', mvtSeoData.panel.Home);