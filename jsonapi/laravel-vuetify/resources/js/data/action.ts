import Comment from '@/data/models/comment';
import Post from '@/data/models/post';
import { makeActionFactory, makeCache, makeRegistry } from '@foscia/core';
import {
  makeJsonApiAdapter,
  makeJsonApiDeserializer,
  makeJsonApiSerializer,
} from '@foscia/jsonapi';

const models = [Post, Comment];

export default makeActionFactory({
  // Cache stores already retrieved models' instances
  // and avoid duplicates records to coexists.
  // If you don't care about this feature, you can remove it.
  ...makeCache(),
  // Registry stores a map of type string and models classes.
  // You have this dependency because you've opt-in for it.
  ...makeRegistry(models),
  // Deserializer transforms data source's raw data to model's instances.
  // If you don't retrieve models from your data store, you can remove it.
  ...makeJsonApiDeserializer(),
  // Serializer transforms model's instances to your data source's format.
  // If you don't send models to your data store, you can remove it.
  ...makeJsonApiSerializer(),
  // Adapter exchanges data with your data source.
  // This is mandatory when using Foscia.
  ...makeJsonApiAdapter({
    baseURL: '/api/v1',
  }),
});
