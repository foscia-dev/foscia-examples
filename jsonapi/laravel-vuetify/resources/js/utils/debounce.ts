export default function debounce<F extends (...args: any[]) => any>(func: F, waitFor = 250) {
  let timeout: any;

  return (...args: Parameters<F>) => {
    clearTimeout(timeout);
    timeout = setTimeout(() => func(...args), waitFor);
  };
}
