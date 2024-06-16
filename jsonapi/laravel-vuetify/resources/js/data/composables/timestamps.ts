import { attr, makeComposable, toDateTime } from '@foscia/core';

export default makeComposable({
  createdAt: attr(toDateTime()),
  updatedAt: attr(toDateTime()),
});
