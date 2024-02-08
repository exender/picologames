module.exports = {
  root: true,
  env: {
    node: true,
  },
  extends: [
    'plugin:vue/vue3-recommended', // Utilisez vue/vue3-recommended pour Vue 3.x
    'eslint:recommended',
  ],
  rules: {
      
    // Possible rules to consider:
    'semi': ['error', 'always'], // Enforce semicolons at the end of statements
    'quotes': ['error', 'single'], // Enforce the use of single quotes
    'indent': ['error', 2], // Enforce 2 spaces for indentation
    'no-console': 'warn', // Warn against using console.log() statements
    'no-unused-vars': 'warn', // Warn against unused variables
    'no-undef': 'error', // Error on using undeclared variables
    'no-extra-semi': 'error', // Error on extra semicolons
    'comma-dangle': ['error', 'always-multiline'], // Enforce trailing commas in multiline object/array
    'vue/html-indent': ['error', 2], // Enforce 2 spaces for indentation in Vue templates
    'vue/no-unused-components': 'warn', // Warn against unused Vue components
    'vue/no-v-html': 'off', // Allow the use of v-html directive in Vue templates
  },
};
  