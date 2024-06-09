import { AnyFunction } from '@/ts/utilities/types/anyFunction';

export default function debounce<F extends AnyFunction>(func: F, waitFor = 250) {
  let timeout: number;

  return (...args: Parameters<F>) => {
    clearTimeout(timeout);
    timeout = setTimeout(() => func(...args), waitFor);
  };
}
