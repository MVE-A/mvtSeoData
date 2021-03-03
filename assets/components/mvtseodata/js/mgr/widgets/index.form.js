mvtSeoData.panel.Index = function(config) {
	config = config || {};
	Ext.applyIf(config, {
		id: 'mvtseodata-form-index',
		cls: 'container form-with-labels',
		labelAlign: 'top',
		autoHeight: true,
		labelWidth: 200,
		url: mvtSeoData.config.connector_url,
		/*baseParams: {
			action: 'mgr/settings/set'
		},*/
		items: [{
			layout: 'form',
			cls: 'main-wrapper',
			border: false,
			items: this.getFields(config)
		}],
		buttonAlign: 'left',
		buttons: [{
				text: '<i class="icon icon-save"></i> '+_('mvtseodata_index_set'),
				style: 'margin-left:15px;',
				listeners: {
				click: {
					fn: this.runProcess, scope: this
				}
			}
		}],
		listeners: {
			afterrender: {
				fn: this.setData, scope: this
			},
			success: {
				fn:function(response) {
					Ext.Msg.alert(_('mvtseodata_success'), _('mvtseodata_settings_success'));
				}
			}
		}
	});
	mvtSeoData.panel.Index.superclass.constructor.call(this, config);
};

Ext.extend(mvtSeoData.panel.Index,MODx.FormPanel,{
    filters: {},
    
    runProcess: function() {
       this.createIndex(0,0,0);
    },
    
    createIndex: function(offset,total,count_categories) {
		
        var uts = [_('mvtseodata_order_unit1'),_('mvtseodata_order_unit2'),_('mvtseodata_order_unit3')];
        var uts2 = [_('mvtseodata_list_unit1'),_('mvtseodata_list_unit2'),_('mvtseodata_list_unit3')];
		
        el = this.getEl();
		
        var maskmess = _('mvtseodata_list_prepare_process');
			maskmess = maskmess.replace('{offset}', count_categories);
			maskmess = maskmess.replace('{total}', total);
		
        el.mask(maskmess,'x-mask-loading');
		
        //var _self = this;
		
		MODx.Ajax.request({
            url: mvtSeoData.config.connector_url,
            params: {
				action: 'mgr/index/create',
				mode: 'user',
				offset: offset
            },
            listeners: {
				success: {
                    fn: function (response) {
						el.unmask();
						var data = response.object;
						if (!data.done) {
							this.createIndex(data.offset,data.total,data.categories);
						}
						else {
							var mess = _('mvtseodata_listcreate');
								mess = mess.replace('{products}', data.products+' '+mvtSeoData.utils.declaration(data.products,uts2));
								mess = mess.replace('{categories}', data.categories+' '+mvtSeoData.utils.declaration(data.categories,uts));
							Ext.Msg.alert(_('mvtseodata_success'),mess);
							this.setData();
						}
					}, scope: this
				},
				failure: {
                    fn: function (response) {
						el.unmask();
						Ext.Msg.alert(_('mvtseodata_error'),_('mvtseodata_errorlog'));
                    }, scope: this
                }
            }
		});	            
    },
    
	
	setData: function() {
		MODx.Ajax.request({
			url: mvtSeoData.config.connector_url
			,params: {
				action: 'mgr/index/get'
			}
			,listeners: {
				success: {
					fn:function(response) {
						var data = response.object;
						for(key in data) {
							if(data.hasOwnProperty(key)) {
								var value = data[key];
								var body = Ext.get('mvtseodata_index_'+key); 
								Ext.DomHelper.overwrite(body,'');
								var newElement = {
									html: data[key],
								};
								var createdElement = Ext.DomHelper.append(body, newElement);
							}
						}
					},scope: this
				}
			}
		});
	},
	
	
	getFields: function(config) {
		
		return [{
            id: 'mvtseodata_index_date',
			cls: 'mvtseodata-index-field',
        }, {
            id: 'mvtseodata_index_categories',
			cls: 'mvtseodata-index-field',
        }, {
            id: 'mvtseodata_index_products',
			cls: 'mvtseodata-index-field',
        }];

	}

});
Ext.reg('mvtseodata-form-index', mvtSeoData.panel.Index);
