import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { visualizer } from 'rollup-plugin-visualizer';
import { defineConfig, loadEnv } from 'vite';
import vuetify from 'vite-plugin-vuetify';

export default defineConfig(({ mode }) => {
  Object.assign(process.env, loadEnv(mode, process.cwd(), ''));

  return {
    plugins: [
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
        plugins: [
          process.env.BUILD_ANALYZE ? visualizer({
            filename: 'public/build/bundle-stats.html',
            open: true,
          }) : undefined,
        ],
      },
    },
  };
});
