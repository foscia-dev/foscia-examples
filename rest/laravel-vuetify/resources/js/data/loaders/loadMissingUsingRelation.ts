import action from '@/data/action';
import { loaded, makeQueryRelationLoader } from '@foscia/core';

export default makeQueryRelationLoader(action, {
  exclude: loaded,
});
