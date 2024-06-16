import { router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

export default {
  install(app: any) {
    app.component('RouterLink', {
      useLink(props: any) {
        const href = props.to.value;
        const currentUrl = computed(() => usePage().url);
        return {
          route: computed(() => ({ href })),
          isActive: computed(() => currentUrl.value.startsWith(href)),
          isExactActive: computed(() => href === currentUrl),
          navigate(e: any) {
            if (e.shiftKey || e.metaKey || e.ctrlKey) return;
            e.preventDefault();
            router.visit(href);
          },
        };
      },
    });
  },
};
