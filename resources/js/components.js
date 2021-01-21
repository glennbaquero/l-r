import Vue from 'vue';

/**
 * Automatic Global Registration of Base Components
 *
 * @link https://vuejs.org/v2/guide/components-registration.html
 */
const requireComponent = require.context(
  // The relative path of the components folder
  './components/',
  // Whether or not to look in subfolders
  false,
  // The regular expression used to match base component filenames
  /\.vue$/i
);

requireComponent.keys().forEach(fileName => {
  // Get component config
  const componentConfig = requireComponent(fileName);

  // Look for the component options on `.default`, which will
  // exist if the component was exported with `export default`,
  // otherwise fall back to module's root.
  const component = componentConfig.default || componentConfig;

  // Register component globally
  if (component.name) {
    Vue.component(component.name, component);
  }
});
