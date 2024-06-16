export default {
  required: () => (value: string) => !!value.length || 'The field is required.',
  max: (max: number) => (value: string) => value.length <= max || `The field must not be greater than ${max} characters.`,
};
