﻿Ext.application({
    name: 'AM',

    appFolder: 'app',
    controllers: [
        'Users'
    ],
    launch: function () {
        Ext.create('Ext.container.Viewport', {
            layout: 'fit',
            items: {
                xtype: 'userlist'
            }
        });
    }
});