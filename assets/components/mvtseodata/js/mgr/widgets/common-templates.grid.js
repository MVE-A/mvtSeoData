mvtSeoData.grid.CommonTemplates = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mvtseodata-grid-common-templates';
    }
    Ext.applyIf(config, {
        url: mvtSeoData.config.connector_url,
        fields: this.getFields(config),
        columns: this.getColumns(config),
        tbar: this.getTopBar(config),
        sm: new Ext.grid.CheckboxSelectionModel(),
        baseParams: {
            action: 'mgr/templates/common-getlist'
        },
        listeners: {
            rowDblClick: function (grid, rowIndex, e) {
                var row = grid.store.getAt(rowIndex);
                this.updateItem(grid, e, row);
            }
        },
        viewConfig: {
            forceFit: true,
            enableRowBody: true,
            autoFill: true,
            showPreview: true,
            scrollOffset: 0,
            getRowClass: function (rec) {
                return !rec.data.active
                    ? 'mvtseodata-grid-row-disabled'
                    : '';
            }
        },
        paging: true,
        remoteSort: true,
        autoHeight: true,
    });
    mvtSeoData.grid.CommonTemplates.superclass.constructor.call(this, config);

    // Clear selection on grid refresh
    this.store.on('load', function () {
        if (this._getSelectedIds().length) {
            this.getSelectionModel().clearSelections();
        }
    }, this);
};
Ext.extend(mvtSeoData.grid.CommonTemplates, MODx.grid.Grid, {
    windows: {},

    getMenu: function (grid, rowIndex) {
        var ids = this._getSelectedIds();

        var row = grid.getStore().getAt(rowIndex);
        var menu = mvtSeoData.utils.getMenu(row.data['actions'], this, ids);

        this.addContextMenuItem(menu);
    },

    createItem: function (btn, e) {
        var w = MODx.load({
            xtype: 'mvtseodata-common-template-window-create',
            id: Ext.id(),
            listeners: {
                success: {
                    fn: function () {
                        this.refresh();
                    }, scope: this
                }
            }
        });
        w.reset();
        w.setValues({active: true});
        w.show(e.target);
    },

    updateItem: function (btn, e, row) {
        if (typeof(row) != 'undefined') {
            this.menu.record = row.data;
        }
        else if (!this.menu.record) {
            return false;
        }
        var id = this.menu.record.id;

        MODx.Ajax.request({
            url: this.config.url,
            params: {
                action: 'mgr/templates/get',
                id: id
            },
            listeners: {
                success: {
                    fn: function (r) {
                        var w = MODx.load({
                            xtype: 'mvtseodata-common-template-window-update',
                            id: Ext.id(),
                            record: r,
                            listeners: {
                                success: {
                                    fn: function () {
                                        this.refresh();
                                    }, scope: this
                                }
                            }
                        });
                        w.reset();
                        w.setValues(r.object);
                        w.show(e.target);
                    }, scope: this
                }
            }
        });
    },

    removeItem: function () {
        var ids = this._getSelectedIds();
        if (!ids.length) {
            return false;
        }
        MODx.msg.confirm({
            title: ids.length > 1
                ? _('mvtseodata_items_remove')
                : _('mvtseodata_item_remove'),
            text: ids.length > 1
                ? _('mvtseodata_items_remove_confirm')
                : _('mvtseodata_item_remove_confirm'),
            url: this.config.url,
            params: {
                action: 'mgr/templates/remove',
                ids: Ext.util.JSON.encode(ids),
            },
            listeners: {
                success: {
                    fn: function () {
                        this.refresh();
                    }, scope: this
                }
            }
        });
        return true;
    },

    disableItem: function () {
        var ids = this._getSelectedIds();
        if (!ids.length) {
            return false;
        }
        MODx.Ajax.request({
            url: this.config.url,
            params: {
                action: 'mgr/templates/disable',
                ids: Ext.util.JSON.encode(ids),
            },
            listeners: {
                success: {
                    fn: function () {
                        this.refresh();
                    }, scope: this
                }
            }
        })
    },

    enableItem: function () {
        var ids = this._getSelectedIds();
        if (!ids.length) {
            return false;
        }
        MODx.Ajax.request({
            url: this.config.url,
            params: {
                action: 'mgr/templates/enable',
                ids: Ext.util.JSON.encode(ids),
            },
            listeners: {
                success: {
                    fn: function () {
                        this.refresh();
                    }, scope: this
                }
            }
        })
    },
    
    dublicateItem: function (btn, e, row) {
		
        if (typeof(row) != 'undefined') {
            this.menu.record = row.data;
        }
        else if (!this.menu.record) {
            return false;
        }
        var id = this.menu.record.id;

        MODx.msg.confirm({
            title: _('mvtseodata_item_dublicate'),
            text:  _('mvtseodata_item_dublicate_confirm'),
				
            url: this.config.url,
            params: {
                action: 'mgr/templates/get',
                id: id
            },
            listeners: {
                success: {
                    fn: function (r) {
                        var w = MODx.load({
                            xtype: 'mvtseodata-common-template-window-create',
                            id: Ext.id(),
                            record: r,
                            listeners: {
                                success: {
                                    fn: function () {
                                        this.refresh();
                                    }, scope: this
                                }
                                ,
								/*failure: {
									fn: function (response) {
										console.log(response);
										MODx.msg.alert(_('error'), 'test');
									}, scope: this
								}*/
                            }
                        });
                        w.reset();
                        w.setValues(r.object);
                        w.show(e.target);
                    }, scope: this
                }
            }
			,isDuplicate: true
		});
    },

    getFields: function () {
        return ['id', 'name', 'pagetitle_template_bl', 'title_template_bl', 'get_page_template_bl', 'description_template_bl', 'content_template_bl', 'active', 'actions'];
    },

    getColumns: function () {
        return [ {
            header: _('mvtseodata_template_name'),
            dataIndex: 'name',
            sortable: true,
            width: 200,
        }, {
            header: _('mvtseodata_template_pagetitle_tpl_bl'),
            dataIndex: 'pagetitle_template_bl',
            sortable: false,
            width: 50,
        }, {
            header: _('mvtseodata_template_title_tpl_bl'),
            dataIndex: 'title_template_bl',
            sortable: false,
            width: 50,
        }, {
            header: _('mvtseodata_template_get_tpl_bl'),
            dataIndex: 'get_page_template_bl',
            sortable: false,
            width: 50,
        }, {
            header: _('mvtseodata_template_description_tpl_bl'),
            dataIndex: 'description_template_bl',
            sortable: false,
            width: 50,
        }, {
            header: _('mvtseodata_template_content_tpl_bl'),
            dataIndex: 'content_template_bl',
            sortable: false,
            width: 50,
        }, {
            header: _('mvtseodata_item_active'),
            dataIndex: 'active',
            renderer: mvtSeoData.utils.renderBoolean,
            sortable: true,
            width: 50,
        }, {
            header: _('mvtseodata_grid_actions'),
            dataIndex: 'actions',
            renderer: mvtSeoData.utils.renderActions,
            sortable: false,
            width: 80,
            id: 'actions'
        }];
    },

    getTopBar: function () {
        return [{
            text: '<i class="icon icon-plus"></i>&nbsp;' + _('mvtseodata_template_create'),
            handler: this.createItem,
            scope: this
        }, '->', {
            xtype: 'mvtseodata-field-search',
            width: 250,
            listeners: {
                search: {
                    fn: function (field) {
                        this._doSearch(field);
                    }, scope: this
                },
                clear: {
                    fn: function (field) {
                        field.setValue('');
                        this._clearSearch();
                    }, scope: this
                },
            }
        }];
    },

    onClick: function (e) {
        var elem = e.getTarget();
        if (elem.nodeName == 'BUTTON') {
            var row = this.getSelectionModel().getSelected();
            if (typeof(row) != 'undefined') {
                var action = elem.getAttribute('action');
                if (action == 'showMenu') {
                    var ri = this.getStore().find('id', row.id);
                    return this._showMenu(this, ri, e);
                }
                else if (typeof this[action] === 'function') {
                    this.menu.record = row.data;
                    return this[action](this, e);
                }
            }
        }
        return this.processEvent('click', e);
    },

    _getSelectedIds: function () {
        var ids = [];
        var selected = this.getSelectionModel().getSelections();

        for (var i in selected) {
            if (!selected.hasOwnProperty(i)) {
                continue;
            }
            ids.push(selected[i]['id']);
        }

        return ids;
    },

    _doSearch: function (tf) {
        this.getStore().baseParams.query = tf.getValue();
        this.getBottomToolbar().changePage(1);
    },

    _clearSearch: function () {
        this.getStore().baseParams.query = '';
        this.getBottomToolbar().changePage(1);
    },
});
Ext.reg('mvtseodata-grid-common-templates', mvtSeoData.grid.CommonTemplates);
