import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { bundleStats } from 'rollup-plugin-bundle-stats';
import { defineConfig, loadEnv } from 'vite';
import vuetify from 'vite-plugin-vuetify';

export default defineConfig(({ mode }) => {
  Object.assign(process.env, loadEnv(mode, process.cwd(), ''));

  return {
    plugins: [
      bundleStats(),
      laravel({
        input: 'resources/js/app.ts',
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
      vuetify({
        styles: { configFile: 'resources/css/vuetify/settings.scss' },
      }),
    ],
    build: {
      rollupOptions: {
        output: {
          manualChunks: (id) => (
            /node_modules\/@foscia/.test(id) ? 'vendor-foscia' : undefined
          ),
        },
      },
    },
  };
});
