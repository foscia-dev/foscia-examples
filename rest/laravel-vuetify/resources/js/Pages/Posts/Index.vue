<script
  setup
  lang="ts"
>
import PostsCreateDialog from '@/Components/Posts/PostsCreateDialog.vue';
import action from '@/data/action';
import Post from '@/data/models/post';
import AppLayout from '@/Layouts/AppLayout.vue';
import debounce from '@/utils/debounce';
import { all, query, when } from '@foscia/core';
import { param } from '@foscia/http';
import { Head, useRemember } from '@inertiajs/vue3';
import { mdiArrowRight, mdiCommentMultipleOutline, mdiMagnify, mdiPlus } from '@mdi/js';
import { Ref, watch } from 'vue';

const state = useRemember({
  loading: true,
  search: '',
  page: 1,
  total: 0,
  posts: [] as Post[],
}) as Ref<{
  loading: boolean,
  search: string,
  page: number,
  total: number,
  posts: Post[],
}>;

const fetchPosts = async () => {
  state.value.loading = true;

  const { instances, meta } = await action().run(
    query(Post),
    when(state.value.search.length, param('search', state.value.search)),
    param('size', 12),
    param('page', state.value.page),
    all((data) => ({ ...data, meta: data.data.meta })),
  );

  state.value.posts = instances;
  state.value.total = meta.page.total;

  state.value.loading = false;
};

const debounceFetchPosts = debounce(fetchPosts);

watch(() => state.value.search, (value) => {
  if (value.length) {
    state.value.page = 1;
  }

  debounceFetchPosts();
}, { immediate: true });

const onPage = (page: number) => {
  state.value.page = page;
  fetchPosts();
};

const onCreated = (post: Post) => {
  state.value.posts.unshift(post);
  if (state.value.posts.length > 12) {
    state.value.posts.pop();
  }
};
</script>

<template>
  <Head title="Posts" />
  <AppLayout>
    <v-row>
      <v-col
        cols="12"
        class="text-right"
      >
        <posts-create-dialog @created="onCreated">
          <template #activator="{ props }">
            <v-btn
              :prepend-icon="mdiPlus"
              color="primary"
              variant="tonal"
              rounded="pill"
              v-bind="props"
            >
              Post
            </v-btn>
          </template>
        </posts-create-dialog>
      </v-col>
      <v-col cols="12">
        <v-text-field
          v-model="state.search"
          :prepend-inner-icon="mdiMagnify"
          label="Search"
          hide-details
        />
      </v-col>
      <v-col
        v-if="state.loading && state.posts.length === 0"
        cols="12"
      >
        <v-row>
          <v-col
            v-for="index in 6"
            :key="index"
            cols="12"
            sm="6"
            md="4"
          >
            <v-skeleton-loader
              type="card"
              class="rounded-lg"
            />
          </v-col>
        </v-row>
      </v-col>
      <v-col
        v-else-if="state.posts.length"
        cols="12"
      >
        <v-row>
          <v-col
            v-for="post in state.posts"
            :key="post.id!"
            cols="12"
            sm="6"
            md="4"
          >
            <v-card elevation="0">
              <v-card-title>
                {{ post.title }}
              </v-card-title>
              <v-card-subtitle>
                {{ post.createdAt.toLocaleDateString('en-US') }}
              </v-card-subtitle>
              <v-card-actions class="justify-space-between">
                <span class="ml-2">
                  <v-icon
                    :icon="mdiCommentMultipleOutline"
                    size="small"
                    start
                  />
                  {{ post.commentsCount }}
                </span>
                <v-btn
                  :to="route('posts.show', { post: post.id })"
                  :append-icon="mdiArrowRight"
                  color="primary"
                >
                  Read
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
          <v-col cols="12">
            <v-pagination
              :disabled="state.loading"
              :model-value="state.page"
              :length="Math.ceil(state.total / 12)"
              :total-visible="4"
              @update:model-value="onPage"
            />
          </v-col>
        </v-row>
      </v-col>
      <v-col
        v-else
        cols="12"
      >
        No post published.
      </v-col>
    </v-row>
  </AppLayout>
</template>
