<script
  setup
  lang="ts"
>
import action from '@/data/action';
import Post from '@/data/models/post';
import rules from '@/utils/rules';
import { create, fill, oneOrCurrent } from '@foscia/core';
import { reactive, ref, watch } from 'vue';
import { SubmitEventPromise } from 'vuetify';

const emit = defineEmits<{
  (e: 'created', value: Post): void;
}>();

const loading = ref(false);
const dialog = ref(false);

const inputs = reactive({
  title: '',
  body: '',
});

watch(dialog, (value) => {
  if (!value) {
    inputs.title = '';
    inputs.body = '';
  }
});

const onSubmit = async (event: SubmitEventPromise) => {
  if (loading.value) {
    return;
  }

  loading.value = true;

  const { valid } = await event;
  if (valid) {
    emit(
      'created',
      await action()
        .use(create(fill(new Post(), inputs)))
        .run(oneOrCurrent()),
    );

    onCloseDialog();
  }

  loading.value = false;
};

const onCloseDialog = () => {
  dialog.value = false;
};
</script>

<template>
  <v-dialog
    v-model="dialog"
    :persistent="loading || !!inputs.title.length || !!inputs.body.length"
    width="600"
    scrollable
  >
    <template #activator="activatorProps">
      <slot
        name="activator"
        v-bind="activatorProps"
      />
    </template>
    <v-form
      :readonly="loading"
      @submit.prevent="onSubmit"
    >
      <v-card>
        <v-card-title>
          Create a new post
        </v-card-title>
        <v-divider />
        <v-card-text>
          <v-row dense>
            <v-col cols="12">
              <v-text-field
                v-model="inputs.title"
                :rules="[rules.required(), rules.max(255)]"
                label="Title"
              />
            </v-col>
            <v-col cols="12">
              <v-textarea
                v-model="inputs.body"
                :rules="[rules.required(), rules.max(5000)]"
                label="Body"
              />
            </v-col>
          </v-row>
        </v-card-text>
        <v-divider />
        <v-card-actions>
          <v-btn
            :disabled="loading"
            @click="onCloseDialog"
          >
            Cancel
          </v-btn>
          <v-btn
            :loading="loading"
            type="submit"
            color="primary"
          >
            Post
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-form>
  </v-dialog>
</template>
