import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import AutoImport from "unplugin-auto-import/vite";
import Components from "unplugin-vue-components/vite";
import DefineOptions from "unplugin-vue-define-options/vite";

const compositionResolver = (name) => {
    const isCompositionApi = name.startsWith("use") && name != "useRoute";
    if (isCompositionApi) return `@/Composables/${name}.ts`;
};

const layoutResolver = (name) => {
    const isLayout = name.endsWith("Layout");
    if (isLayout) return `@/Layouts/${name}.vue`;
};

export default defineConfig({
    plugins: [
        laravel({
            input: "resources/js/app.ts",
            ssr: "resources/js/ssr.ts",
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        AutoImport({
            imports: ["vue"],
            resolvers: [compositionResolver, layoutResolver],
        }),
        Components({
            /* options */
            dirs: ["resources/js/Components"],
            directoryAsNamespace: true,
        }),
        DefineOptions(),
    ],
    resolve: {
        alias: {
            "@": "/resources/js",
        },
    },
});
