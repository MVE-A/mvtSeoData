mvtSeoData.combo.LinkResource = function (config) {
    
    config = config || {};
    
    Ext.applyIf(config, {
        id: 'mvtseodata-combo-link-resource',
        fieldLabel: _('mvtdocs_' + config.name || 'combo-link-resource'),
        fields: ['id', 'article', 'pagetitle', 'parents'],
        valueField: 'id',
        displayField: 'pagetitle',
        name: config.name || 'link-resource',
        hiddenName: config.name || 'link-resource',
        allowBlank: false,
		minChars: 2,
        url: mvtSeoData.config['connector_url'],
        baseParams: {
            action: 'mgr/templates/getresources',
            combo: true
        },
        tpl: new Ext.XTemplate(''
			+'<tpl for="."><div class="x-combo-list-item mvtseodata-resources-list-item">'
			+'<tpl if="article">арт. {article}</tpl> <b>{pagetitle}</b> </span><tpl if="parents"><div class="parents"><tpl for="parents"><nobr><small>{pagetitle} / </small></nobr></tpl></div></tpl>'
			+'</div></tpl>', {compiled: true}),
        pageSize: 10,
		itemSelector: 'div.mvtseodata-resources-list-item',
        emptyText: _('no'),
        editable: true
    });
    mvtSeoData.combo.LinkResource.superclass.constructor.call(this, config);
};
Ext.extend(mvtSeoData.combo.LinkResource, MODx.combo.ComboBox);
Ext.reg('mvtseodata-combo-link-resource', mvtSeoData.combo.LinkResource);


mvtSeoData.combo.ResourceClassKey = function(config) {
	config = config || {};
    Ext.applyIf(config,{
        store: new Ext.data.ArrayStore({
            id: 0,
            fields: ['id','value'],
            data: [
		['msCategory',_('mvtseodata_class_key_category')],
                ['msProduct',_('mvtseodata_class_key_product')],
                ['modDocument',_('mvtseodata_class_key_document')]
            ]
        }),
        mode: 'local',
        displayField: 'value',
        valueField: 'id',
		emptyText: _('mvtseodata_class_key_select'),
		/*listeners: {
            'afterrender': function(combo){ 	
				this.setValue(combo.store.data.keys[0]);
            }
		}*/
    });
    mvtSeoData.combo.ResourceClassKey.superclass.constructor.call(this, config);
};
Ext.extend(mvtSeoData.combo.ResourceClassKey, MODx.combo.ComboBox);
Ext.reg('mvtseodata-combo-resource-class-key', mvtSeoData.combo.ResourceClassKey);



mvtSeoData.combo.ReplacementPriority = function(config) {
	config = config || {};
    Ext.applyIf(config,{
        store: new Ext.data.ArrayStore({
            id: 0,
            fields: ['id','value'],
            data: [
		[0,_('mvtseodata_replacement_priority_0')],
                [1,_('mvtseodata_replacement_priority_1')],
                [2,_('mvtseodata_replacement_priority_2')]
            ]
        }),
        mode: 'local',
        displayField: 'value',
        valueField: 'id',
        emptyText: _('mvtseodata_select'),
        /*listeners: {
            afterrender: function(combo){ 	
                this.setValue(combo.store.data.keys[0]);
            }
        }*/
    });
    mvtSeoData.combo.ReplacementPriority.superclass.constructor.call(this, config);
};
Ext.extend(mvtSeoData.combo.ReplacementPriority, MODx.combo.ComboBox);
Ext.reg('mvtseodata-combo-replacement-priority', mvtSeoData.combo.ReplacementPriority);


mvtSeoData.combo.Search = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        xtype: 'twintrigger',
        ctCls: 'x-field-search',
        allowBlank: true,
        msgTarget: 'under',
        emptyText: _('search'),
        name: 'query',
        triggerAction: 'all',
        clearBtnCls: 'x-field-search-clear',
        searchBtnCls: 'x-field-search-go',
        onTrigger1Click: this._triggerSearch,
        onTrigger2Click: this._triggerClear,
    });
    mvtSeoData.combo.Search.superclass.constructor.call(this, config);
    this.on('render', function () {
        this.getEl().addKeyListener(Ext.EventObject.ENTER, function () {
            this._triggerSearch();
        }, this);
    });
    this.addEvents('clear', 'search');
};
Ext.extend(mvtSeoData.combo.Search, Ext.form.TwinTriggerField, {

    initComponent: function () {
        Ext.form.TwinTriggerField.superclass.initComponent.call(this);
        this.triggerConfig = {
            tag: 'span',
            cls: 'x-field-search-btns',
            cn: [
                {tag: 'div', cls: 'x-form-trigger ' + this.searchBtnCls},
                {tag: 'div', cls: 'x-form-trigger ' + this.clearBtnCls}
            ]
        };
    },

    _triggerSearch: function () {
        this.fireEvent('search', this);
    },

    _triggerClear: function () {
        this.fireEvent('clear', this);
    },

});
Ext.reg('mvtseodata-combo-search', mvtSeoData.combo.Search);
Ext.reg('mvtseodata-field-search', mvtSeoData.combo.Search);