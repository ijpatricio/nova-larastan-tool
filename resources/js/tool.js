Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: 'nova-larastan-tool',
            path: '/nova-larastan-tool',
            component: require('./components/Tool'),
        },
    ])
})
