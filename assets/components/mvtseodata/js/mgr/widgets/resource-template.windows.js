mvtSeoData.window.CreateResourceTemplate = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mvtseodata-resource-template-window-create';
    }
    Ext.applyIf(config, {
        title: _('mvtseodata_item_create'),
        width: 1050,
        autoHeight: true,
        url: mvtSeoData.config.connector_url,
        action: 'mgr/templates/create',
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    mvtSeoData.window.CreateResourceTemplate.superclass.constructor.call(this, config);
};
Ext.extend(mvtSeoData.window.CreateResourceTemplate, MODx.Window, {

    getFields: function (config) {
		var uidrt = Date.now();
		
		let cf = {
            xtype: 'textarea',
            fieldLabel: _('mvtseodata_template_content_tpl'),
            name: 'content_template',
            id: uidrt+'-content_template', //config.id + '-content_template',
            height: 200,
            cls: 'mvtseodata-content_template',
            anchor: '100%',
        };
        

        if(MODx.config['mvtseodata_mng_rt'] == 1) {
            
            cf = {
                xtype: 'textarea',
                fieldLabel: _('mvtseodata_template_content_tpl'),
                name: 'content_template',
                id: uidrt+'-content_template', //config.id + '-content_template',
                height: 150,
                style: "width:100%;max-height:150px;height:150px;",
                cls: 'mvtseodata-content_template',
                anchor: '100%',
                listeners: {
                    render: function () {
                        if (MODx.loadRTE) {
                            window.setTimeout(function() {
                                MODx.loadRTE(uidrt+'-content_template');
                            }, 300);
                        }
                    }
                }
            };
        }
		
        return [{
            xtype: 'modx-tabs',
            deferredRender: false,
            border: false,
            bodyStyle: 'padding:5px 10px;',
            style: 'margin-top: 10px',
            bodyBorder: 1,
            items: [{
                title: '<i class="icon icon-wpforms"></i> '+ _('mvtseodata_template_window_form1'),
                layout: 'form',
		        id: 'mvtseodata_template_window_form',
                items: [{
                        xtype: 'textfield',
                        fieldLabel: _('mvtseodata_template_name'),
                        name: 'name',
                        id: config.id + '-name',
                        anchor: '99%'
                } , {
                    layout: 'column',
                    items: [{
                            columnWidth: .7,
                            layout: 'form',
                            items: [{
                                xtype: 'mvtseodata-combo-link-resource',
                                fieldLabel: _('mvtseodata_assortment_resource'),
                                name: 'resource_id',
                                id: config.id + '-resource_id',
                                anchor: '99%',
                                allowBlank: false
                            }]
                        } , {
                                columnWidth: .3,
                                layout: 'form',
                                items: [{
                                        xtype: 'mvtseodata-combo-replacement-priority',
                                        fieldLabel: _('mvtseodata_replacement_priority'),
                                        name: 'replacement_priority',
                                        id: config.id + '-replacement_priority',
                                        hiddenName: 'replacement_priority',
                                        anchor: '99%',
                                        allowBlank: false
                                }]
                        }]
                } , {
                        layout: 'column',
                        items: [{
                                columnWidth: .5,
                                layout: 'form',
                                items: [{
                                        xtype: 'textfield',
                                        fieldLabel: _('mvtseodata_template_pagetitle_tpl'),
                                        name: 'pagetitle_template',
                                        id: config.id + '-pagetitle_template',
                                        anchor: '99%'
                                }]
                        } , {
                                columnWidth: .5,
                                layout: 'form',
                                items: [{
                                        xtype: 'textfield',
                                        fieldLabel: _('mvtseodata_template_title_tpl'),
                                        name: 'title_template',
                                        id: config.id + '-title_template',
                                        anchor: '99%'
                                }]
                        }]
                }, {
                        xtype: 'textfield',
                        fieldLabel: _('mvtseodata_template_get_tpl'),
                        name: 'get_page_template',
                        id: config.id + '-get_page_template',
                        anchor: '99%'
                }, {
                        xtype: 'xcheckbox',
                        boxLabel: _('mvtseodata_item_active'),
                        name: 'active',
                        id: config.id + '-active',
                        checked: true,
                }]
            } , {
                title: '<i class="icon icon-wpforms"></i> '+ _('mvtseodata_template_window_form2'),
                layout: 'form',
		        id: 'mvtseodata_template_window_form2',
                items: [{
					xtype: 'textarea',
					fieldLabel: _('mvtseodata_template_description_tpl'),
					name: 'description_template',
					id: uidrt+'-description_template', //config.id + '-description_template',
					height: 100,
					//style: "width:100%;max-height:300px;height:300px;",
					cls: 'mvtseodata-description-template',
					anchor: '100%',
					/*listeners: {
						render: function () {
							if (MODx.loadRTE) {
								window.setTimeout(function() {
									MODx.loadRTE(uidrt+'-description_template');
								}, 300);
							}
						}
					}*/
				}]
			} , {
                title: '<i class="icon icon-wpforms"></i> '+ _('mvtseodata_template_window_form3'),
                layout: 'form',
		        id: 'mvtseodata_template_window_form3',
                items: [{
                    xtype: 'mvtseodata-combo-replacement-priority',
                    fieldLabel: _('mvtseodata_replacement_priority_content'),
                    name: 'replacement_priority_content',
                    id: config.id + '-replacement_priority_content',
                    hiddenName: 'replacement_priority_content',
                    anchor: '99%',
                    allowBlank: false
                }, cf
				]
			} , {
		title: '<i class="icon icon-info"></i> '+ _('mvtseodata_template_window_info'),
                layout: 'form',
		id: 'mvtseodata_template_window_info',
                items: [{
                    layout: 'column',
                    items: [{
                        columnWidth: .5,
                        layout: 'form',
                        items: [{
                            cls: 'mvtseodata_template_window_info',
                            html: '<h3>'+ _('mvtseodata_template_window_info_title')+'</h3><p>'+ _('mvtseodata_template_window_info_html')+'</p>',
                            xtype: 'panel'
                        }]
                    } , {
                        layout: 'column',
                        columnWidth: .5,
                        layout: 'form',
                        items: [{
                            cls: 'mvtseodata_template_window_info',
                            html: '<h3>'+ _('mvtseodata_template_window_info_title2')+'</h3><p>'+ _('mvtseodata_template_window_info_html2')+'</p>',
                            xtype: 'panel'
                        }]
                    }]
                }]
            }]		
		}];
    },

    loadDropZones: function () {
    }

});
Ext.reg('mvtseodata-resource-template-window-create', mvtSeoData.window.CreateResourceTemplate);


mvtSeoData.window.UpdateResourceTemplate = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mvtseodata-resource-template-window-update';
    }
    Ext.applyIf(config, {
        title: _('mvtseodata_item_update'),
        width: 1050,
        autoHeight: true,
        url: mvtSeoData.config.connector_url,
        action: 'mgr/templates/update',
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    mvtSeoData.window.UpdateResourceTemplate.superclass.constructor.call(this, config);
};
Ext.extend(mvtSeoData.window.UpdateResourceTemplate, MODx.Window, {

    getFields: function (config) {
        var uidrt = Date.now();
		
		let cf = {
            xtype: 'textarea',
            fieldLabel: _('mvtseodata_template_content_tpl'),
            name: 'content_template',
            id: uidrt+'-content_template', //config.id + '-content_template',
            height: 200,
            cls: 'mvtseodata-content_template',
            anchor: '100%',
        };
        

        if(MODx.config['mvtseodata_mng_rt'] == 1) {
            
            cf = {
                xtype: 'textarea',
                fieldLabel: _('mvtseodata_template_content_tpl'),
                name: 'content_template',
                id: uidrt+'-content_template', //config.id + '-content_template',
                height: 150,
                style: "width:100%;max-height:150px;height:150px;",
                cls: 'mvtseodata-content_template',
                anchor: '100%',
                listeners: {
                    render: function () {
                        if (MODx.loadRTE) {
                            window.setTimeout(function() {
                                MODx.loadRTE(uidrt+'-content_template');
                            }, 300);
                        }
                    }
                }
            };
        }
		
		return [{
            xtype: 'hidden',
            name: 'id',
            id: config.id + '-id',
        }, {
            xtype: 'modx-tabs',
            deferredRender: false,
            border: false,
            bodyStyle: 'padding:5px 10px;',
            style: 'margin-top: 10px',
            bodyBorder: 1,
            items: [{
                title: '<i class="icon icon-wpforms"></i> '+ _('mvtseodata_template_window_form1'),
                layout: 'form',
		        id: 'mvtseodata_template_window_form',
                items: [{
					xtype: 'textfield',
					fieldLabel: _('mvtseodata_template_name'),
					name: 'name',
					id: config.id + '-name',
					anchor: '99%',
					allowBlank: false,
				} , {
                    layout: 'column',
                    items: [{
                            columnWidth: .7,
                            layout: 'form',
                            items: [{
                                xtype: 'mvtseodata-combo-link-resource',
                                fieldLabel: _('mvtseodata_assortment_resource'),
                                name: 'resource_id',
                                id: config.id + '-resource_id',
                                anchor: '99%',
                                allowBlank: false
                            }]
                        } , {
                                columnWidth: .3,
                                layout: 'form',
                                items: [{
                                        xtype: 'mvtseodata-combo-replacement-priority',
                                        fieldLabel: _('mvtseodata_replacement_priority'),
                                        name: 'replacement_priority',
                                        id: config.id + '-replacement_priority',
                                        hiddenName: 'replacement_priority',
                                        anchor: '99%',
                                        allowBlank: false
                                }]
                        }]
                } , {
					layout: 'column',
					items: [{
						columnWidth: .5,
						layout: 'form',
						items: [{
							xtype: 'textfield',
							fieldLabel: _('mvtseodata_template_pagetitle_tpl'),
							name: 'pagetitle_template',
							id: config.id + '-pagetitle_template',
							anchor: '99%'
						}]
					} , {
						columnWidth: .5,
						layout: 'form',
						items: [{
							xtype: 'textfield',
							fieldLabel: _('mvtseodata_template_title_tpl'),
							name: 'title_template',
							id: config.id + '-title_template',
							anchor: '99%'
						}]
					}]
				}, {
					xtype: 'textfield',
					fieldLabel: _('mvtseodata_template_get_tpl'),
					name: 'get_page_template',
					id: config.id + '-get_page_template',
					anchor: '99%'
				}, {
					xtype: 'xcheckbox',
					boxLabel: _('mvtseodata_item_active'),
					name: 'active',
					id: config.id + '-active',
					checked: true,
				}]
            } , {
                title: '<i class="icon icon-wpforms"></i> '+ _('mvtseodata_template_window_form2'),
                layout: 'form',
		        id: 'mvtseodata_template_window_form2',
                items: [{
					xtype: 'textarea',
					fieldLabel: _('mvtseodata_template_description_tpl'),
					name: 'description_template',
					id: uidrt+'-description_template', //config.id + '-description_template',
					height: 100,
					//style: "width:100%;max-height:300px;height:300px;",
					cls: 'mvtseodata-description-template',
					anchor: '100%',
					/*listeners: {
						render: function () {
							if (MODx.loadRTE) {
								window.setTimeout(function() {
									MODx.loadRTE(uidrt+'-description_template');
								}, 300);
							}
						}
					}*/
				}]
			} , {
                title: '<i class="icon icon-wpforms"></i> '+ _('mvtseodata_template_window_form3'),
                layout: 'form',
		        id: 'mvtseodata_template_window_form3',
                items: [{
                    xtype: 'mvtseodata-combo-replacement-priority',
                    fieldLabel: _('mvtseodata_replacement_priority_content'),
                    name: 'replacement_priority_content',
                    id: config.id + '-replacement_priority_content',
                    hiddenName: 'replacement_priority_content',
                    anchor: '99%',
                    allowBlank: false
                }  , cf]
			} , {
		title: '<i class="icon icon-info"></i> '+ _('mvtseodata_template_window_info'),
                layout: 'form',
		id: 'mvtseodata_template_window_info',
                items: [{
                    layout: 'column',
                    items: [{
                        columnWidth: .5,
                        layout: 'form',
                        items: [{
                            cls: 'mvtseodata_template_window_info',
                            html: '<h3>'+ _('mvtseodata_template_window_info_title')+'</h3><p>'+ _('mvtseodata_template_window_info_html')+'</p>',
                            xtype: 'panel'
                        }]
                    } , {
                        layout: 'column',
                        columnWidth: .5,
                        layout: 'form',
                        items: [{
                            cls: 'mvtseodata_template_window_info',
                            html: '<h3>'+ _('mvtseodata_template_window_info_title2')+'</h3><p>'+ _('mvtseodata_template_window_info_html2')+'</p>',
                            xtype: 'panel'
                        }]
                    }]
                }]
            }]		
		}];
    },

    loadDropZones: function () {
    }

});
Ext.reg('mvtseodata-resource-template-window-update', mvtSeoData.window.UpdateResourceTemplate);