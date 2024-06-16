import timestamps from '@/data/composables/timestamps';
import type Comment from '@/data/models/comment';
import { attr, hasMany, makeModel } from '@foscia/core';

export default class Post extends makeModel('posts', {
  timestamps,
  title: attr<string>(),
  body: attr<string>(),
  comments: hasMany<Comment[]>().sync('pull'),
  commentsCount: attr<number>().sync('pull'),
}) {
}
