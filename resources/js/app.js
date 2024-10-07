import 'bootstrap/dist/css/bootstrap.css'
import './bootstrap'
import {createApp, h} from "vue"
import {createInertiaApp} from "@inertiajs/inertia-vue3"
import {resolvePageComponent} from "laravel-vite-plugin/inertia-helpers"
import {InertiaProgress} from '@inertiajs/progress'

createInertiaApp({
    resolve: name => {
        let n = `${name}.vue`.slice(2)
        return resolvePageComponent(
            `./pages/${n}`,
            import.meta.glob("./pages/**/*.vue")
        );
    },
    setup({el, App, props, plugin}) {
        createApp({render: () => h(App, props)})
            .use(plugin)
            .mount(el)
    },
}).then()
InertiaProgress.init()
