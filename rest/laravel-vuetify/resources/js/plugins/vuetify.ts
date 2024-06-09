import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import { aliases, mdi } from 'vuetify/iconsets/mdi-svg';

export default createVuetify({
  icons: {
    defaultSet: 'mdi',
    aliases,
    sets: {
      mdi,
    },
  },
  theme: {
    themes: {
      light: {
        colors: {
          primary: '#ac1b55',
          surface: '#fef7fa',
        },
      },
    },
  },
  defaults: {
    VBtn: { rounded: 'pill' },
    VCard: { rounded: 'lg' },
    VForm: { validateOn: 'submit' },
    VTextField: { color: 'primary' },
    VTextarea: { color: 'primary' },
    VSkeletonLoader: { color: 'surface', class: 'rounded-xl' },
  },
});
