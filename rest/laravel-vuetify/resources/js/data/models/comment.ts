import timestamps from '@/data/composables/timestamps';
import type Post from '@/data/models/post';
import { attr, hasOne, makeModel } from '@foscia/core';

export default class Comment extends makeModel('comments', {
  timestamps,
  body: attr<string>(),
  post: hasOne<Post>('posts'),
}) {
}
