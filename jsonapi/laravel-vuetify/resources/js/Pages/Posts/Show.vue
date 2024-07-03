<script
  setup
  lang="ts"
>
import action from '@/data/action';
import Comment from '@/data/models/comment';
import Post from '@/data/models/post';
import AppLayout from '@/Layouts/AppLayout.vue';
import rules from '@/utils/rules';
import {
  cachedOr,
  create,
  destroy,
  fill,
  include,
  loaded,
  none,
  oneOrCurrent,
  oneOrFail,
  query,
} from '@foscia/core';
import { Head, router } from '@inertiajs/vue3';
import { mdiArrowLeft, mdiCommentOutline, mdiTrashCanOutline } from '@mdi/js';
import { computed, onMounted, ref } from 'vue';
import { SubmitEventPromise } from 'vuetify';

const props = defineProps<{
  postId: string;
}>();

const loading = ref(false);
const comment = ref('');
const post = ref(null as Post | null);

const commentsLoaded = computed(() => post.value && loaded(post.value, 'comments'));

const onComment = async (event: SubmitEventPromise) => {
  if (loading.value) {
    return;
  }

  loading.value = true;

  const { valid } = await event;
  if (valid) {
    const newComment = await action().run(
      create(fill(new Comment(), { body: comment.value, post: post.value! })),
      oneOrCurrent(),
    );

    comment.value = '';
    post.value!.comments.unshift(newComment);
    post.value!.commentsCount += 1;
  }

  loading.value = false;
};

const onDelete = async () => {
  if (loading.value) {
    return;
  }

  loading.value = true;

  await action().run(destroy(post.value!), none());

  loading.value = true;

  router.get(route('posts.index'), {}, { replace: true });
};

onMounted(async () => {
  try {
    post.value = await action().run(
      query(Post, props.postId),
      include('comments'),
      cachedOr(oneOrFail()),
    );
  } catch {
    router.get(route('posts.index'), {}, { replace: true });
  }
});
</script>

<template>
  <Head :title="post ? post.title : 'Loading'" />
  <AppLayout>
    <v-row>
      <v-col cols="12">
        <div class="d-flex align-center justify-space-between">
          <v-btn
            :to="route('posts.index')"
            :prepend-icon="mdiArrowLeft"
            variant="text"
          >
            Back
          </v-btn>
          <v-btn
            v-if="post"
            :loading="loading"
            :prepend-icon="mdiTrashCanOutline"
            color="error"
            variant="tonal"
            @click="onDelete"
          >
            Delete
          </v-btn>
        </div>
      </v-col>
      <v-col
        v-if="!post"
        cols="12"
      >
        <v-skeleton-loader type="article" />
      </v-col>
      <template v-else>
        <v-col cols="12">
          <h1>
            {{ post.title }}
          </h1>
        </v-col>
        <v-col cols="12">
          <p class="text-formatted">{{ post.body }}</p>
        </v-col>
        <v-col cols="12">
          <h2>
            Comments
          </h2>
        </v-col>
        <v-col cols="12">
          <v-form
            :readonly="!commentsLoaded || loading"
            @submit.prevent="onComment"
          >
            <v-row dense>
              <v-col cols="12">
                <v-textarea
                  v-model="comment"
                  :rules="[rules.required(), rules.max(1000)]"
                  label="Comment"
                  rows="2"
                />
              </v-col>
              <v-col
                cols="12"
                class="d-flex justify-end"
              >
                <v-btn
                  :prepend-icon="mdiCommentOutline"
                  :disabled="!commentsLoaded || loading"
                  color="primary"
                  variant="tonal"
                  type="submit"
                >
                  Comment
                </v-btn>
              </v-col>
            </v-row>
          </v-form>
        </v-col>
        <v-col
          v-if="commentsLoaded"
          cols="12"
        >
          <v-row>
            <v-col
              v-if="post.comments.length === 0"
              cols="12"
            >
              No comments for now.
            </v-col>
            <v-col
              v-for="comment in post.comments"
              :key="comment.id!"
              cols="12"
            >
              <v-card elevation="0">
                <v-card-text>
                  <p class="text-formatted">{{ comment.body }}</p>
                  <p class="text-medium-emphasis mt-4">
                    {{ comment.createdAt.toLocaleDateString('en-US') }}
                  </p>
                </v-card-text>
              </v-card>
            </v-col>
          </v-row>
        </v-col>
      </template>
    </v-row>
  </AppLayout>
</template>

<style scoped>
    .text-formatted {
        white-space: pre-wrap;
    }
</style>
