let development = process.env.NODE_ENV !== 'production'
let baseUrl = development ? 'http://127.0.0.1:8000' : 'http://api.aistork.tj'

export default {
    // Disable server-side rendering: https://go.nuxtjs.dev/ssr-mode
    ssr: false,

    // Global page headers: https://go.nuxtjs.dev/config-head
    head: {
        title: 'aistork',
        meta: [
            { charset: 'utf-8' },
            { name: 'viewport', content: 'width=device-width, initial-scale=1' },
            { hid: 'description', name: 'description', content: '' },
            { name: 'format-detection', content: 'telephone=no' }
        ],
        link: [
            { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
        ]
    },

    // Global CSS: https://go.nuxtjs.dev/config-css
    css: [
        '~/assets/css/main.css'
    ],

    // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
    plugins: [],

    // Auto import components: https://go.nuxtjs.dev/config-components
    components: true,

    // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
    buildModules: [
        // https://go.nuxtjs.dev/tailwindcss
        '@nuxtjs/tailwindcss',
    ],

    // Modules: https://go.nuxtjs.dev/config-modules
    modules: [
        // https://go.nuxtjs.dev/axios
        '@nuxtjs/axios',
        // https://go.nuxtjs.dev/pwa
        '@nuxtjs/pwa',
        '@nuxtjs/auth-next'

    ],

    // Axios module configuration: https://go.nuxtjs.dev/config-axios
    axios: {
        baseURL: `${baseUrl}/api`,
        proxyHeaders: false,
        credentials: false
    },

    // PWA module configuration: https://go.nuxtjs.dev/pwa
    pwa: {
        manifest: {
            lang: 'en'
        }
    },
    // Build Configuration: https://go.nuxtjs.dev/config-build
    build: {},

    auth: {
        strategies: {
            laravelJWT: {
                provider: 'laravel/jwt',
                url: baseUrl,
                endpoints: {},
                token: {
                    property: 'access_token',
                    maxAge: 60 * 60
                },
                refreshToken: {
                    maxAge: 20160 * 60
                }
            }
        },
        redirect: {
            login: '/auth/login',
            logout: '/',
            callback: '/auth/login',
            home: '/'
        }
    },

    loading: {
        color: '#F28F16',
        height: '4px'
    }
}