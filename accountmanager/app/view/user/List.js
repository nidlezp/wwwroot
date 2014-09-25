Ext.define('AM.view.user.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.userlist',
    
    //we no longer define the Users store in the `initComponent` method
    store: 'Users',
    
    title: 'All Users',

    initComponent: function () {
        this.store = {
            fields: ['name', 'email'],
            data: [
                { name: 'Ed', email: 'ed@sencha.com' },
                { name: 'Tommy', email: 'tommy@sencha.com' }
            ]
        };

        this.columns = [
            { header: 'Name', dataIndex: 'name', flex: 1 },
            { header: 'Email', dataIndex: 'email', flex: 1 }
        ];

        this.callParent(arguments);
    }
});